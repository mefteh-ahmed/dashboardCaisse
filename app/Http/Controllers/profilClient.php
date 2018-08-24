<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
class profilClient extends Controller
{
    protected $redirectTo = '/profilC';
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
        return view('profilClient.index',['title'=>"Profil"]);}
        else {
           return redirect('/');
        } 
    }
    public function edit($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->intended('/profilC');
        }
       

        return view('profilClient.edit', ['user' => $user],['title'=>"Profil"]);
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

        return redirect()->intended('/profilC');
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

        return redirect()->intended('/profilC');
    }
}
