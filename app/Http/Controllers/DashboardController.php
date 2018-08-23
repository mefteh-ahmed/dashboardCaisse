<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

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
        $var=Auth::user()->role;
        if($var==0){
        $restaurants = DB::table('magasin')->select((DB::raw('count(id) as totalerest')))->get();
        $dbs = DB::table('dbrestaurant')->select((DB::raw('count(id) as totaledb')))->get();
        $user = DB::table('users')->select((DB::raw('count(id) as totaleuser')))->where('role',1)->get();
        $chaines = DB::table('chaine_restauration')->select((DB::raw('count(id) as totalechaine')))->get();

        return view('dashboard', array(
            'restaurants' => $restaurants,
            'chaines' => $chaines,
            'dbs' => $dbs,
            'user' => $user));
        }
        else {
           return redirect('/dashboard');
        }


    }
    public function table()
    {
        return view('table');
    }

}
