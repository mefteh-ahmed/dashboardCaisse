<?php

namespace App\Http\Controllers\api;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use App\Helpers\DatabaseConnection;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use App\Models\LigneTicket;
class VenteController extends Controller
{    use Helpers;
    public function __construct()
    {$connection= new DatabaseConnection ();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index() { 
        $connection= new DatabaseConnection ();
        // $LigneTicket = LigneTicket::all();
        $ticket = $connection->setConnection()->table('LigneTicket')->take(1000)->get();

        // $facture = facture::select('FACT_NomPrenomCli','FACT_CodeClient',sum('FACT_MntTTC as sum'))
        // ->groupBy('FACT_CodeClient','FACT_NomPrenomCli')->get();

     
        // $facture = facture::where('FACT_MntTTC', '>', '1000.000')->groupBy('FACT_CodeClient')->get();
        // $produit = Produit::paginate(5);
        //$users = Users::where('status', '=', 'active')->paginate(10);
        if($ticket->count()){
            // return response()->json(['data' => $client]); // Use this by default
            return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
            // return $this->response->collection($produit, new ProduitTransformer()); // Use this if you using Fractal <=> Create a resource collection transformer
        //    return $this->response->paginator($produit, new ProduitTransformer()); // Use this if you using Fractal Responding With Paginated Items 
        }}
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function TotalVentefilter(Request $request) { 
        $connection= new DatabaseConnection ();
        $ticket = $connection->setConnection()->table('LigneTicket')
        ->join('Ticket', function($join)
        {
            $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
            $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })

        ->select(DB::raw("SUM(LT_MtTTC) as TotaleVente"))
       ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)"))->get();
        
            return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
}
public function TotalVenteAnnulerfilter(Request $request) { 
    $connection= new DatabaseConnection ();
    $ticket = $connection->setConnection()->table('LigneTicket')
    ->join('Ticket', function($join)
    {
        $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
        $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
        $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
    })

    ->select(DB::raw("SUM(LT_MtTTC) as TotaleVenteAnnuler"))
   ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
        and( [Ticket].[TIK_Annuler] = 1)"))->get();
    
        return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
}

