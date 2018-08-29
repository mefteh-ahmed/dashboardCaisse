<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
class profilAdminClient extends Controller
{
    protected $redirectTo = '/profilAdminClient';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        if($var!=0){
        return view('profilAdminClient.index',['title'=>"Profil"]);}
        else {
           return redirect('/profilAdminClient');
        } 
    }
    public function edit($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->intended('/profilAdminClient');
        }
       

        return view('profilAdminClient.edit', ['user' => $user],['title'=>"Profil"]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:20',
            'email' => 'required|max:60',
            ]);
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
        ];
        User::where('id', $id)
            ->update($input);

        return redirect()->intended('/profilAdminClient');
    }
    public function updatepass(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
         
            'password' => 'required|max:60',
            ]);
        $input = [
      
            'password' => bcrypt($request['password']),
        
        ];
        User::where('id', $id)
            ->update($input);

        return redirect()->intended('/profilAdminClient');
    }
}
