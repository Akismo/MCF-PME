<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Log;




class AdministrateurController extends Controller
{
    public function dashboard(){
    
        if (Auth::guard('administrateur')->check()) {
            return response()->view('AdministrateurDashboard')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } else {
            return response()->view('AdministrateurLogin')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
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

    public function logout(Request $request) : RedirectResponse    
    {
        Auth::guard('administrateur')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('administrateur_login')->with('success', 'Deconnexion effectuée');
    }
}
