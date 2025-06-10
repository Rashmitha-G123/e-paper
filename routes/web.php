<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/edition/{id}', [HomeController::class, 'showEdition'])->name('edition.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Authentication
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/editions', [EditionController::class, 'index'])->name('editions.index');
    Route::post('/editions', [EditionController::class, 'store'])->name('editions.store');
    Route::put('/editions/{edition}', [EditionController::class, 'update'])->name('editions.update');
    Route::delete('/editions/{edition}', [EditionController::class, 'destroy'])->name('editions.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/pages/{edition}', [PageController::class, 'index'])->name('pages.index');
    Route::post('/editions/{edition}/pages', [PageController::class, 'store'])->name('pages.store');
    Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
    Route::get('/pages', [PageController::class, 'allPages'])->name('pages.all');
// Route::get('/editions/{edition}', [EditionController::class, 'show'])->name('editions.show');
    Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');       

});
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::get('/editions/create', [EditionController::class, 'create'])->name('editions.create');
