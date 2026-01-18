<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('/about',[FrontendController::class,'about'])->name('about');
Route::get('/about',[FrontendController::class,'about'])->name('about');


Route::prefix('admin')->group(function(){
    Route::get('/login', [AdminController::class, 'admin_login'])->name('admin_login');
    Route::post('/login/submit', [AdminController::class, 'admin_login_submit'])->name('admin_login_submit');
    Route::get('/forgot/password', [AdminController::class, 'admin_forgot_password'])->name('admin_forgot_password');
    Route::post('/forgot/password/submit', [AdminController::class, 'admin_forgot_password_submit'])->name('admin_forgot_password_submit');
});
