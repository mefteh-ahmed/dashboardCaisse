<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Dingo\Api\Routing\Helpers;
use App\ChainedeRestauration;
use App\Magasin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class RestaurantController extends Controller
{
    use Helpers;

    protected $redirectTo = '/magasin';
    public function getMagByChaine($req)
    {
        $Magasin= Magasin::where('id_chaine',$req)->get();

        return $this->response->array($Magasin->toArray()); 
       }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $var=Auth::user()->role;
        if($var==0){
            $restaurant = DB::table('magasin')
            ->leftJoin('chaine_restauration', 'magasin.id_chaine', '=', 'chaine_restauration.id')
            ->select('magasin.id', 'magasin.nom','magasin.email','magasin.adresse','magasin.Telphone','chaine_restauration.nom_chaine as chaine_name', 'chaine_restauration.id as chaine_id')
            ->paginate(5);

        return view('Restaurant.index', ['restaurants' => $restaurant]);
        }
        else {
            return redirect('/dashboard');
         } 
    }

    public function store(Request $request)
    {
        $constraints = [
            'nom' => 'required|max:20',
            'adresse' => 'required|max:60',
            'email'=>'required|email',
            'Telphone'=>'max:8',
            'id_chaine' => 'max:60',
        ];
        $this->validate($request, $constraints);
        Magasin::create([
            'nom' => $request['nom'],
            'adresse' => $request['adresse'],
            'Telphone' => $request['Telphone'],
            'email'=>$request['email'],
            'id_chaine' => $request['id_chaine']
        ]);
        return redirect()->intended('/magasin');
    }

    public function create()
    {$chaines = ChainedeRestauration::all();
        return view('Restaurant.create', ['chaines' => $chaines]);
  
    }

    public function edit($id)
    {
        $restaurant = Magasin::find($id);
        if ($restaurant == null) {
            return redirect()->intended('/magasin');
        }
       
        $chaines = ChainedeRestauration::all();
        return view('Restaurant.edit', ['chaines' => $chaines, 'restaurant' => $restaurant]);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Magasin::findOrFail($id);
        $this->validate($request, [
            'nom' => 'required|max:20',
            'adresse' => 'required|max:60',
            'Telphone' => 'required|max:60',
            'email' => 'required|email',
            'id_chaine' => 'max:60'
            ]);
        $input = [
            'nom' => $request['nom'],
            'adresse' => $request['adresse'],
            'Telphone' => $request['Telphone'],
            'email' => $request['email'],
            'id_chaine' => $request['id_chaine']
        ];
        Magasin::where('id', $id)
            ->update($input);

        return redirect()->intended('/magasin');
    }
    public function destroy($id)
    {
        Magasin::where('id', $id)->delete();
        return redirect()->intended('/magasin');
    }
    public function search(Request $request) {
        $name= $request['name'];
        $query = Magasin::where('nom', 'like', '%' . $name . '%')
            ->paginate(5);
        return view('Restaurant.index', ['restaurants' => $query]);

    }
}
