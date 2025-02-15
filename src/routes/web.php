<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::middleware(['guest'])->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::get('/', [ContactController::class, 'show'])->name('contact.show');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::get('/admin/contact/{id}', [AdminController::class, 'show']);
Route::delete('/admin/contact/{id}/delete', [AdminController::class, 'destroy']);
