<?php

namespace App\Http\Controllers;

use App\Magasin;
use App\RestaurantDataBase;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Auth;

class RestaurantDataBaseController extends Controller
{
    protected $redirectTo = '/restaurantDB';

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $var=Auth::user()->role;
        if($var==0){
        $restaurantD = DB::table('dbrestaurant')
            ->leftJoin('magasin', 'dbrestaurant.id_magasin', '=', 'magasin.id')
            ->select('dbrestaurant.id', 'dbrestaurant.DB_HOST','dbrestaurant.DB_DATABASE','dbrestaurant.DB_USERNAME','dbrestaurant.DB_PASSWORD','magasin.nom as resto_name', 'magasin.id as resto_id')
            ->get();

        return view('BaseDeRestaurant.index', ['restaurantsD' => $restaurantD]);}
        else {
            return redirect('/dashboard');
         } 

    }

    public function store(Request $request)
    {
        $constraints = [
            'DB_HOST' => 'required|max:60',
            'DB_DATABASE' => 'required|max:60',
            'DB_USERNAME' => '',
            'DB_PASSWORD' => '',
            'id_magasin' => 'required|max:60',
        ];
        Magasin::findOrFail($request['id_magasin']);
        $this->validate($request, $constraints);
        RestaurantDataBase::create([
            'DB_HOST' => $request['DB_HOST'],
            'DB_DATABASE' => $request['DB_DATABASE'],
            'DB_USERNAME' => $request['DB_USERNAME'],
            'DB_PASSWORD' => $request['DB_PASSWORD'],
            'id_magasin' => $request['id_magasin'],
        ]);

        return redirect()->intended('/restaurantDB');
    }


    public function create()
    {
        $restaurant = Magasin::all();
        return view('BaseDeRestaurant.create', ['restaurants' => $restaurant]);
    }

    public function edit($id)
    {
        $restaurantDb = RestaurantDataBase::find($id);
        if ($restaurantDb == null) {
            return redirect()->intended('/restaurant');
        }
        $restaurant = Magasin::all();

        return view('BaseDeRestaurant.edit', ['restaurant' => $restaurant, 'restaurantDb' => $restaurantDb]);
    }

    public function update(Request $request, $id)
    {
        $restaurantDb = RestaurantDataBase::findOrFail($id);

        $constraints = [
            'DB_HOST' => 'required|max:60',
            'DB_DATABASE' => 'required|max:60',
            'DB_USERNAME' => '',
            'DB_PASSWORD' => '',
            'id_magasin' => 'required|max:60',
        ];
        $this->validate($request, $constraints);
        $input = [
            'DB_HOST' => $request['DB_HOST'],
            'DB_DATABASE' => $request['DB_DATABASE'],
            'DB_USERNAME' => $request['DB_USERNAME'],
            'DB_PASSWORD' => $request['DB_PASSWORD'],
            'id_magasin' => $request['id_magasin'],
        ];
        RestaurantDataBase::where('id', $id)
            ->update($input);

        return redirect()->intended('/restaurantDB');
    }
    public function destroy($id)
    {
        RestaurantDataBase::where('id', $id)->delete();
        return redirect()->intended('/restaurantDB');
    }

    public function search(Request $request) {
        $name= $request['name'];
        $query = RestaurantDataBase::where('DB_PORT', 'like', '%' . $name . '%')
            ->paginate(5);
        return view('BaseDeRestaurant.index', ['restaurantsD' => $query]);

    }
}
