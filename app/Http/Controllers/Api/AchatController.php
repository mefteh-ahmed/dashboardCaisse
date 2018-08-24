<?php

namespace App\Http\Controllers\api;
use App\Helpers\DatabaseConnection;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\LigneTicket;
class AchatController extends Controller
{    use Helpers;
        public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
public function index() { 
        $var=Auth::user()->role;
        if($var!=0){
        $connection= new DatabaseConnection ();
       $ticketa = $connection->setConnection()->table('LigneTicket')->select(DB::raw('SUM(LT_PACHAT*LT_Qte) as TotaleAchat'))->get();
       $ticketa->toArray();
     return view('achat.dashboardachat',compact('ticketa'),['title'=>"Total"]);
}
else {
   return redirect('/');
}
     }
public function Produit() { 
        $var=Auth::user()->role;
        if($var!=0){
        $connection= new DatabaseConnection ();

        $ALLfamille = $connection->setConnection()->table('famille')->select('famille.FAM_Code','famille.FAM_Lib')->get();
    return view('achat.parproduit',compact('ALLfamille', 'ALLfamille'),['title'=>"Par Produit"]);
}
else {
   return redirect('/');
}
   }
public function filterProduit(Request $request){
        $connection= new DatabaseConnection ();

        $articles = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr')
         ->select(DB::raw(" sum(LIG_BonEntree_Qte) as LIG_BonEntree_Qte,ART_Designation"))
          ->groupBy(DB::raw("LIG_BonEntree_CodeArt,ART_Designation"))
          ->orderByRaw(DB::raw('LIG_BonEntree_Qte DESC' ))->take(5)->get();
        return $this->response->array($articles->toArray()); // Use this if you using Dingo Api Routing Helpers
   }
public function Famille() { 
        $var=Auth::user()->role;
        if($var!=0){
    return view('achat.parfamille',['title'=>"Par Famille"]);
}
else {
   return redirect('/');
}
 }
public function Marque() { 
        $var=Auth::user()->role;
        if($var!=0){
    return view('achat.parmarque',['title'=>"Par Marque"]);
}
else {
   return redirect('/');
}
 }
 public function Fournisseur() { 
        $var=Auth::user()->role;
        if($var!=0){
    return view('achat.parfournisseur',['title'=>"Par Fournisseur"]);
}
else {
   return redirect('/');
}
 }
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function articleachat(Request $request) { 
        $connection= new DatabaseConnection ();

        $ticket = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr')
        ->select( DB::raw("sUM(LIG_BonEntree_MntTTC) as TotaleAchat ,FORMAT (BON_ENT_Date,  'yyyy-MM-dd', 'en-US' ) as year,sum(LIG_BonEntree_Qte) as qte"))
        ->whereRaw(DB::raw("BON_ENT_Date between '$request->from' and '$request->to' and ART_Code='$request->art' "))
        ->groupBy(DB::raw("ART_Code,FORMAT ( BON_ENT_Date,  'yyyy-MM-dd', 'en-US' )"))->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))
        ->take($request->req)->get();
       
            return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers

    }
