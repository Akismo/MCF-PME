<?php

use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\ProfileController;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProduitsFinanciersController; 




Route::get('/', function () {
    return view('welcome');
})->name('acceuil');

Route::get('/service', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contacts');
})->name('contact');

Route::get('/mcfpme', function () {
    return view('mcfpmes');
})->name('mcf-pme');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('membre')->group(function () {
    // Routes publiques
    Route::get('/login', [MembreController::class, 'login'])->name('membre_login');
    Route::get('/register', [MembreController::class, 'register'])->name('membre_register');
    Route::post('/register-submit', [MembreController::class, 'register_submit'])->name('membre_register_submit');
    Route::post('/login-submit', [MembreController::class, 'login_submit'])->name('membre_login_submit');
    
    // Routes protégées
    Route::middleware('membre')->group(function () {
        Route::get('/dashboard', [MembreController::class, 'dashboard'])->name('membre_dashboard');
        Route::get('/profile', [MembreController::class, 'profile'])->name('membre_profile');
        Route::post('/profile/update', [MembreController::class, 'updateProfile'])->name('membre_profile_update');
        
        // Routes pour les demandes de crédit
        Route::get('/demandes', [MembreController::class, 'demandes'])->name('membre_demandes');
        Route::get('/demande/nouvelle', [MembreController::class, 'nouvelleDemande'])->name('membre_nouvelle_demande');
        Route::post('/demande/soumettre', [MembreController::class, 'soumettreDemande'])->name('membre_soumettre_demande');
        Route::get('/demande/{id}', [MembreController::class, 'showDemande'])->name('membre_demande_details');
        Route::post('/logout', [MembreController::class, 'logout'])->name('membre_logout');
    });
});



Route::prefix('administrateur')->group(function () {
    Route::get('/login', [AdministrateurController::class, 'login'])->name('administrateur_login');
    Route::post('/login-submit', [AdministrateurController::class, 'login_submit'])->name('administrateur_login_submit');
    
    Route::middleware(['administrateur'])->group(function () {
        Route::get('/dashboard', [AdministrateurController::class, 'dashboard'])->name('administrateur_dashboard');
        Route::post('/logout', [AdministrateurController::class, 'logout'])->name('administrateur_logout');


            // Routes pour les produits financiers
            Route::get('produits-financiers', [AdministrateurController::class, 'indexProduit'])->name('produits-financiers.index');
            Route::get('produits-financiers/create', [AdministrateurController::class, 'createProduit'])->name('produits-financiers.create');
            Route::post('produits-financiers', [AdministrateurController::class, 'storeProduit'])->name('produits-financiers.store');
            Route::get('produits-financiers/{produit}', [AdministrateurController::class, 'showProduit'])->name('produits-financiers.show');
            Route::get('produits-financiers/{produit}/edit', [AdministrateurController::class, 'editProduit'])->name('produits-financiers.edit');
            Route::put('produits-financiers/{produit}', [AdministrateurController::class, 'updateProduit'])->name('produits-financiers.update');
            Route::delete('produits-financiers/{produit}', [AdministrateurController::class, 'destroyProduit'])->name('produits-financiers.destroy');

            // Routes pour les membres
            Route::get('membres', [AdministrateurController::class, 'indexMembre'])->name('membres.index');
            Route::get('membres/create', [AdministrateurController::class, 'createMembre'])->name('membres.create');
            Route::post('membres', [AdministrateurController::class, 'storeMembre'])->name('membres.store');
            Route::get('membres/{membre}', [AdministrateurController::class, 'showMembre'])->name('membres.show');
            Route::get('membres/{membre}/edit', [AdministrateurController::class, 'editMembre'])->name('membres.edit');
            Route::put('membres/{membre}', [AdministrateurController::class, 'updateMembre'])->name('membres.update');
            Route::delete('membres/{membre}', [AdministrateurController::class, 'destroyMembre'])->name('membres.destroy');

            // Routes pour les demandes de crédit
            Route::get('/demande-credits', [AdministrateurController::class, 'indexCredit'])->name('demande-credits.index');
            Route::get('/demande-credits/{demande}', [AdministrateurController::class, 'showCredit'])->name('demande-credits.show');
            Route::post('/demande-credits/{demande}/accept', [AdministrateurController::class, 'acceptCredit'])->name('demande-credits.accept');  
            Route::post('/demande-credits/{demande}/reject', [AdministrateurController::class, 'rejectCredit'])->name('demande-credits.reject');
        
            // Routes pour les contenus
            Route::get('/contenus', [AdministrateurController::class, 'indexContenu'])->name('admin.contenus.index');
            Route::get('/contenus/create', [AdministrateurController::class, 'createContenu'])->name('admin.contenus.create');    
            Route::post('/contenus/store', [AdministrateurController::class, 'storeContenu'])->name('admin.contenus.store');    
            Route::get('/contenus/{contenu}', [AdministrateurController::class, 'showContenu'])->name('admin.contenus.show');    
            Route::get('/contenus/{contenu}/edit', [AdministrateurController::class, 'editContenu'])->name('admin.contenus.edit');   
            Route::put('/contenus/{contenu}/update', [AdministrateurController::class, 'updateContenu'])->name('admin.contenus.update');   
            Route::delete('/contenus/{contenu}/destroy', [AdministrateurController::class, 'destroyContenu'])->name('admin.contenus.destroy');    
            Route::delete('/contenus/images/{image}/destroy', [AdministrateurController::class, 'destroyImageContenu'])->name('admin.contenus.images.destroy');
        
        
    });
});

Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');











  


require __DIR__.'/auth.php';
