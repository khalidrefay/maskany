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
use App\Http\Controllers\Consultant\ProjectController;
use App\Http\Controllers\Consultant\ProposalController;
use App\Http\Controllers\MessageController;

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
// Route::view('consultant/submit','consultant/submit-proposal')->name('submit-proposal');
Route::view('/inspired-designs', 'inspired-designs')->name('inspired-designs');

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

    Route::prefix('messages')->group(function () {
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/chat/{recipient_id}', [MessageController::class, 'chat'])->name('messages.chat');
        Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
        Route::post('/messages/typing/{recipient_id}', [MessageController::class, 'typing'])->name('messages.typing');
        Route::get('/messages/unread-count', [MessageController::class, 'unreadCount'])->name('messages.unreadCount');
        Route::post('/messages/online', [MessageController::class, 'setOnline'])->name('messages.setOnline');
        Route::post('/messages/offline', [MessageController::class, 'setOffline'])->name('messages.setOffline');
    });

    // API route for unread messages count
    Route::get('/messages/unread-count', [MessageController::class, 'unreadCount'])->name('messages.unread-count');
});

// Contractor Routes
Route::middleware(['auth', 'role:contractor'])->prefix('contractor')->name('contractor.')->group(function () {
    Route::get('/dashboard', [ContractorController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [ContractorController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [ContractorController::class, 'updateProfile'])->name('profile.update');
    // قائمة المشاريع المرتبطة بالمقاول
    Route::get('/projects', [ContractorController::class, 'projects'])->name('projects');
    // تفاصيل مشروع للمقاول
    Route::get('/projects/{id}', [ContractorController::class, 'showProject'])->name('projects.show');
});

// Consultant Routes
Route::middleware(['auth', 'role:consultant'])->prefix('consultant')->name('consultant.')->group(function () {
    Route::get('/dashboard', [ConsultantController::class, 'dashboard'])->name('dashboard');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/profile', [ConsultantController::class, 'profile'])->name('profile');
    Route::get('/messages', [ConsultantController::class, 'messages'])->name('messages');
    Route::get('/my-offers', [ConsultantController::class, 'myOffers'])->name('my-offers');
    Route::get('/my-offers-view', [ConsultantController::class, 'myOffersView'])->name('my-offers.view');
    Route::get('/profile/edit', [ConsultantController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [ConsultantController::class, 'updateProfile'])->name('profile.update');
    Route::get('/projects/{id}/proposal', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('/projects/proposal', [ProposalController::class, 'store'])->name('proposals.store');
    // إضافة route للتعديل والتحديث
    Route::get('/projects/proposal/{proposal}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    // Route لقبول عرض الاستشاري
    Route::post('/proposals/{proposal}/accept', [ProposalController::class, 'accept'])->name('proposals.accept');
    Route::get('/available-projects', [ConsultantController::class, 'availableProjects'])->name('available-projects');
    Route::get('/projects/details/{id}', [ConsultantController::class, 'show'])->name('projects.details');
});

// Regular User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});

// Supplier Routes
Route::middleware(['auth', 'role:supplier'])->prefix('supplier')->name('supplier.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\SupplierController::class, 'dashboard'])->name('dashboard');
    Route::get('/projects', [\App\Http\Controllers\SupplierController::class, 'projects'])->name('projects');
    Route::get('/projects/{id}', [\App\Http\Controllers\SupplierController::class, 'showProject'])->name('projects.show');
    // تقديم عرض للمواد
    Route::post('/projects/{id}/offer', [\App\Http\Controllers\SupplierController::class, 'storeOffer'])->name('projects.offer');
});

// Messaging Web Routes
Route::post('/messages/send', [App\Http\Controllers\MessageController::class, 'sendMessage'])->name('sendMessage');

// Route لمراجعة عروض الموردين على مشروع معيّن (للاستشاري أو مالك المشروع)
Route::middleware(['auth'])->get('/consultant/projects/{project}/supplier-offers', [\App\Http\Controllers\Consultant\ProposalController::class, 'supplierOffers'])->name('consultant.projects.supplier-offers');

// قبول أو رفض عرض مورد
Route::middleware(['auth'])->post('/consultant/supplier-offers/{offer}/accept', [\App\Http\Controllers\Consultant\ProposalController::class, 'acceptSupplierOffer'])->name('consultant.supplier-offers.accept');
Route::middleware(['auth'])->post('/consultant/supplier-offers/{offer}/reject', [\App\Http\Controllers\Consultant\ProposalController::class, 'rejectSupplierOffer'])->name('consultant.supplier-offers.reject');
