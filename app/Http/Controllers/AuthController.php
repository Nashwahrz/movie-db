<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formLogin(){
        return view('admin.login');
    }
    public function login(Request $request){
         $credentials = $request-> validate([
            'email' => ['required','email'],
            'password' =>['required ']
         ]);

         if(Auth::attempt($credentials)){
            $request -> session()->regenerate();
            return redirect()->intended('/');
         }
         return back()->withErrors([
            'email' => 'Email tidak terdaftar'
         ])->onlyInput('email');

    }

    public function destroy(Request $request)
      {
    Auth::logout(); // keluarin user

    $request->session()->invalidate(); // hancurkan session lama
    $request->session()->regenerateToken(); // bikin token CSRF baru

    return redirect('/login'); // arahkan ke login
     }

}
