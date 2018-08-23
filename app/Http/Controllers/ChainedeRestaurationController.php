<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\ChainedeRestauration;
use Illuminate\Http\Request;
use  Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Dingo\Api\Routing\Helpers;
class ChainedeRestaurationController extends Controller
{
    use Helpers;
    protected $redirectTo = '/chaine';


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $chaine = ChainedeRestauration::get();

        return view('ChaineDeRestauration.index', ['chaines' => $chaine]);
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $chaine= ChainedeRestauration::all();

        return $this->response->array($chaine->toArray()); 
       }

    public function store(Request $request)
    {
        ChainedeRestauration::create([
            'nom_chaine' => $request['nom_chaine'],
            'Fondateur' => $request['Fondateur'],
            'Mail' =>$request['Mail'],
            'telephone' =>$request['telephone'],
        ]);

        return redirect()->intended('/chaine');
    }

    public function create()
    {
        return view('ChaineDeRestauration.create');
    }

    public function edit($id)
    {
        $chaine = ChainedeRestauration::find($id);
        // Redirect to chaine list if updating ChainedeRestauration wasn't existed
        if ($chaine == null ) {
            return redirect()->intended('/chaine');
        }

        return view('ChaineDeRestauration/edit', ['chaine' => $chaine]);
    }

    public function update(Request $request, $id)
    {
        $ChainedeRestauration = ChainedeRestauration::findOrFail($id);
        $constraints = [
            'nom_chaine' => 'required|max:20',
            'Fondateur'=> 'required|max:60',
            'Mail' => 'required|max:60',
            'telephone' => 'required|max:60',
        ];
        $input = [
            'nom_chaine' => $request['nom_chaine'],
            'Fondateur' => $request['Fondateur'],
            'Mail' =>$request['Mail'],
            'telephone' =>$request['telephone'],
        ];
        $this->validate($request, $constraints);
        ChainedeRestauration::where('id', $id)
            ->update($input);

        return redirect()->intended('/chaine');
    }

    public function destroy($id)
    {
        ChainedeRestauration::where('id', $id)->delete();
        return redirect()->intended('/chaine');
    }
    public function search(Request $request) {
        $name= $request['name'];
        $query = ChainedeRestauration::where('nom_chaine', 'like', '%' . $name . '%')
            ->paginate(5);
        return view('ChaineDeRestauration.index', ['chaines' => $query]) ;


    }

}
