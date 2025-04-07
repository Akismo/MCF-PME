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

Route::prefix('membre')->group(function (){
    Route::get('/login',[MembreController::class, 'login'])->name('membre_login');
    Route::get('/logout', [MembreController::class, 'logout'])->name('membre_logout');
    Route::get('/register', [MembreController::class, 'register'])->name('membre_register');
    Route::post('/register-submit', [MembreController::class, 'register_submit'])->name('membre_register_submit');
    Route::post('/logout', [MembreController::class, 'logout'])->name('membre_logout');
    Route::post('/login-submit', [MembreController::class, 'login_submit'])->name('membre_login_submit');
});

Route::middleware('membre')->group(function (){
    Route::get('membre/dashboard',[MembreController::class, 'dashboard'])->name('membre_dashboard');

});


Route::prefix('administrateur')->group(function () {
    Route::get('/login', [AdministrateurController::class, 'login'])->name('administrateur_login');
    Route::post('/login-submit', [AdministrateurController::class, 'login_submit'])->name('administrateur_login_submit');
    
    Route::middleware(['administrateur'])->group(function () {
        Route::get('/dashboard', [AdministrateurController::class, 'dashboard'])->name('administrateur_dashboard');
        Route::post('/logout', [AdministrateurController::class, 'logout'])->name('administrateur_logout');
    });
});

Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');











  


require __DIR__.'/auth.php';
