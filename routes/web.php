<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');





// User Auth Routes
Route::middleware('auth')->prefix('user')->group(function(){
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user_dashboard');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
     Route::get('/registration', [UserController::class, 'registration'])->name('registration');
    Route::post('/registration-submit', [UserController::class, 'registration_submit'])->name('registration_submit');
    Route::get('/registration_verify/{token}/{email}', [UserController::class, 'registration_verify'])->name('registration_verify');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login-submit', [UserController::class, 'login_submit'])->name('login_submit');
    Route::get('/forgot-password', [UserController::class, 'forgot_password'])->name('forgot_password');
    Route::post('/forgot-password/submit', [UserController::class, 'forgot_password_submit'])->name('forgot_password_submit');
    Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('reset_password');
    Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('reset_password_submit');



// Admin Auth Routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
});
Route::prefix('admin')->group(function () {
Route::get('/', function(){
        return redirect()->route('admin_login');
 });
Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
Route::post('/login/submit', [AdminController::class, 'admin_login_submit'])->name('admin_login_submit');
Route::get('/forgot-password', [AdminController::class, 'admin_forgot_password'])->name('admin_forgot_password');
Route::post('/forgot-password/submit', [AdminController::class, 'admin_forgot_password_submit'])->name('admin_forgot_password_submit');

Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});
