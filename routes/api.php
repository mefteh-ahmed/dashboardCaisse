<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'cors'],function ($api) {
    $api->get('/', 'App\Http\Controllers\Back\AdminController@index');
    
    $api->get('produit', 'App\Http\Controllers\Api\ProduitController@index');
    $api->get('/home', 'App\Http\Controllers\Api\HomeController@index');
    $api->get('chart', 'App\Http\Controllers\Api\chartController@index');
    $api->get('/produit', 'App\Http\Controllers\Api\chartController@produit');
    $api->get('/vendeur', 'App\Http\Controllers\Api\chartController@vendeur');
    $api->get('/caisse', 'App\Http\Controllers\Api\chartController@caisse');
    $api->get('/reglement', 'App\Http\Controllers\Api\chartController@reglement');
    $api->get('/chartachat', 'App\Http\Controllers\Api\chartController@indexachat');
    $api->get('/facture', 'App\Http\Controllers\Api\FactureController@index');
    $api->get('/ticket', 'App\Http\Controllers\Api\VenteController@index');
    $api->get('/ligneticket', 'App\Http\Controllers\Api\VenteController@index');
    $api->get('/article', 'App\Http\Controllers\Api\ArticleController@index');
    $api->get('/tolalVente', 'App\Http\Controllers\Api\VenteController@TotalVente');
    $api->get('/tolalachat', 'App\Http\Controllers\Api\VenteController@TotalAchat');
    $api->get('/tolalex', 'App\Http\Controllers\Api\VenteController@TotalExercice');
    $api->get('/Top10art/{req}/{from}/{to}', 'App\Http\Controllers\Api\VenteController@Top10art');
    $api->get('/Top10fam/{req}/{from}/{to}', 'App\Http\Controllers\Api\VenteController@Top10fam');
    $api->get('/Top10mar/{req}/{from}/{to}', 'App\Http\Controllers\Api\VenteController@Top10Marque');
    $api->get('/CaParVendeur/{from}/{to}', 'App\Http\Controllers\Api\VenteController@CaParVendeur');
    $api->get('/NBTickParCaisse/{from}/{to}', 'App\Http\Controllers\Api\VenteController@NBTickParCaisse');
    $api->get('/TotaleTick/{from}/{to}', 'App\Http\Controllers\Api\VenteController@TotaleTick');
    $api->get('/TotalVenteDate/{from}/{to}', 'App\Http\Controllers\Api\VenteController@TotalVenteDate');
    $api->get('/test', 'App\Http\Controllers\Api\AchatController@test');
    $api->get('/reglement/{from}/{to}', 'App\Http\Controllers\Api\VenteController@Reglement');
    $api->get('/TotalVentefilter/{from}/{to}', 'App\Http\Controllers\Api\VenteController@TotalVentefilter');
    $api->get('/TotalAchatfilter/{from}/{to}', 'App\Http\Controllers\Api\VenteController@TotalAchatfilter');
    $api->get('/articlevente/{art}/{from}/{to}', 'App\Http\Controllers\Api\VenteController@article');
    $api->get('/ALLarticle/{codfamm}', 'App\Http\Controllers\Api\VenteController@ALLarticle');

    $api->get('/home', 'HomeController@index')->name('home');
    $api->get('/chart', 'App\Http\Controllers\Api\chartController@index')->name('chart');
    $api->get('/chartachat', 'App\Http\Controllers\Api\achatController@index')->name('chartachat');

    $api->get('/fourn', 'App\Http\Controllers\Api\AchatController@listfournisseur');
    $api->get('/Top10artAchat/{req}/{from}/{to}', 'App\Http\Controllers\Api\AchatController@Top10artAchat');
    $api->get('/prodParYear', 'App\Http\Controllers\Api\AchatController@TotaleProdExercice');
    $api->get('/Top10Famil/{req}/{from}/{to}', 'App\Http\Controllers\Api\AchatController@Top10Famil');
    $api->get('/Top10Marque/{req}/{from}/{to}', 'App\Http\Controllers\Api\AchatController@Top10Marque');
    $api->get('/Top10Fournisseur/{req}/{from}/{to}', 'App\Http\Controllers\Api\AchatController@Top10Fournisseur');
    $api->get('/parProduit', 'App\Http\Controllers\Api\AchatController@Produit');
    $api->get('/parFamille', 'App\Http\Controllers\Api\AchatController@Famille');
    $api->get('/parMarque', 'App\Http\Controllers\Api\AchatController@Marque');
    $api->get('/parFournisseur', 'App\Http\Controllers\Api\AchatController@Fournisseur');
    $api->get('/filterProduit', 'App\Http\Controllers\Api\AchatController@filterProduit');
    $api->get('/TotaleAchatDate/{from}/{to}', 'App\Http\Controllers\Api\AchatController@TotaleAchatDate');
    $api->get('/TotaleAchat/{from}/{to}', 'App\Http\Controllers\Api\AchatController@TotaleAchat');
    $api->get('/articleachat/{art}/{from}/{to}', 'App\Http\Controllers\Api\AchatController@articleachat');


   $api->get('/chartRetourAchat', 'App\Http\Controllers\Api\RetourAchatController@index');
    $api->get('/TotaleRetourExercice', 'App\Http\Controllers\Api\RetourAchatController@TotaleRetourExercice');
    $api->get('/Top10artretourAchat/{req}/{from}/{to}', 'App\Http\Controllers\Api\RetourAchatController@Top10artretourAchat');
    $api->get('/Top10FamilretourAchat/{req}/{from}/{to}', 'App\Http\Controllers\Api\RetourAchatController@Top10FamilretourAchat');
    $api->get('/Top10MarqueretourAchat/{req}/{from}/{to}', 'App\Http\Controllers\Api\RetourAchatController@Top10MarqueretourAchat');
    $api->get('/Top10FournisseurRetour/{req}/{from}/{to}', 'App\Http\Controllers\Api\RetourAchatController@Top10Fournisseurretour');
    $api->get('/parProduitRetour', 'App\Http\Controllers\Api\RetourAchatController@Produit');
    $api->get('/parFournisseurRetour', 'App\Http\Controllers\Api\RetourAchatController@Fournisseur');
    $api->get('/filterProduitRetour', 'App\Http\Controllers\Api\RetourAchatController@filterProduit');
    $api->get('/TotaleAchatDateRetour/{from}/{to}', 'App\Http\Controllers\Api\RetourAchatController@TotaleretourAchatDate');
    $api->get('/TotaleAchatRetour/{from}/{to}', 'App\Http\Controllers\Api\RetourAchatController@TotaleAchat');

});




