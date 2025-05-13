<?php

namespace App\Http\Controllers;

use App\Models\DocumentDemande;
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
            'email' => 'required|email|unique:membres,email,' . $membre->id,
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
        $typesCredit = [
            'Ligne de crédit',
            'Avance sur facture',
            'Bon de commande',
            'Fonds de roulement',
            'AGR'
        ];

        return view('membre.nouvelle-demande', compact('typesCredit'));
    }

    public function soumettreDemande(Request $request)
    {
        $request->validate([
            'type_credit' => 'required|in:Ligne de crédit,Avance sur facture,Bon de commande,Fonds de roulement,AGR',
            'montant' => 'required|numeric|min:100',
            'duree' => 'required|string',
            'description_projet' => 'required|string',
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:pdf,jpg,png|max:2048'
        ]);

        $demande = DemandeCredit::create([
            'membre_id' => Auth::guard('membre')->id(),
            'type_credit' => $request->type_credit,
            'montant' => $request->montant,
            'duree' => $request->duree,
            'description_projet' => $request->description_projet,
            'date_demande' => now(),
            'statut' => 'En attente'
        ]);

        foreach ($request->file('documents') as $type_document => $file) {
            $nomOriginal = $file->getClientOriginalName(); // ✅
            $nomFichier = time() . '_' . $nomOriginal;
            $chemin = $file->storeAs('demandes/documents', $nomFichier, 'public');

            DocumentDemande::create([
                'demande_credit_id' => $demande->id,
                'type_document' => $type_document,
                'chemin_fichier' => $chemin,
                'nom_original' => $nomOriginal, // ✅ maintenant fourni
            ]);
        }




        return redirect()->route('membre_demandes')
            ->with('success', 'Demande soumise avec succès');
    }

    public function showDemande($id)
    {
        $demande = DemandeCredit::with('documents')
            ->where('membre_id', Auth::guard('membre')->id())
            ->findOrFail($id);

        return view('membre.demande-details', compact('demande'));
    }

}