<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Transformer\ProduitTransformer;
use App\Helpers\DatabaseConnection;
use Illuminate\Support\Facades\DB;
use Auth;

class chartController extends Controller
{        use Helpers;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var=Auth::user()->role;
        if($var!=0){
        $connection= new DatabaseConnection ();
        $ticketv = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_MtTTC) as TotaleVente"))
        ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')->get();
        $ticketa = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))
        ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')->get();
        $ticketa = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))
        ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')->get();
        $ticket = $connection->setConnection()->table('Ticket')->select( DB::raw(" Count(*) as NBTick"))->get();


      return view('Vente.dashboardVente',['vente'=>$ticketv->toArray(),'achat'=>$ticketa->toArray(),'TotaleTik'=>$ticket->toArray(),'title'=>"Totale"]);
    }
    else {
       return redirect('/');
    }
    }
    public function produit()
    { $var=Auth::user()->role;
        if($var!=0){
        $connection= new DatabaseConnection ();

        $ALLfamille = $connection->setConnection()->table('famille')->select('famille.FAM_Code','famille.FAM_Lib')->get();
      return view('Vente.parProduit',compact('ALLfamille', 'ALLfamille'),['title'=>"Par Produit"]);
    }
    else {
       return redirect('/');
    }
    }
    public function vendeur()
    {

        $var=Auth::user()->role;
        if($var!=0){
      return view('Vente.parVendeur',['title'=>"Par Vendeur"]);
    }
    
    else {
       return redirect('/');
    }
    }
    public function depence()
    {

        $var=Auth::user()->role;
        if($var!=0){
      return view('Vente.depence',['title'=>"Dépence"]);
    }
    
    else {
       return redirect('/');
    }
    }
    public function Commercial()
    {

        $var=Auth::user()->role;
        if($var!=0){
      return view('Vente.parCommercial',['title'=>"Par Commercial"]);
    }
    
    else {
       return redirect('/');
    }
    }
    public function caisse()
    { $var=Auth::user()->role;
        if($var!=0){
        $connection= new DatabaseConnection ();

        $ticketv = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_MtTTC) as TotaleVente"))
        ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')->get();
        
        $ticket = $connection->setConnection()->table('Ticket')->select( DB::raw(" Count(*) as NBTick"))->get();
        
        
      return view('Vente.parCaise',['vente'=>$ticketv->toArray(),'TotaleTik'=>$ticket->toArray(),'title'=>"Par Caisse"]);
    }
    else {
       return redirect('/');
    }
    }

    public function reglement()
    { $var=Auth::user()->role;
        if($var!=0){
        $connection= new DatabaseConnection ();

        $TotalRecu = $connection->setConnection()->table('ReglementCaisse')
        ->join('Ticket', function($join)
        {
            $join->on('ReglementCaisse.REGC_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('ReglementCaisse.REGC_Exercice', '=', 'Ticket .TIK_Exerc');
            $join->on('ReglementCaisse.REGC_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
        ->select( DB::raw(" sum(REGC_MntTotalRecue) as MontantTotale"))
        ->where('Ticket.TIK_Annuler', '<>', true)->orWhereNull('Ticket.TIK_Annuler')
        ->get();
        $Totalespece = $connection->setConnection()->table('ReglementCaisse')
        ->join('Ticket', function($join)
        {
            $join->on('ReglementCaisse.REGC_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('ReglementCaisse.REGC_Exercice', '=', 'Ticket .TIK_Exerc');
            $join->on('ReglementCaisse.REGC_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
        ->select( DB::raw(" sum(REGC_MntEspece) as Totalespece"))
        ->where('Ticket.TIK_Annuler', '<>', true)->orWhereNull('Ticket.TIK_Annuler')
        ->get();
        $Totalcheque = $connection->setConnection()->table('ReglementCaisse')
        ->join('Ticket', function($join)
        {
            $join->on('ReglementCaisse.REGC_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('ReglementCaisse.REGC_Exercice', '=', 'Ticket .TIK_Exerc');
            $join->on('ReglementCaisse.REGC_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
        ->select( DB::raw(" sum(ReglementCaisse.REGC_MntChéque) as Totalcheque"))
        ->where('Ticket.TIK_Annuler', '<>', true)->orWhereNull('Ticket.TIK_Annuler')
        ->get();
        $Totalcarte = $connection->setConnection()->table('ReglementCaisse')
        ->join('Ticket', function($join)
        {
            $join->on('ReglementCaisse.REGC_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('ReglementCaisse.REGC_Exercice', '=', 'Ticket .TIK_Exerc');
            $join->on('ReglementCaisse.REGC_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
        ->select( DB::raw(" sum(REGC_MntCarteBancaire) as Totalcarte"))
        ->where('Ticket.TIK_Annuler', '<>', true)->orWhereNull('Ticket.TIK_Annuler')
        ->get();
        $Totaltrait = $connection->setConnection()->table('ReglementCaisse')
        ->join('Ticket', function($join)
        {
            $join->on('ReglementCaisse.REGC_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('ReglementCaisse.REGC_Exercice', '=', 'Ticket .TIK_Exerc');
            $join->on('ReglementCaisse.REGC_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
        ->select( DB::raw(" sum(REGC_MntTraite) as Totaltrait"))
        ->where('Ticket.TIK_Annuler', '<>', true)->orWhereNull('Ticket.TIK_Annuler')
        ->get();
        $ticketv = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_MtTTC) as TotaleVente"))
        ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')->get();

  
      return view('Vente.Reglement',['TotalRecu'=>$TotalRecu->toArray(),'Totalespece'=>$Totalespece->toArray()
      ,'Totalcheque'=>$Totalcheque->toArray(),'Totalcarte'=>$Totalcarte->toArray()
      ,'Totaltrait'=>$Totaltrait->toArray(),'vente'=>$ticketv->toArray(),'title'=>"réglement"]);
    }
    else {
       return redirect('/');
    }
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
