<?php

namespace App\Http\Controllers\Back;
    
use Illuminate\Http\Request;
use App\Helpers\DatabaseConnection;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $var=Auth::user()->role;
        echo($var);
        if($var!=0){
        return view('back.index',['title'=>"dashboard"]);
    }
    else {
       return redirect('/');
    }
    }
   
    
}
