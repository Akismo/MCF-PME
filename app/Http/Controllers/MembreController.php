<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\DemandeCredit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MembreController extends Controller
{
    // Méthodes d'authentification
    public function login()
    {
        return view('MembreLogin');
    }

    public function register()
    {
        return view('register');
    }

    public function register_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:membres,email',
            'password' => 'required|string|min:8',
        ]);

        $membre = Membre::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->password,
            'date_inscription' => now(),
        ]);

        Auth::guard('membre')->login($membre);

        return redirect()->route('membre_dashboard')->with('success', 'Inscription réussie, vous êtes connecté!');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('membre')->attempt($request->only('email', 'password'))) {
            return redirect()->route('membre_dashboard')->with('success', 'Connexion effectuée');
        }

        return redirect()->route('membre_login')->with('error', 'Veuillez vérifier vos identifiants');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('membre')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('membre_login')->with('success', 'Déconnexion effectuée');
    }

    // Méthodes pour l'espace membre
    public function dashboard()
    {
        $membre = Auth::guard('membre')->user();
        $derniereDemande = $membre->demandeCredits()->latest()->first();

        if (Auth::guard('membre')->check()) {
            return response()->view('MembreDashboard', compact('membre', 'derniereDemande'))
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } else {
            return response()->view('MembreLogin')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }
    }

    public function profile()
    {
        $membre = Auth::guard('membre')->user();
        return view('membre.profile', compact('membre'));
    }

    public function updateProfile(Request $request)
    {
        $membre = Auth::guard('membre')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:membres,email,'.$membre->id,
        ]);

        $membre->update($request->only('name', 'prenom', 'email'));

        return redirect()->route('membre_dashboard')->with('success', 'Profil mis à jour avec succès');
    }

    public function demandes()
    {
        $membre = Auth::guard('membre')->user();
        $demandes = $membre->demandeCredits()->latest()->get();
        
        return view('membre.demandes', compact('demandes'));
    }

    public function nouvelleDemande()
    {
        return view('membre.nouvelle-demande');
    }

    public function soumettreDemande(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:100',
        ]);

        DemandeCredit::create([
            'membre_id' => Auth::guard('membre')->id(),
            'montant' => $request->montant,
            'date_demande' => now(),
            'statut' => 'En attente',
        ]);

        return redirect()->route('membre_demandes')->with('success', 'Demande de crédit soumise avec succès');
    }

    public function showDemande($id)
    {
        $demande = DemandeCredit::where('membre_id', Auth::guard('membre')->id())
                            ->findOrFail($id);
        
        return view('membre.demande-details', compact('demande'));
    }
}