<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::prefix('admin')->namespace('Back')->group(function () {
//     Route::name('admin')->get('/', 'AdminController@index');
// });
// Route::get('/', function () {
//     return view('master');
// });
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/chart', 'Api\chartController@index')->name('chart');
// Route::get('/produit', 'Api\chartController@produit')->name('produit');
// Route::get('/vendeur', 'Api\chartController@vendeur')->name('vendeur');
// Route::get('/caisse', 'Api\chartController@caisse')->name('caisse');
// Route::get('/reglement', 'Api\chartController@reglement')->name('reglement');

// Route::get('/chartachat', 'Api\chartController@indexachat')->name('chartachat');

// Route::get('/facture', 'Api\FactureController@index')->name('facture');
// Route::get('/ticket', 'Api\TicketController@index')->name('ticket');
// Route::get('/ligneticket', 'Api\LigneTicketController@index')->name('ligneticket');
// Route::get('/article', 'Api\ArticleController@index')->name('article');
// Route::get('/tolalVente', 'Api\LigneTicketController@TotalVente')->name('tolalVente');
// Route::get('/tolalachat', 'Api\LigneTicketController@TotalAchat')->name('tolalachat');
// Route::get('/tolalex', 'Api\LigneTicketController@TotalExercice')->name('tolalex');
// Route::get('/Top10art/{req}/{year}', 'Api\LigneTicketController@Top10art')->name('Top10art');
// Route::get('/Top10fam/{req}/{year}', 'Api\LigneTicketController@Top10fam')->name('Top10fam');
// Route::get('/Top10mar/{req}/{year}', 'Api\LigneTicketController@Top10Marque')->name('Top10mar');
// Route::get('/CaParVendeur', 'Api\LigneTicketController@CaParVendeur')->name('CaParVendeur');
// Route::get('/NBTickParCaisse', 'Api\LigneTicketController@NBTickParCaisse')->name('NBTickParCaisse');
// Route::get('/TotaleTick', 'Api\LigneTicketController@TotaleTick')->name('TotaleTick');
// Route::get('/TotalVenteDate', 'Api\LigneTicketController@TotalVenteDate')->name('TotalVenteDate');
// Route::get('/test', 'Api\AchatController@test')->name('test');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/dashboard', 'Back\AdminController@index');
Route::get('/list', 'Back\AdminController@listMagasin');
Route::get('/magasinRoute/{id}', 'Back\AdminController@magasinRoute');

    Route::get('produit', 'Api\ProduitController@index');
    Route::get('/home', 'Api\HomeController@index');

    Route::get('chart', 'Api\chartController@index');
    Route::get('/produit', 'Api\chartController@produit');
    Route::get('/vendeur', 'Api\chartController@vendeur');
    Route::get('/Commercial', 'Api\chartController@Commercial');

    Route::get('/caisse', 'Api\chartController@caisse');
    Route::get('/reglement', 'Api\chartController@reglement');
    Route::get('/chartachat', 'Api\chartController@indexachat');
    Route::get('/facture', 'Api\FactureController@index');
    Route::get('/ticket', 'Api\VenteController@index');
    Route::get('/ligneticket', 'Api\VenteController@index');
    Route::get('/article', 'Api\ArticleController@index');
    Route::get('/tolalVente', 'Api\VenteController@TotalVente');
    Route::get('/TotalVenteAnnuler/{from}/{to}', 'Api\VenteController@TotalVenteAnnuler');
    Route::get('/TotalVenteAnnulerfilter/{from}/{to}', 'Api\VenteController@TotalVenteAnnulerfilter');

    Route::get('/tolalachat', 'Api\VenteController@TotalAchat');
    Route::get('/tolalex', 'Api\VenteController@TotalExercice');
    Route::get('/Top10art/{req}/{from}/{to}', 'Api\VenteController@Top10art');
    Route::get('/Top10fam/{req}/{from}/{to}', 'Api\VenteController@Top10fam');
    Route::get('/Top10mar/{req}/{from}/{to}', 'Api\VenteController@Top10Marque');
    Route::get('/CaParVendeur/{from}/{to}', 'Api\VenteController@CaParVendeur');
    Route::get('/CaParCommercial/{from}/{to}', 'Api\VenteController@CaParCommercial');

    Route::get('/CaAnnulerParCommercial/{from}/{to}', 'Api\VenteController@CaAnnulerParCommercial');

    Route::get('/CaAnnulerParVendeur/{from}/{to}', 'Api\VenteController@CaAnnulerParVendeur');
    
   
    Route::get('/NBTickParCaisse/{from}/{to}', 'Api\VenteController@NBTickParCaisse');
    Route::get('/TotaleTick/{from}/{to}', 'Api\VenteController@TotaleTick');
    Route::get('/TotalVenteDate/{from}/{to}', 'Api\VenteController@TotalVenteDate');
    Route::get('/test', 'Api\AchatController@test');
    Route::get('/reglement/{from}/{to}', 'Api\VenteController@Reglement');
    Route::get('/TotalVentefilter/{from}/{to}', 'Api\VenteController@TotalVentefilter');
    Route::get('/TotalAchatfilter/{from}/{to}', 'Api\VenteController@TotalAchatfilter');
    Route::get('/articlevente/{art}/{from}/{to}', 'Api\VenteController@article');
    Route::get('/ALLarticle/{codfamm}', 'Api\VenteController@ALLarticle');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/chart', 'Api\chartController@index')->name('chart');
    Route::get('/chartachat', 'Api\achatController@index')->name('chartachat');

    Route::get('/fourn', 'Api\AchatController@listfournisseur');
    Route::get('/Top10artAchat/{req}/{from}/{to}', 'Api\AchatController@Top10artAchat');
    Route::get('/prodParYear', 'Api\AchatController@TotaleProdExercice');
    Route::get('/Top10Famil/{req}/{from}/{to}', 'Api\AchatController@Top10Famil');
    Route::get('/Top10Marque/{req}/{from}/{to}', 'Api\AchatController@Top10Marque');
    Route::get('/Top10Fournisseur/{req}/{from}/{to}', 'Api\AchatController@Top10Fournisseur');
    Route::get('/parProduit', 'Api\AchatController@Produit');
    Route::get('/parFamille', 'Api\AchatController@Famille');
    Route::get('/parMarque', 'Api\AchatController@Marque');
    Route::get('/parFournisseur', 'Api\AchatController@Fournisseur');
    Route::get('/filterProduit', 'Api\AchatController@filterProduit');
    Route::get('/TotaleAchatDate/{from}/{to}', 'Api\AchatController@TotaleAchatDate');
    Route::get('/TotaleAchat/{from}/{to}', 'Api\AchatController@TotaleAchat');
    Route::get('/articleachat/{art}/{from}/{to}', 'Api\AchatController@articleachat');


   Route::get('/chartRetourAchat', 'Api\RetourAchatController@index');
    Route::get('/TotaleRetourExercice', 'Api\RetourAchatController@TotaleRetourExercice');
    Route::get('/Top10artretourAchat/{req}/{from}/{to}', 'Api\RetourAchatController@Top10artretourAchat');
    Route::get('/Top10FamilretourAchat/{req}/{from}/{to}', 'Api\RetourAchatController@Top10FamilretourAchat');
    Route::get('/Top10MarqueretourAchat/{req}/{from}/{to}', 'Api\RetourAchatController@Top10MarqueretourAchat');
    Route::get('/Top10FournisseurRetour/{req}/{from}/{to}', 'Api\RetourAchatController@Top10Fournisseurretour');
    Route::get('/parProduitRetour', 'Api\RetourAchatController@Produit');
    Route::get('/parFournisseurRetour', 'Api\RetourAchatController@Fournisseur');
    Route::get('/filterProduitRetour', 'Api\RetourAchatController@filterProduit');
    Route::get('/TotaleAchatDateRetour/{from}/{to}', 'Api\RetourAchatController@TotaleretourAchatDate');
    Route::get('/TotaleAchatRetour/{from}/{to}', 'Api\RetourAchatController@TotaleAchat');


    Route::resource('profilC', 'profilClient');
    Route::post('profilC/updatepass/{id}', 'profilClient@updatepass')->name('profilC.updatepass');

    Route::resource('profilAdminClient', 'profilAdminClient');
    Route::post('profilAdminClient/updatepass/{id}', 'profilAdminClient@updatepass')->name('profilAdminClient.updatepass');



Route::get('/', function () {
    return view('table');
})->middleware('auth');
Route::get('logout', 'Auth\LoginController@logout');
Route::auth();
Route::get('/', 'DashboardController@index');
Route::get('/table', 'DashboardController@table');
Route::get('/get', 'ChainedeRestaurationController@get');
Route::get('/getMagByChaine/{from}', 'RestaurantController@getMagByChaine');

Route::resource('profil', 'profilUser');
Route::post('Restaurantchaine/search', 'ChainedeRestaurationController@search')->name('chaine.search');
Route::post('profil/updatepass/{id}', 'profilUser@updatepass')->name('profil.updatepass');

Route::resource('chaine', 'ChainedeRestaurationController');
Route::post('magasin/search', 'RestaurantController@search')->name('magasin.search');
Route::resource('magasin', 'RestaurantController');


Route::post('magasinDB/search', 'RestaurantDataBaseController@search')->name('magasinDB.search');
Route::resource('magasinDB', 'RestaurantDataBaseController');


Route::post('userRestaurant/search', 'UserRestaurantController@search')->name('clientASM.search');
Route::resource('clientASM', 'UserRestaurantController');
Route::post('clientASM/updatepass/{id}', 'UserRestaurantController@updatepass')->name('clientASM.updatepass');



