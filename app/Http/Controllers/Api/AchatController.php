<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use App\Models\LigneTicket;
class AchatController extends Controller
{    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index() { 
        // $LigneTicket = LigneTicket::all();
        $ticket = DB::table('LigneTicket')->take(1000)->get();

        // $facture = facture::select('FACT_NomPrenomCli','FACT_CodeClient',sum('FACT_MntTTC as sum'))
        // ->groupBy('FACT_CodeClient','FACT_NomPrenomCli')->get();

     
        // $facture = facture::where('FACT_MntTTC', '>', '1000.000')->groupBy('FACT_CodeClient')->get();
        // $produit = Produit::paginate(5);
        //$users = Users::where('status', '=', 'active')->paginate(10);
        if($LigneTicket->count()){
            // return response()->json(['data' => $client]); // Use this by default
            return $this->response->array($LigneTicket->toArray()); // Use this if you using Dingo Api Routing Helpers
            // return $this->response->collection($produit, new ProduitTransformer()); // Use this if you using Fractal <=> Create a resource collection transformer
        //    return $this->response->paginator($produit, new ProduitTransformer()); // Use this if you using Fractal Responding With Paginated Items 
        }}
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function TotalVente() { 
            $ticket = DB::table('LigneTicket')->select(DB::raw("SUM(LT_MtTTC) as TotaleVente"))->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
        public function TotalAchat() { 
            $ticket = DB::table('LigneTicket')->select(DB::raw("SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
        public function TotalExercice() { 
            $ticket = DB::table('LigneTicket')->select(DB::raw("LT_Exerc, SUM(LT_MtTTC) as TotaleVente ,SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))
            ->groupBy(DB::raw("LT_Exerc"))->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
        public function Top10art() { 
            $ticket = DB::table('LigneTicket')
            ->join('article', 'LigneTicket.LT_CodArt', '=', 'article.ART_Code')
            ->select( DB::raw("SUM(LigneTicket.LT_MtTTC) as TotaleVente ,article.ART_Designation"))
            ->groupBy(DB::raw("LigneTicket.LT_CodArt,article.ART_Designation"))->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))->take(10)->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
        public function Top10fam() { 
            $ticket = DB::table('LigneTicket')
            ->join('article', 'LigneTicket.LT_CodArt', '=', 'article.ART_Code')
            ->join('famille', 'article.ART_Famille', '=', 'famille.FAM_Code')
            ->select( DB::raw("SUM(LigneTicket.LT_MtTTC) as TotaleVente ,famille.FAM_Lib"))
            ->groupBy(DB::raw("article.ART_Famille,famille.FAM_Lib"))->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))->take(10)->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
        public function test() { 
    echo "fff";
        }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
}
