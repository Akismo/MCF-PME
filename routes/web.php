<?php

use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\ProfileController;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('membre')->group(function (){
    Route::get('membre/dashboard',[MembreController::class, 'dashboard'])->name('membre_dashboard');

    Route::prefix('etudiant')->group(function (){
        Route::get('/login',[MembreController::class, 'login'])->name('membre_login');
        Route::get('/logout', [MembreController::class, 'logout'])->name('membre_logout');
        Route::post('/logout', [MembreController::class, 'logout'])->name('membre_logout');
        Route::post('/login-submit', [MembreController::class, 'login-submit'])->name('membre_login_submit');
    });
});

Route::middleware('administrateur')->group(function () {
    Route::get('administrateur/dashboard', [AdministrateurController::class, 'dashboard'])->name('administrateur_dashboard');

    Route::prefix('administrateur')->group(function () {
        Route::get('/login', [AdministrateurController::class, 'login'])->name('administrateur_login');
        Route::get('/logout', [AdministrateurController::class, 'logout'])->name('administrateur_logout');
        Route::post('/logout', [AdministrateurController::class, 'logout'])->name('administrateur_logout');
        Route::post('/login-submit', [AdministrateurController::class, 'login-submit'])->name('administrateur_login_submit');
    });
    
});
require __DIR__.'/auth.php';
