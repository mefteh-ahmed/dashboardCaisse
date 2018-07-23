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

$api->version('v1', function ($api) {
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
    $api->get('/Top10art/{req}/{year}', 'App\Http\Controllers\Api\LigneTicketController@Top10art');
    $api->get('/Top10fam/{req}/{year}', 'App\Http\Controllers\Api\LigneTicketController@Top10fam');
    $api->get('/Top10mar/{req}/{year}', 'App\Http\Controllers\Api\LigneTicketController@Top10Marque');
    $api->get('/CaParVendeur', 'App\Http\Controllers\Api\LigneTicketController@CaParVendeur');
    $api->get('/NBTickParCaisse', 'App\Http\Controllers\Api\LigneTicketController@NBTickParCaisse');
    $api->get('/TotaleTick', 'App\Http\Controllers\Api\LigneTicketController@TotaleTick');
    $api->get('/TotalVenteDate', 'App\Http\Controllers\Api\LigneTicketController@TotalVenteDate');
    $api->get('/test', 'App\Http\Controllers\Api\AchatController@test');
});