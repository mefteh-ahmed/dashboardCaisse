<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = DB::table('restaurant')->select((DB::raw('count(id) as totalerest')))->get();
        $dbs = DB::table('dbrestaurant')->select((DB::raw('count(id) as totaledb')))->get();
        $user = DB::table('users')->select((DB::raw('count(id) as totaleuser')))->get();
        $chaines = DB::table('chaine_restauration')->select((DB::raw('count(id) as totalechaine')))->get();

        return view('dashboard', array(
            'restaurants' => $restaurants,
            'chaines' => $chaines,
            'dbs' => $dbs,
            'user' => $user));


    }

}
