<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CommentController;

// ==========================================
// 1. PUBLIEKE PAGINA'S
// ==========================================
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/user/{username}', [UserController::class, 'showProfile'])->name('profile.show');


// ==========================================
// 2. INGELOGDE GEBRUIKERS (Breeze & Custom)
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Breeze standaard profiel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Eigen custom profiel bewerken
    Route::get('/my-profile/edit', [UserController::class, 'editProfile'])->name('profile.custom-edit');
    Route::put('/my-profile', [UserController::class, 'updateProfile'])->name('profile.custom-update');

    // Comments
    Route::post('/events/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


// ==========================================
// 3. ADMIN GEDEELTE (Enkel voor beheerders)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Events beheer
    Route::resource('events', EventController::class)->except(['index', 'show']);
    
    // FAQ beheer
    Route::resource('faq', FaqController::class)->except(['index']);

    // Gebruikersbeheer (Overzicht, Toevoegen, Rollen wijzigen, Verwijderen)
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Contact berichten overzicht voor admin
    Route::get('/messages', [ContactController::class, 'adminIndex'])->name('messages.index');
});

require __DIR__.'/auth.php';