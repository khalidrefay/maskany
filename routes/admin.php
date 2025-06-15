<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Protected Routes
Route::middleware('auth:admin')->group(function () {
    // Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
//password reset

Route::post('/password/reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Language Switcher
Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Consultant Routes


// Contractor Routes


Route::view('/multi-project', 'multi-project')->name('multi-project');
Route::view('/land-exchange', 'land-exchange')->name('land-exchange');
Route::view('/inspired-designs', 'inspired-designs')->name('inspired-designs');
route::view('/estimate-cost', 'project2.estimate-cost')->name('estimate-cost');
