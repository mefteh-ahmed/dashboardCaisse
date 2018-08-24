<?php

namespace App\Http\Controllers\Back;
    
use Illuminate\Http\Request;
use App\Helpers\DatabaseConnection;
use Auth;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $var=Auth::user()->role;
        echo($var);
        if($var!=0){
        return view('back.index',['title'=>"dashboard"]);
    }
    else {
       return redirect('/');
    }
    }
   
    public function listMagasin()
    {
        $var=Auth::user()->role;
        if($var==1){
            $chaine=Auth::user()->id_chaine;
            $listMagasin = DB::table('magasin')
            ->leftJoin('chaine_restauration', 'magasin.id_chaine', '=', 'chaine_restauration.id')
            ->select('magasin.id', 'magasin.nom','magasin.email','magasin.adresse','magasin.Telphone','chaine_restauration.nom_chaine as chaine_name', 'chaine_restauration.id as chaine_id')
            ->where('magasin.id_chaine',$chaine)->get();

         
        return view('ListeMagasin.listMagasin', ['listMagasin' => $listMagasin]);
        }
        else {
            return redirect('/logout');
         }
      
    }



    public function magasinRoute($id)
    {Session(['id_magasin'=>$id]);
        // Auth::push('id_magasin', $id);
        return redirect('/dashboard');
    }



}
