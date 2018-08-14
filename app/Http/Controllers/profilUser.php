<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
class profilUser extends Controller
{
    protected $redirectTo = '/profil';
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
        return view('profil.index');
    }
    public function edit($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->intended('/profil');
        }
       

        return view('profil.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:20',
            'email' => 'required|max:60',
            'password' => 'required|max:60',
            ]);
        $input = [
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email'],
        ];
        User::where('id', $id)
            ->update($input);

        return redirect()->intended('/profil');
    }
}
