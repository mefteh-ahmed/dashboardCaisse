<?php

namespace App\Http\Controllers;

use App\ChainedeRestauration;
use App\Magasin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    protected $redirectTo = '/restaurant';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $restaurant = DB::table('magasin')
            ->select('magasin.id', 'magasin.nom','magasin.email','magasin.adresse','magasin.Telphone')
            ->paginate(5);

        return view('Restaurant.index', ['restaurants' => $restaurant]);
    }

    public function store(Request $request)
    {
        $constraints = [
            'nom' => 'required|max:20',
            'adresse' => 'required|max:60',
            'email'=>'required|email',
            'Telphone'=>'max:8'
        ];
        $this->validate($request, $constraints);
        Magasin::create([
            'nom' => $request['nom'],
            'adresse' => $request['adresse'],
            'Telphone' => $request['Telphone'],
            'email'=>$request['email']
        ]);
        return redirect()->intended('/restaurant');
    }

    public function create()
    {
        return view('Restaurant.create');
    }

    public function edit($id)
    {
        $restaurant = Magasin::find($id);
        if ($restaurant == null) {
            return redirect()->intended('/restaurant');
        }
       

        return view('Restaurant.edit', ['restaurant' => $restaurant]);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Magasin::findOrFail($id);
        $this->validate($request, [
            'nom' => 'required|max:20',
            'adresse' => 'required|max:60',
            'Telphone' => 'required|max:60',
            'email' => 'required|email',
            ]);
        $input = [
            'nom' => $request['nom'],
            'adresse' => $request['adresse'],
            'Telphone' => $request['Telphone'],
            'email' => $request['email'],
        ];
        Magasin::where('id', $id)
            ->update($input);

        return redirect()->intended('/restaurant');
    }
    public function destroy($id)
    {
        Magasin::where('id', $id)->delete();
        return redirect()->intended('/restaurant');
    }
    public function search(Request $request) {
        $name= $request['name'];
        $query = Magasin::where('nom', 'like', '%' . $name . '%')
            ->paginate(5);
        return view('Restaurant.index', ['restaurants' => $query]);

    }
}
