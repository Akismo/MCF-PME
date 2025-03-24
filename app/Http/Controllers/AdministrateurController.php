<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrateur;



class AdministrateurController extends Controller
{
    public function dashboard(){
        
        if(Auth::guard('administrateur')->check()) {
            return view('AdministrateurDashboard');
        }else{
            return response()->view('AdministrateurLogin')->header('Cache-Control','no-cache, no-store, must-revalidate')->header('Pragma', 'no-cache')->header('Expires', '0');
        }
    }

    public function login(){
        return view('AdministrateurLogin');
    }

    public function login_submit(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request ->only('email','password');

        if(Auth::guard('administrateur')->attempt($credentials)){
            
            $user = Administrateur::where('email', $request->input('email'))->first();
            Auth::guard('administrateur')->login($user);
            return redirect()->route('administrateur_dashboard')->with('succes', 'Connexion effectuée');
        }else{
            return redirect()->route('administrateur_login')->with('error','Veuillez verifier vos identifiants');
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('administrateur_login')->with('success', 'Deconnexion effectuée');
    }
}
