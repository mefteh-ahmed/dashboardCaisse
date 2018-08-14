<?php

namespace App\Http\Controllers;

use App\Magasin;
use App\UserRestaurant;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class UserRestaurantController extends Controller
{

    protected $redirectTo = '/clientASM';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $client = DB::table('users')
            ->leftJoin('magasin', 'users.id_magasin', '=', 'magasin.id')
            ->select('users.id', 'users.name','users.email','users.password','magasin.nom as magasin_name', 'magasin.id as magasin_id')
            ->paginate(5);

        return view('Client.index', ['clients' => $client]);

    }

    public function store(Request $request)
    {
        $constraints = [
            'name' => 'required|max:60',
            'email' => 'required|email',
            'password' => 'required|max:60',
            'id_magasin' => 'required|max:60',
        ];
        Magasin::findOrFail($request['id_magasin']);
        $this->validate($request, $constraints);
        UserRestaurant::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            
            'id_magasin' => $request['id_magasin'],
        ]);

        return redirect()->intended('/clientASM');
    }


    public function create()
    {
        $restaurant = Magasin::all();
        return view('Client.create', ['restaurants' => $restaurant]);
    }

    public function edit($id)
    {
        $client = UserRestaurant::find($id);
        if ($client == null) {
            return redirect()->intended('/clientASM');
        }
        $restaurant = Magasin::all();

        return view('Client.edit', ['restaurant' => $restaurant, 'client' => $client]);
    }

    public function update(Request $request, $id)
    {
        $client = UserRestaurant::findOrFail($id);

        $constraints = [
            'name' => 'required|max:60',
            'email' => 'required|email',
            'password' => 'required|max:60',
            'id_magasin' => 'required|max:60',
        ];
        $this->validate($request, $constraints);
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'id_magasin' => $request['id_magasin'],
        ];
        UserRestaurant::where('id', $id)
            ->update($input);

        return redirect()->intended('/clientASM');
    }
    public function destroy($id)
    {
        UserRestaurant::where('id', $id)->delete();
        return redirect()->intended('/clientASM');
    }

    public function search(Request $request) {
        $name= $request['name'];
            $query = UserRestaurant::where('name', 'like', '%' . $name . '%')
                ->paginate(5);
            return view('Client.index', ['clients' => $query]) ;

    }

}
