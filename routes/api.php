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
    $api->get('/ticket', 'App\Http\Controllers\Api\TicketController@index');
    $api->get('/ligneticket', 'App\Http\Controllers\Api\LigneTicketController@index');
    $api->get('/article', 'App\Http\Controllers\Api\ArticleController@index');
    $api->get('/tolalVente', 'App\Http\Controllers\Api\LigneTicketController@TotalVente');
    $api->get('/tolalachat', 'App\Http\Controllers\Api\LigneTicketController@TotalAchat');
    $api->get('/tolalex', 'App\Http\Controllers\Api\LigneTicketController@TotalExercice');
    $api->get('/Top10art/{req}/{from}/{to}', 'App\Http\Controllers\Api\LigneTicketController@Top10art');
    $api->get('/Top10fam/{req}/{from}/{to}', 'App\Http\Controllers\Api\LigneTicketController@Top10fam');
    $api->get('/Top10mar/{req}/{from}/{to}', 'App\Http\Controllers\Api\LigneTicketController@Top10Marque');
    $api->get('/CaParVendeur', 'App\Http\Controllers\Api\LigneTicketController@CaParVendeur');
    $api->get('/NBTickParCaisse', 'App\Http\Controllers\Api\LigneTicketController@NBTickParCaisse');
    $api->get('/TotaleTick', 'App\Http\Controllers\Api\LigneTicketController@TotaleTick');
    $api->get('/TotalVenteDate', 'App\Http\Controllers\Api\LigneTicketController@TotalVenteDate');
    $api->get('/test', 'App\Http\Controllers\Api\AchatController@test');


    $api->get('/home', 'HomeController@index')->name('home');
    $api->get('/chart', 'App\Http\Controllers\Api\chartController@index')->name('chart');
    $api->get('/chartachat', 'App\Http\Controllers\Api\achatController@index')->name('chartachat');
    $api->get('/fourn', 'App\Http\Controllers\Api\AchatController@listfournisseur');
    $api->get('/Top10artAchat', 'App\Http\Controllers\Api\AchatController@Top10artAchat');
    $api->get('/prodParYear', 'App\Http\Controllers\Api\AchatController@TotaleProdExercice');
    $api->get('/Top10Famil', 'App\Http\Controllers\Api\AchatController@Top10Famil');
    $api->get('/Top10Marque', 'App\Http\Controllers\Api\AchatController@Top10Marque');
    $api->get('/Top10Fournisseur', 'App\Http\Controllers\Api\AchatController@Top10Fournisseur');
    $api->get('/parProduit', 'App\Http\Controllers\Api\AchatController@Produit');
    $api->get('/parFamille', 'App\Http\Controllers\Api\AchatController@Famille');
    $api->get('/parMarque', 'App\Http\Controllers\Api\AchatController@Marque');
    $api->get('/parFournisseur', 'App\Http\Controllers\Api\AchatController@Fournisseur');
    $api->get('/filterProduit', 'App\Http\Controllers\Api\AchatController@filterProduit');
});