public function TotalAchat() { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
public function TotaleProdExercice() { 
        $connection= new DatabaseConnection ();

        $tickets = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr') 
                                      ->select(DB::raw(" BON_ENT_Exer as year,sum(LIG_BonEntree_MntTTC) as TotaleAchat"))
                                      ->groupBy(DB::raw("BON_ENT_Exer"))
                                      ->get();
   
        return $this->response->array($tickets->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
public function TotaleAchatDate(Request $request) { 
        $connection= new DatabaseConnection ();

        $tickets = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr') 
                                        ->select(DB::raw(" FORMAT ( BON_ENT_Date,  'yyyy-MM-dd', 'en-US' ) as year,sum(LIG_BonEntree_MntTTC) as TotaleAchat"))
                                        ->whereRaw(DB::raw("BON_ENT_Date between '$request->from' and '$request->to'"))
                                        ->groupBy(DB::raw("FORMAT ( BON_ENT_Date, 'yyyy-MM-dd', 'en-US' )"))
                                        ->orderBy(DB::raw("FORMAT ( BON_ENT_Date, 'yyyy-MM-dd', 'en-US' )"))->get();
               
        return $this->response->array($tickets->toArray()); // Use this if you using Dingo Api Routing Helpers
              
        }
public function TotaleAchat(Request $request) { 
        $connection= new DatabaseConnection ();

        $tickets = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr') 
                                        ->select(DB::raw("sum(LIG_BonEntree_MntTTC) as TotaleAchat"))
                                        ->whereRaw(DB::raw("BON_ENT_Date between '$request->from' and '$request->to'"))
                                        ->get();
        return $this->response->array($tickets->toArray()); // Use this if you using Dingo Api Routing Helpers
        }

public function Top10artAchat(Request $request) { 
        $connection= new DatabaseConnection ();

            $articles = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr')
            ->select(DB::raw(" sum(LIG_BonEntree_MntTTC) as TotaleAchat,ART_Designation"))
            ->whereRaw(DB::raw("BON_ENT_Date between '$request->from' and '$request->to'"))
                 ->groupBy(DB::raw("LIG_BonEntree_CodeArt,ART_Designation"))
                  ->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))->take($request->req)->get();
               
               // return response()->json($articles);
                return $this->response->array($articles->toArray()); // Use this if you using Dingo Api Routing Helpers
    
        }
public function Top10Famil(Request $request) {
        $connection= new DatabaseConnection ();
 
            $familles = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr')
            ->select(DB::raw("ART_Famille,FAM_Lib,sum(LIG_BonEntree_MntTTC) as TotaleAchat"))
            ->whereRaw(DB::raw("BON_ENT_Date between '$request->from' and '$request->to'"))
                 ->groupBy(DB::raw("ART_Famille,FAM_Lib"))
                 ->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))->take($request->req)
                 ->get();
                 
           
               // return response()->json($articles);
                return $this->response->array($familles->toArray()); // Use this if you using Dingo Api Routing Helpers
    
        }
public function Top10Marque(Request $request) { 
        $connection= new DatabaseConnection ();

            $familles = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr')
            ->select(DB::raw("MAR_Code,MAR_Designation,sum(LIG_BonEntree_MntTTC) as TotaleAchat"))
            ->whereRaw(DB::raw("BON_ENT_Date between '$request->from' and '$request->to'"))
                 ->groupBy(DB::raw("MAR_Code,MAR_Designation"))
                 ->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))->take($request->req)
                 ->get();
                 
               // return response()->json($articles);
                return $this->response->array($familles->toArray()); // Use this if you using Dingo Api Routing Helpers
    
        }
public function Top10Fournisseur(Request $request) { 
        $connection= new DatabaseConnection ();

            $familles = $connection->setConnection()->table('View_BonEntree_Lignebn_Art_fr')
            ->select(DB::raw("BON_ENT_CodeFrs,FRS_Nomf,sum(LIG_BonEntree_MntTTC) as TotaleAchat"))
            ->whereRaw(DB::raw("BON_ENT_Date between '$request->from' and '$request->to'"))
            ->groupBy(DB::raw("BON_ENT_CodeFrs,FRS_Nomf"))
            ->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))->take($request->req)
            ->get();
                 
      
               // return response()->json($articles);
                return $this->response->array($familles->toArray()); // Use this if you using Dingo Api Routing Helpers
    
        }


public function create()
       {
        //
       }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
     {
        //
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function show($id)
     {
        //
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function edit($id)
     {
        //
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $id)
     {
        //
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
     {
        //
     }
public function listfournisseur(Request $request){

        $connection= new DatabaseConnection ();

        $fournisseurs = $connection->setConnection()->table('fournisseur')->get();
                      
        $fournisseurs= json_decode($fournisseurs, true);
      return view('achat.fournisseur',compact('fournisseurs'));
        //return response()->json($fournisseurs);
     }


}
