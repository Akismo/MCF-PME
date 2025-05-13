<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\ContenuImage;
use App\Models\DemandeCredit;
use App\Models\Membre;
use App\Models\ProduitFinancier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;




class AdministrateurController extends Controller
{
    public function dashboard()
    {

        if (!Auth::guard('administrateur')->check()) {
            return response()->view('AdministrateurLogin')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }

        $admin = Auth::guard('administrateur')->user();

        switch ($admin->role) {
            case 'president':
                return response()->view('admin.dashboard')
                    ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', '0');
            case 'caf':
                return response()->view('caf.dashboard')
                    ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', '0');
            case 'comite_credit':
                return response()->view('comite-credit.dashboard')
                    ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', '0');
            default:
                return redirect()->route('administrateur_login')->with('error', 'Accès refusé');
        }
    }

    public function login()
    {
        return view('AdministrateurLogin');
    }

    public function login_submit(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('administrateur')->attempt($credentials)) {

            $user = Administrateur::where('email', $request->input('email'))->first();
            Auth::guard('administrateur')->login($user);

            //redigiger vers la page d'accueil
            switch ($user->role) {
                case 'president':
                    return redirect()->route('admin.dashboard')->with('success', 'Bienvenue, Responsable des Crédits!');
                case 'caf':
                    return redirect()->route('dashboard.caf')->with('success', 'Bienvenue, Comité des Affaires Financières!');
                case 'comite_credit':
                    return redirect()->route('comite-credit.dashboard')->with('success', 'Bienvenue, Comité de Crédit!');
                default:
                    return redirect()->route('administrateur_login')->with('error', 'Accès refusé');
            }
        } else {
            return redirect()->route('administrateur_login')->with('error', 'Identifiants invalides');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('administrateur')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('administrateur_login')->with('success', 'Deconnexion effectuée');
    }


    public function indexProduit()
    {
        $produits = ProduitFinancier::all();
        return view('admin.produits.index', compact('produits'));
    }

    public function createProduit()
    {
        return view('admin.produits.create');
    }

    public function storeProduit(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'conditions' => 'required|string',
            'avantages' => 'required|string',
            'date_creation' => 'required|date',
        ]);

        ProduitFinancier::create($request->all());

        return redirect()->route('produits-financiers.index')
            ->with('success', 'Produit financier créé avec succès.');
    }

    public function showProduit(ProduitFinancier $produit)
    {
        return view('admin.produits.show', compact('produit'));
    }

    public function editProduit(ProduitFinancier $produit)
    {
        return view('admin.produits.edit', compact('produit'));
    }

    public function updateProduit(Request $request, ProduitFinancier $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'conditions' => 'required|string',
            'avantages' => 'required|string',
            'date_creation' => 'required|date',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits-financiers.index')
            ->with('success', 'Produit financier mis à jour avec succès.');
    }

    public function destroyProduit(ProduitFinancier $produit)
    {
        $produit->delete();

        return redirect()->route('produits-financiers.index')
            ->with('success', 'Produit financier supprimé avec succès.');
    }

    public function indexMembre()
    {
        $membres = Membre::all();
        return view('admin.membres.index', compact('membres'));
    }

    public function createMembre()
    {
        return view('admin.membres.create');
    }

    public function storeMembre(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:membres',
            'password' => 'required|string|min:8',
            'date_inscription' => 'required|date',
        ]);

        $data = $request->all();

        Membre::create($data);

        return redirect()->route('membres.index')
            ->with('success', 'Membre créé avec succès.');
    }

    public function showMembre(Membre $membre)
    {
        return view('admin.membres.show', compact('membre'));
    }

    public function editMembre(Membre $membre)
    {
        return view('admin.membres.edit', compact('membre'));
    }

    public function updateMembre(Request $request, Membre $membre)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:membres,email,' . $membre->id,
            'password' => 'nullable|string|min:8',
            'date_inscription' => 'required|date',
        ]);

        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = $request->password; // en clair
        }

        $membre->update($data);

        return redirect()->route('membres.index')
            ->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroyMembre(Membre $membre)
    {
        $membre->delete();

        return redirect()->route('membres.index')
            ->with('success', 'Membre supprimé avec succès.');
    }


    public function indexCredit()
    {
        $demandes = DemandeCredit::with('membre')->latest()->get();
        return view('admin.demande-credits.index', compact('demandes'));
    }

    public function showCredit(DemandeCredit $demande)
    {
        return view('admin.demande-credits.show', compact('demande'));
    }

    public function acceptCredit(DemandeCredit $demande)
    {
        $demande->update(['statut' => 'Approuvée']);

        return redirect()->route('demande-credits.index')
            ->with('success', 'Demande de crédit acceptée avec succès.');
    }

    public function rejectCredit(DemandeCredit $demande)
    {
        $demande->update(['statut' => 'Refusée']);

        return redirect()->route('demande-credits.index')
            ->with('success', 'Demande de crédit rejetée avec succès.');
    }



    public function indexContenu()
    {
        $contenus = Contenu::with(['images', 'auteur'])->latest()->get();
        return view('admin.contenus.index', compact('contenus'));
    }

    public function createContenu()
    {
        return view('admin.contenus.create');
    }

    public function storeContenu(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'type' => 'required|string',
            'contenu' => 'required|string',
            'date_publication' => 'required|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_principale' => 'sometimes|integer',
        ]);

        $contenu = Contenu::create([
            'titre' => $request->titre,
            'type' => $request->type,
            'contenu' => $request->contenu,
            'date_publication' => $request->date_publication,
            'administrateur_id' => Auth::guard('administrateur')->id(),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('contenus/images', 'public');

                ContenuImage::create([
                    'contenu_id' => $contenu->id,
                    'chemin' => $path,
                    'alt_text' => $request->alt_text[$key] ?? $contenu->titre,
                    'is_principal' => $request->image_principale == $key,
                ]);
            }
        }

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu créé avec succès.');
    }

    public function showContenu(Contenu $contenu)
    {
        return view('admin.contenus.show', compact('contenu'));
    }

    public function editContenu(Contenu $contenu)
    {
        return view('admin.contenus.edit', compact('contenu'));
    }

    public function updateContenu(Request $request, Contenu $contenu)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'type' => 'required|string',
            'contenu' => 'required|string',
            'date_publication' => 'required|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_principale' => 'sometimes|integer',
        ]);

        $contenu->update([
            'titre' => $request->titre,
            'type' => $request->type,
            'contenu' => $request->contenu,
            'date_publication' => $request->date_publication,
        ]);

        // Gestion des images existantes
        if ($request->has('image_principale')) {
            $contenu->images()->update(['is_principal' => false]);
            $contenu->images()->where('id', $request->image_principale)->update(['is_principal' => true]);
        }

        // Ajout de nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('contenus/images', 'public');

                ContenuImage::create([
                    'contenu_id' => $contenu->id,
                    'chemin' => $path,
                    'alt_text' => $request->alt_text[$key] ?? $contenu->titre,
                    'is_principal' => false, // Par défaut non principale
                ]);
            }
        }

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroyContenu(Contenu $contenu)
    {
        // Supprimer les images associées
        foreach ($contenu->images as $image) {
            Storage::disk('public')->delete($image->chemin);
            $image->delete();
        }

        $contenu->delete();

        return redirect()->route('admin.contenus.index')
            ->with('success', 'Contenu supprimé avec succès.');
    }

    public function destroyImageContenu(ContenuImage $image)
    {
        Storage::disk('public')->delete($image->chemin);
        $image->delete();

        return back()->with('success', 'Image supprimée avec succès.');
    }
}
