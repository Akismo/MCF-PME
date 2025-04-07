<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembreController extends Controller
{
    public function dashboard(){
        
        if(Auth::guard('membre')->check()) {
            return view('MembreDashboard');
        } else {
            return response()->view('MembreLogin')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }
    }

    public function login(){
        return view('MembreLogin');
    }

    public function register()
    {
        return view('register');
    }

    public function register_submit(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:membres,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Création d'un nouveau membre
        $membre = Membre::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mot_de_passe' => $request->password,
            'date_inscription' => now(),
        ]);

        // Connexion automatique après inscription
        auth()->guard('membre')->login($membre);

        return redirect()->route('membre_dashboard')->with('success', 'Inscription réussie, vous êtes connecté!');
    }

    public function login_submit(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request ->only('email','password');

        if(Auth::guard('membre')->attempt($credentials)){
            
            $user = Membre::where('email', $request->input('email'))->first();
            Auth::guard('membre')->login($user);
            return redirect()->route('membre_dashboard')->with('succes', 'Connexion effectuée');
        }else{
            return redirect()->route('membre_login')->with('error','Veuillez verifier vos identifiants');
        }
    }

    public function logout()
    {
        Auth::guard('membre')->logout();
        return redirect()->route('membre_login')->with('success', 'Deconnexion effectuée');
    }
}
