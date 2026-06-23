<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\UserController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');

    Volt::route('register', 'auth.register')
        ->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');

});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::post('logout', Logout::class)
    ->name('logout');

// Mis Rutas - General
Route::resource('/dashboard/animals', AnimalController::class)->middleware(['auth'])->except(['show', 'edit', 'update', 'destroy']);

Route::middleware(['auth', 'can-access-animal'])->group(function () {
    Route::get('/dashboard/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');
    Route::get('/dashboard/animals/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
    Route::put('/dashboard/animals/{animal}', [AnimalController::class, 'update'])->name('animals.update');
    Route::delete('/dashboard/animals/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
});

Route::resource('/dashboard/appointments', AppointmentController::class)->middleware(['auth', 'admin']);

// Mis Rutas - Admin
Route::resource('/dashboard/species', SpecieController::class)->middleware(['auth', 'admin']);
Route::resource('/dashboard/roles', RoleController::class)->middleware(['auth', 'admin']);
Route::resource('/dashboard/users', UserController::class)->middleware(['auth', 'admin']);
