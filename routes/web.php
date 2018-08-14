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

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::auth();
Route::get('/', 'DashboardController@index');
Route::resource('profil', 'profilUser');
Route::post('Restaurantchaine/search', 'ChainedeRestaurationController@search')->name('chaine.search');
Route::resource('chaine', 'ChainedeRestaurationController');
Route::post('Restaurant/search', 'RestaurantController@search')->name('restaurant.search');
Route::resource('restaurant', 'RestaurantController');


Route::post('RestaurantDB/search', 'RestaurantDataBaseController@search')->name('restaurantDB.search');
Route::resource('restaurantDB', 'RestaurantDataBaseController');


Route::post('userRestaurant/search', 'UserRestaurantController@search')->name('clientASM.search');
Route::resource('clientASM', 'UserRestaurantController');


