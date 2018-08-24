<?php

namespace App\Http\Controllers;

use App\Magasin;
use App\UserRestaurant;
use App\ChainedeRestauration;

use Illuminate\Http\Request;
use Auth;

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
    {  $var=Auth::user()->role;
        if($var==0){
        $client = DB::table('users')
            ->leftJoin('magasin', 'users.id_magasin', '=', 'magasin.id')
            ->leftJoin('chaine_restauration', 'users.id_chaine', '=', 'chaine_restauration.id')

            ->select('users.id', 'users.name','users.email','users.password','magasin.nom as magasin_name', 'magasin.id as magasin_id','chaine_restauration.nom_chaine')
            ->where('users.role','<>',0)->get();
            

        return view('Client.index', ['clients' => $client]);}
        else {
            return redirect('/dashboard');
         } 

    }

    public function store(Request $request)
    {
        $constraints = [
            'name' => 'required|max:60',
            'email' => 'required|email|unique:users',
            'role' => 'required|max:60',
            'password' => 'required|max:60',
        
        ];
        if($request['id_magasin']!=null){
        Magasin::findOrFail($request['id_magasin']);
        $this->validate($request, $constraints);
        UserRestaurant::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
            'id_magasin' => $request['id_magasin'],
            'id_chaine' => $request['chaine'],

        ]);}else {

            ChainedeRestauration::findOrFail($request['chaine']);
        $this->validate($request, $constraints);
        UserRestaurant::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
            'id_magasin' => 0,
            'id_chaine' => $request['chaine'],

        ]);
        }

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
    public function updatepass(Request $request, $id)
    {
        $client = UserRestaurant::findOrFail($id);

        $constraints = [
           
        ];
        $input = [
        

            'password' => bcrypt($request['password']),
           
        ];
        UserRestaurant::where('id', $id)
            ->update($input);

        return redirect()->intended('/clientASM');
    }
    public function update(Request $request, $id)
    {
        $client = UserRestaurant::findOrFail($id);

        $constraints = [
            'name' => 'required|max:60',
            'email' => 'required|email',
            'role' => 'required|max:60',

            'id_magasin' => 'required|max:60',
        ];
        $this->validate($request, $constraints);
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],

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
