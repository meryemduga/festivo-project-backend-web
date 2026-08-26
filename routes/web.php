<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;


// Publieke pagina's
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Dashboard voor ingelogde gebruikers (standaard Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ingelogde gebruikers routes (Profiel bewerken)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin gedeelte (Enkel voor beheerders)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', EventController::class)->except(['index', 'show']);
    Route::resource('faq', FaqController::class)->except(['index']);
});

require __DIR__.'/auth.php';
// Publiek profiel (voor iedereen toegankelijk)
Route::get('/user/{username}', [UserController::class, 'showProfile'])->name('profile.show');

// Eigen profiel bewerken (alleen ingelogd)
Route::middleware('auth')->group(function () {
    Route::get('/my-profile/edit', [UserController::class, 'editProfile'])->name('profile.custom-edit');
    Route::put('/my-profile', [UserController::class, 'updateProfile'])->name('profile.custom-update');
});use App\Http\Controllers\AdminUserController;

// Binnen de Route::middleware(['auth', 'admin'])->prefix('admin')->group(...)
Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::patch('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');Route::get('/messages', [ContactController::class, 'adminIndex'])->name('admin.messages.index');
use App\Http\Controllers\CommentController;

Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});