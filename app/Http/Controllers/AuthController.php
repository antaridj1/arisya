<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{   
    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
         $login = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

       if(Auth::guard('web')->attempt(['username' => $request->username, 'password'=> $request->password, 'status'=>'1']))
       {   
            $request->session()->regenerate();
             return redirect()->intended('dashboard');
        }
         else{
            return back()->with('message','Username atau password yang Anda masukkan salah')->with('gagal','error');
         }
     }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->invalidate();
        $request->session()->flush();
        session()->regenerateToken();
        return redirect('/login');
    }
}