    public function TotalAchatfilter(Request $request) { 
        $connection= new DatabaseConnection ();
        $ticket = $connection->setConnection()->table('LigneTicket')
            ->join('Ticket', function($join)
                 {
                    $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
                    $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
                    $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
                })

                ->select(DB::raw("SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))
                ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
                             and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)"))->get();
    
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
            }
            public function Totaldepence(Request $request) { 
                $connection= new DatabaseConnection ();
                $ticket = $connection->setConnection()->table('depence_caisse')
                ->join('DEPENCE', 'depence_caisse.DEP_Code', '=', 'DEPENCE.DEP_Code')
                ->join('Utilisateur', 'depence_caisse.DEP_User', '=', 'Utilisateur.Code_Ut')

        
                        ->select(DB::raw("sum(depence_caisse.DEP_Montant)as depence "))
                        ->whereRaw(DB::raw("depence_caisse.DDm between '$request->from' and '$request->to'"))
                        ->get();

                        return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
                    }
            public function Alldepence(Request $request) { 
                $connection= new DatabaseConnection ();
                $ticket = $connection->setConnection()->table('depence_caisse')
                ->join('DEPENCE', 'depence_caisse.DEP_Code', '=', 'DEPENCE.DEP_Code')
                ->join('Utilisateur', 'depence_caisse.DEP_User', '=', 'Utilisateur.Code_Ut')

        
                        ->select(DB::raw("DEPENCE.DEP_Lib,sum(depence_caisse.DEP_Montant)as depence "))
                        ->whereRaw(DB::raw("depence_caisse.DDm between '$request->from' and '$request->to'"))
                        ->groupBy(DB::raw("DEPENCE.DEP_Code,DEPENCE.DEP_Lib"))
                        ->orderBy(DB::raw("sum(depence_caisse.DEP_Montant)"))->get();

                        return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
                    }
            public function depencebyUser(Request $request) { 
                $connection= new DatabaseConnection ();
                $ticket = $connection->setConnection()->table('depence_caisse')
                ->join('DEPENCE', 'depence_caisse.DEP_Code', '=', 'DEPENCE.DEP_Code')
                ->join('Utilisateur', 'depence_caisse.DEP_User', '=', 'Utilisateur.Code_Ut')
                ->select(DB::raw("sum(depence_caisse.DEP_Montant)as depence,CONCAT(Utilisateur.Nom ,' ', Utilisateur.Prenom) as Nom  "))
                ->whereRaw(DB::raw("depence_caisse.DDm between '$request->from' and '$request->to'"))
                ->groupBy(DB::raw("CONCAT(Utilisateur.Nom ,' ', Utilisateur.Prenom)"))->get();
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
                }
                public function depencebyUserDetail(Request $request) { 
                    $connection= new DatabaseConnection ();
                    $ticket = $connection->setConnection()->table('depence_caisse')
                    ->join('DEPENCE', 'depence_caisse.DEP_Code', '=', 'DEPENCE.DEP_Code')
                    ->join('Utilisateur', 'depence_caisse.DEP_User', '=', 'Utilisateur.Code_Ut')
                    ->select(DB::raw("sum(depence_caisse.DEP_Montant)as depence,CONCAT(Utilisateur.Nom ,' ', Utilisateur.Prenom) as Nom ,DEPENCE.DEP_Lib "))
                    ->whereRaw(DB::raw("depence_caisse.DDm between '$request->from' and '$request->to' and (CONCAT(Utilisateur.Nom ,' ', Utilisateur.Prenom) ='$request->cli')"))
                    ->groupBy(DB::raw("CONCAT(Utilisateur.Nom ,' ', Utilisateur.Prenom),DEPENCE.DEP_Lib"))->get();
                    return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
                    }  
    public function TotalVente() { 
        $connection= new DatabaseConnection ();
            $ticket = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_MtTTC) as TotaleVente"))
            ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
     
    public function TotalAchat() { 
        $connection= new DatabaseConnection ();
 
            $ticket = $connection->setConnection()->table('LigneTicket')->select(DB::raw("SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))
            ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
    public function TotalExercice() { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')
            ->select(DB::raw("LT_Exerc, SUM(LT_MtTTC) as TotaleVente ,SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))
            ->where('LT_Annuler', '<>', true)->orWhereNull('LT_Annuler')
            ->groupBy(DB::raw("LT_Exerc"))->get();
            if($ticket->count()){
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }}
        public function TotalVenteAnnulerDate(Request $request) { 
            $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')
            ->join('Ticket', function($join)
        {
            $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
            $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
            ->select(DB::raw("FORMAT ( Ticket.TIK_DateHeureTicket,  'yyyy-MM-dd', 'en-US' ) as year,SUM(LigneTicket.LT_MtTTC) as TotaleVenteAnnuler"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] = 1)"))
            
            ->groupBy(DB::raw("FORMAT ( Ticket.TIK_DateHeureTicket, 'yyyy-MM-dd', 'en-US' )"))
            ->orderBy(DB::raw("FORMAT ( Ticket.TIK_DateHeureTicket, 'yyyy-MM-dd', 'en-US' )"))->get();
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  }
    public function TotalVenteDate(Request $request) { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')
            ->join('Ticket', function($join)
        {
            $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
            $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
            ->select(DB::raw("FORMAT ( Ticket.TIK_DateHeureTicket,  'yyyy-MM-dd', 'en-US' ) as year,SUM(LigneTicket.LT_MtTTC) as TotaleVente ,SUM(LT_PACHAT*LT_Qte) as TotaleAchat"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)"))
            
            ->groupBy(DB::raw("FORMAT ( Ticket.TIK_DateHeureTicket, 'yyyy-MM-dd', 'en-US' )"))
            ->orderBy(DB::raw("FORMAT ( Ticket.TIK_DateHeureTicket, 'yyyy-MM-dd', 'en-US' )"))->get();
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
        public function ALLarticle(Request $request) { 
            $connection= new DatabaseConnection ();

            $ALLarticle = $connection->setConnection()->table('article')
            ->select('article.ART_Code','article.ART_Designation')
            ->where('article.ART_Famille', '=', $request->codfamm)
            ->get();
           
                return $this->response->array($ALLarticle->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
        public function article(Request $request) { 
            $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')
            ->join('article', 'LigneTicket.LT_CodArt', '=', 'article.ART_Code')
            ->join('Ticket', function($join)
            {
                $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
                $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
                $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
            })
            ->select( DB::raw("sUM(LigneTicket.LT_MtTTC) as TotaleVente ,FORMAT ( Ticket.TIK_DateHeureTicket,  'yyyy-MM-dd', 'en-US' ) as year,sum(LigneTicket.LT_Qte) as qte"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null) and LigneTicket.LT_CodArt='$request->art' "))
            ->groupBy(DB::raw("LigneTicket.LT_CodArt,FORMAT ( Ticket.TIK_DateHeureTicket,  'yyyy-MM-dd', 'en-US' )"))->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))
            ->take($request->req)->get();
           
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
    public function Top10art(Request $request) { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')
            ->join('article', 'LigneTicket.LT_CodArt', '=', 'article.ART_Code')
            ->join('Ticket', function($join)
            {
                $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
                $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
                $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
            })
            ->select( DB::raw("sUM(LigneTicket.LT_MtTTC) as TotaleVente ,article.ART_Designation"))
            // ->whereRaw(DB::raw("FORMAT(Ticket.TIK_DateHeureTicket,'yyyy')=$request->year"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'"))
            ->where('LigneTicket.LT_Annuler', '<>', true)->orWhereNull('LigneTicket.LT_Annuler')
            ->groupBy(DB::raw("LigneTicket.LT_CodArt,article.ART_Designation"))->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))->take($request->req)->get();
           
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
    public function Top10fam(Request $request) { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')
            ->join('article', 'LigneTicket.LT_CodArt', '=', 'article.ART_Code')
            ->join('famille', 'article.ART_Famille', '=', 'famille.FAM_Code')
            ->join('Ticket', function($join)
            {
                $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
                $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
                $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
            })
            ->select( DB::raw("famille.FAM_Lib , SUM(LigneTicket.LT_MtTTC) as TotaleVente"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'"))
            ->where('LigneTicket.LT_Annuler', '<>', true)->orWhereNull('LigneTicket.LT_Annuler')
            ->groupBy(DB::raw("article.ART_Famille,famille.FAM_Lib"))->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))->take($request->req)->get();
        
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
    public function Top10Marque(Request $request) { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('LigneTicket')
            ->join('article', 'LigneTicket.LT_CodArt', '=', 'article.ART_Code')
            ->join('marque', 'article.ART_Marque', '=', 'marque.MAR_Code')
            ->join('Ticket', function($join)
        {
            $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
            $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
            $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
        })
            ->select( DB::raw("marque.MAR_Designation , SUM(LigneTicket.LT_MtTTC) as TotaleVente"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'"))
            ->where('LigneTicket.LT_Annuler', '<>', true)->orWhereNull('LigneTicket.LT_Annuler')
           
            ->groupBy(DB::raw("article.ART_Marque,marque.MAR_Designation"))->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))->take($request->req)->get();
         
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
    public function CaParVendeur(Request $request) { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('Ticket')
            ->join('SessionCaisse', 'Ticket.TIK_IdSCaisse', '=', 'SessionCaisse.SC_IdSCaisse')
            ->join('Utilisateur', 'SessionCaisse.SC_CodeUtilisateur', '=', 'Utilisateur.Code_Ut')
            ->select( DB::raw("CONCAT(Utilisateur.Nom ,' ', Utilisateur.Prenom) as nom, SUM(Ticket.TIK_MtTTC) as TotaleVente"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)"))
            ->groupBy(DB::raw("SessionCaisse.SC_CodeUtilisateur,Utilisateur.Nom,Utilisateur.Prenom"))
            ->orderByRaw(DB::raw('sum(Ticket.TIK_MtTTC) DESC' ))->get();
        
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
        public function CaParCommercial(Request $request) { 
            $connection= new DatabaseConnection ();
    
                $ticket = $connection->setConnection()->table('Ticket')
                ->select( DB::raw("TIK_DESIG_COMMERCIAL, SUM(Ticket.TIK_MtTTC) as TotaleVente"))
                ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
                and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)and (TIK_DESIG_COMMERCIAL is not null)"))
                ->groupBy(DB::raw("TIK_DESIG_COMMERCIAL"))
                ->orderByRaw(DB::raw('sum(Ticket.TIK_MtTTC) DESC' ))->get();
          
                    return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
      
            }
            public function CaParCommercialByArticle(Request $request) { 
                $connection= new DatabaseConnection ();
        
                $ticket = $connection->setConnection()->table('LigneTicket')
                ->join('article', 'LigneTicket.LT_CodArt', '=', 'article.ART_Code')
                ->join('Ticket', function($join)
                {
                    $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
                    $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
                    $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
                })
                    ->select( DB::raw("article.ART_Designation,LigneTicket.LT_MtTTC ,SUM(LigneTicket.LT_MtTTC) as TotaleVente,SUM(LigneTicket.LT_PACHAT*LT_Qte) as TotaleAchat"))
                    ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
                    and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)and (TIK_DESIG_COMMERCIAL is not null)and (Ticket.TIK_DESIG_COMMERCIAL ='$request->comm')"))
                    ->groupBy(DB::raw("article.ART_Designation,LigneTicket.LT_MtTTC"))
                    ->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))->get();
              
                        return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
          
                }
                public function CaParCommercialByClient(Request $request) { 
                    $connection= new DatabaseConnection ();
            
                    $ticket = $connection->setConnection()->table('Ticket')
                    ->join('Client', 'Ticket.TIK_CodClt', '=', 'Client.CLI_Code')
                    ->join('LigneTicket', function($join)
                    {
                        $join->on('LigneTicket.LT_NumTicket', '=', 'Ticket.TIK_NumTicket ');
                        $join->on('LigneTicket.LT_Exerc', '=', 'Ticket .TIK_Exerc');
                        $join->on('LigneTicket.LT_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
                    })
                        ->select( DB::raw("Client.CLI_NomPren ,SUM(LigneTicket.LT_MtTTC) as TotaleVente,SUM(LigneTicket.LT_PACHAT*LT_Qte) as TotaleAchat"))
                        ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
                        and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)and (TIK_DESIG_COMMERCIAL is not null)and (Ticket.TIK_DESIG_COMMERCIAL ='$request->cli')"))
                        ->groupBy(DB::raw("Client.CLI_NomPren"))
                        ->orderByRaw(DB::raw('sum(LigneTicket.LT_MtTTC) DESC' ))->get();
                  
                            return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
              
                    }
        public function CaAnnulerParVendeur(Request $request) { 
            $connection= new DatabaseConnection ();
    
                $ticket = $connection->setConnection()->table('Ticket')
                ->join('SessionCaisse', 'Ticket.TIK_IdSCaisse', '=', 'SessionCaisse.SC_IdSCaisse')
                ->join('Utilisateur', 'SessionCaisse.SC_CodeUtilisateur', '=', 'Utilisateur.Code_Ut')
                ->select( DB::raw("CONCAT(Utilisateur.Nom ,' ', Utilisateur.Prenom) as nom, SUM(Ticket.TIK_MtTTC) as TotaleVente"))
                ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
                and( [Ticket].[TIK_Annuler] = 1)"))
                ->groupBy(DB::raw("SessionCaisse.SC_CodeUtilisateur,Utilisateur.Nom,Utilisateur.Prenom"))
                ->orderByRaw(DB::raw('sum(Ticket.TIK_MtTTC) DESC' ))->get();
            
                    return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
      
            }
            public function CaAnnulerParCommercial(Request $request) { 
                $connection= new DatabaseConnection ();
    
                $ticket = $connection->setConnection()->table('Ticket')
                ->select( DB::raw("TIK_DESIG_COMMERCIAL, SUM(Ticket.TIK_MtTTC) as TotaleVente"))
                ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
                and( [Ticket].[TIK_Annuler] = 1)and (TIK_DESIG_COMMERCIAL is not null)"))
                ->groupBy(DB::raw("TIK_DESIG_COMMERCIAL"))
                ->orderByRaw(DB::raw('sum(Ticket.TIK_MtTTC) DESC' ))->get();
            
                    return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
      
                }
    public function NBTickParCaisse(Request $request) { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('Ticket')
            ->join('SessionCaisse', 'Ticket.TIK_IdSCaisse', '=', 'SessionCaisse.SC_IdSCaisse')
            ->join('Caisse', 'SessionCaisse.SC_Caisse', '=', 'Caisse.CAI_IdCaisse')
            ->select( DB::raw("Caisse.CAI_DesCaisse , Count(*) as NBTick,SUM(Ticket.TIK_MtTTC) as TotaleVente"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)"))
            ->groupBy(DB::raw("Caisse.CAI_DesCaisse"))
            ->orderByRaw(DB::raw('Count(*) DESC' ))->get();
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
    public function TotaleTick(Request $request) { 
        $connection= new DatabaseConnection ();

            $ticket = $connection->setConnection()->table('Ticket')
            
            ->select( DB::raw(" Count(*) as NBTick"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)"))
            ->get();
         
                return $this->response->array($ticket->toArray()); // Use this if you using Dingo Api Routing Helpers
  
        }
    public function Reglement(Request $request) { 
        $connection= new DatabaseConnection ();

            $TotalRecu = $connection->setConnection()->table('ReglementCaisse')
            ->join('Ticket', function($join)
            {
                $join->on('ReglementCaisse.REGC_NumTicket', '=', 'Ticket.TIK_NumTicket ');
                $join->on('ReglementCaisse.REGC_Exercice', '=', 'Ticket .TIK_Exerc');
                $join->on('ReglementCaisse.REGC_IdCarnet', '=', 'Ticket .TIK_IdCarnet');
            })
            ->select( DB::raw(" sum(REGC_MntTotalRecue) as MontantTotale, sum(REGC_MntEspece) as Totalespece
            ,sum(ReglementCaisse.REGC_MntChéque) as Totalcheque,sum(REGC_MntCarteBancaire) as Totalcarte
            ,sum(REGC_MntTraite) as TotaltTicketResto"))
            ->whereRaw(DB::raw("TIK_DateHeureTicket between '$request->from' and '$request->to'
            and( [Ticket].[TIK_Annuler] <> 1 or [Ticket].[TIK_Annuler] is null)"))
            ->get();
            return $this->response->array($TotalRecu->toArray()); // Use this if you using Dingo Api Routing Helpers

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
