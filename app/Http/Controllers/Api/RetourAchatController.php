<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\LigneTicket;
class RetourAchatController extends Controller
{    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
public function index() { 
      
     return view('retourAchat.dashboardAchat',['title'=>"Total"]);
     }
public function Produit() { 
    return view('retourAchat.parproduit',['title'=>"Par Produit"]);

   }

public function Famille() { 
    return view('retourAchat.parfamille',['title'=>"Par Famille"]);

 }
public function Marque() { 
    return view('retourAchat.parmarque',['title'=>"Par Marque"]);

 }
 public function Fournisseur() { 
    return view('retourAchat.parfournisseur',['title'=>"Par Fournisseur"]);

 }
 public function filterProduit(Request $request){
 
        $articles = DB::table('View_BonRetour_Lignebn_Art_fr')
         ->select(DB::raw(" sum(LIG_BonEntree_Qte) as LIG_BonEntree_Qte,ART_Designation"))
          ->groupBy(DB::raw("LIG_BonEntree_CodeArt,ART_Designation"))
          ->orderByRaw(DB::raw('LIG_BonEntree_Qte DESC' ))->take(5)->get();
        return $this->response->array($articles->toArray()); // Use this if you using Dingo Api Routing Helpers
   }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


public function TotaleRetourExercice() { 
        $tickets = DB::table('View_BonRetour_Lignebn_Art_fr') 
                                      ->select(DB::raw(" BOR_Exercice as year,sum(LIG_BonEntree_MntTTC) as TotaleRetourAchat"))
                                      ->groupBy(DB::raw("BOR_Exercice"))
                                      ->get();
   
        return $this->response->array($tickets->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
public function TotaleretourAchatDate(Request $request) { 
        $tickets = DB::table('View_BonRetour_Lignebn_Art_fr') 
                                        ->select(DB::raw(" FORMAT ( BOR_date,  'yyyy-MM-dd', 'en-US' ) as year,sum(LIG_BonEntree_MntTTC) as TotaleRetourAchat"))
                                        ->whereRaw(DB::raw("BOR_date between '$request->from' and '$request->to'"))
                                        ->groupBy(DB::raw("FORMAT ( BOR_date, 'yyyy-MM-dd', 'en-US' )"))
                                        ->orderBy(DB::raw("FORMAT ( BOR_date, 'yyyy-MM-dd', 'en-US' )"))->get();
               
        return $this->response->array($tickets->toArray()); // Use this if you using Dingo Api Routing Helpers
              
        }
public function TotaleretourAchat(Request $request) { 
        $tickets = DB::table('View_BonRetour_Lignebn_Art_fr') 
                                        ->select(DB::raw("sum(LIG_BonEntree_MntTTC) as TotaleRetourAchat"))
                                        ->whereRaw(DB::raw("BOR_date between '$request->from' and '$request->to'"))
                                        ->get();
        return $this->response->array($tickets->toArray()); // Use this if you using Dingo Api Routing Helpers
        }

public function Top10artretourAchat(Request $request) { 
            $articles = DB::table('View_BonRetour_Lignebn_Art_fr')
            ->select(DB::raw(" sum(LIG_BonEntree_MntTTC) as TotaleretourAchat,ART_Designation"))
            ->whereRaw(DB::raw("BOR_date between '$request->from' and '$request->to'"))
                 ->groupBy(DB::raw("LIG_BonEntree_CodeArt,ART_Designation"))
                  ->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))->take($request->req)->get();
               
               // return response()->json($articles);
                return $this->response->array($articles->toArray()); // Use this if you using Dingo Api Routing Helpers
    
        }
public function Top10FamilretourAchat(Request $request) { 
            $familles = DB::table('View_BonRetour_Lignebn_Art_fr')
            ->select(DB::raw("FAM_Code,FAM_Lib,sum(LIG_BonEntree_MntTTC) as TotaleRetourAchat"))
            ->whereRaw(DB::raw("BOR_date between '$request->from' and '$request->to'"))
                 ->groupBy(DB::raw("FAM_Code,FAM_Lib"))
                 ->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))->take($request->req)
                 ->get();
                 
           
               // return response()->json($articles);
                return $this->response->array($familles->toArray()); // Use this if you using Dingo Api Routing Helpers
    
        }
public function Top10MarqueretourAchat(Request $request) { 
            $familles = DB::table('View_BonRetour_Lignebn_Art_fr')
            ->select(DB::raw("MAR_Code,MAR_Designation,sum(LIG_BonEntree_MntTTC) as TotaleRetourAchat"))
            ->whereRaw(DB::raw("BOR_date between '$request->from' and '$request->to'"))
                 ->groupBy(DB::raw("MAR_Code,MAR_Designation"))
                 ->orderByRaw(DB::raw('sum(LIG_BonEntree_MntTTC) DESC' ))->take($request->req)
                 ->get();
                 
               // return response()->json($articles);
                return $this->response->array($familles->toArray()); // Use this if you using Dingo Api Routing Helpers
    
        }
public function Top10Fournisseurretour(Request $request) { 
            $familles = DB::table('View_BonRetour_Lignebn_Art_fr')
            ->select(DB::raw("BOR_codefrs,FRS_Nomf,sum(LIG_BonEntree_MntTTC) as TotaleRetourAchat"))
            ->whereRaw(DB::raw("BOR_date between '$request->from' and '$request->to'"))
            ->groupBy(DB::raw("BOR_codefrs,FRS_Nomf"))
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
        $fournisseurs = DB::table('fournisseur')->get();
                      
        $fournisseurs= json_decode($fournisseurs, true);
      return view('retourAchat.fournisseur',compact('fournisseurs'));
        //return response()->json($fournisseurs);
     }


}
