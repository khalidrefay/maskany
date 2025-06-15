<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\LandExchangeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectItemsController;
use App\Http\Controllers\ProjectOfferController;

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

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset
Route::post('/password/reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Language Switcher
Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Common authenticated routes
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes for all authenticated users
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Project Estimate Routes
    Route::get('/project-estimate', [ProjectItemsController::class, 'cost'])->name('project.index');
    Route::post('/project-estimate', [ProjectItemsController::class, 'store'])->name('project.store');
    Route::get('/project-estimate/{id}', [ProjectItemsController::class, 'show'])->name('project.show');
    Route::get('/project-estimate/{id}/edit', [ProjectItemsController::class, 'edit'])->name('project.edit');
    Route::delete('/project-estimate/{id}', [ProjectItemsController::class, 'destroy'])->name('project.destroy');

    // Land Exchange Routes
    Route::get('/land-exchange/index', [LandExchangeController::class, 'index'])->name('land.exchange.index');
    Route::post('/land-exchange/store', [LandExchangeController::class, 'store'])->name('land-exchange.store');
    Route::get('/land-exchange/{id}/edit', [LandExchangeController::class, 'edit'])->name('land-exchange.edit');
    Route::put('/land-exchange/{id}', [LandExchangeController::class, 'update'])->name('land-exchange.update');
    Route::delete('/land-exchange/{id}', [LandExchangeController::class, 'destroy'])->name('land-exchange.destroy');

    // Offer Routes
    Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
    Route::post('/offers/{id}/accept', [OfferController::class, 'accept'])->name('offers.accept');
    Route::post('/offers/{id}/reject', [OfferController::class, 'reject'])->name('offers.reject');
    Route::get('/my-offers', [OfferController::class, 'showOffers'])->name('offers.index');

    // Project Items
    Route::get('/project-items', [ProjectItemsController::class, 'index'])->name('project.items.index');
    Route::get('/project-items/{id}', [ProjectItemsController::class, 'show'])->name('project.items.show');

    // Project Offers
    Route::post('/project-offers', [ProjectOfferController::class, 'store'])->name('project-offers.store');
    Route::get('/projects/{project_id}/offers', [ProjectOfferController::class, 'index'])->name('project-offers.index');
    Route::post('/project-offers/{offer_id}/accept', [ProjectOfferController::class, 'accept'])->name('project-offers.accept');
    Route::post('/project-offers/{offer_id}/reject', [ProjectOfferController::class, 'reject'])->name('project-offers.reject');

    // Views
    Route::view('/inspired-designs', 'inspired-designs')->name('inspired-designs');
    Route::view('/myoffers', 'myoffer')->name('myoffers');
    Route::view('/add-project', 'add-project')->name('add-project');
});

// Contractor Routes
Route::middleware(['auth', 'role:contractor'])->prefix('contractor')->name('contractor.')->group(function () {
    Route::get('/dashboard', [ContractorController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [ContractorController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [ContractorController::class, 'updateProfile'])->name('profile.update');
});

// Consultant Routes
Route::middleware(['auth', 'role:consultant'])->prefix('consultant')->name('consultant.')->group(function () {
    Route::get('/dashboard', [ConsultantController::class, 'dashboard'])->name('dashboard');
    Route::get('/projects', [ConsultantController::class, 'projects'])->name('projects');
    Route::get('/projects/{project}', [ConsultantController::class, 'showProject'])->name('projects.show');
    Route::get('/profile', [ConsultantController::class, 'profile'])->name('profile');
    Route::get('/messages', [ConsultantController::class, 'messages'])->name('messages');
    Route::get('/my-offers', [ConsultantController::class, 'myOffers'])->name('my-offers');
    Route::get('/profile/edit', [ConsultantController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [ConsultantController::class, 'updateProfile'])->name('profile.update');
});

// Regular User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});