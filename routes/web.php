<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
    DashboardController,
    LanguageController,
    HomeController,
    ConsultantController,
    ContractorController,
    LandExchangeController,
    OfferController,
    UserController,
    ProfileController,
    ProjectItemsController,
    ProjectOfferController,
    Consultant\ProjectController,
    Consultant\ProposalController,
    MessageController,
    ProjectProposalController,
    FinalDeliveryController,
    ContractorOfferController,
    Project_constController,
    SupplierController
};

// Routes العامة
Route::view('/inspired-designs', 'inspired-designs')->name('inspired-designs');
Route::get('/', [HomeController::class, 'index'])->name('home');
// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
    });
    
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
    });
    
    Route::post('/password/reset', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});

// Language Switcher
Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');
Route::get('/change-language/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'ar'])) {
        abort(400);
    }
    Session::put('locale', $lang);
    App::setLocale($lang);
    return redirect()->back();
})->name('change.language');


Route::post('/contractor/offer/submit/{proposal}', [ContractorOfferController::class, 'submitOffer'])->name('contractor.offer.submit');

// Routes التي تتطلب تسجيل الدخول
Route::middleware('auth')->group(function () {
    // Authentication
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    

    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::put('/profile', 'update')->name('profile.update');
    });
    
    // Projects Routes
    Route::prefix('projects')->group(function () {
        Route::controller(ProjectItemsController::class)->group(function () {
            Route::get('/', 'index')->name('projects.index');
            Route::get('/estimate', 'cost')->name('project.index');
            Route::post('/estimate', 'store')->name('project.store');
            Route::get('/estimate/{id}', 'show')->name('project.show');
            Route::get('/estimate/{id}/edit', 'edit')->name('project.edit');
            Route::delete('/estimate/{id}', 'destroy')->name('project.destroy');
            Route::delete('/{id}', 'destroy')->name('projects.destroy');
        });
        
        Route::controller(Project_constController::class)->group(function () {
            Route::get('/multi/{project?}', 'showMultiProjects')->name('projects.multi');
            Route::get('/{project}/consultant-proposal', 'showConsultantProposal')->name('project.proposal.consultant-proposal');
            Route::post('/{project}/accept-contractor/{offer}', 'acceptContractorOffer')->name('projects.acceptContractorOffer');
        });
        
        // Project Items
        Route::controller(ProjectItemsController::class)->group(function () {
            Route::get('/items', 'index')->name('project.items.index');
            Route::get('/items/{id}', 'show')->name('project.items.show');
        });
    });
    
    // Land Exchange
    Route::controller(LandExchangeController::class)->prefix('land-exchange')->group(function () {
        Route::get('/', 'index')->name('land.exchange.index');
        Route::post('/store', 'store')->name('land-exchange.store');
        Route::get('/{id}/edit', 'edit')->name('land-exchange.edit');
        Route::put('/{id}', 'update')->name('land-exchange.update');
        Route::delete('/{id}', 'destroy')->name('land-exchange.destroy');
    });
    
    // Offers
    Route::controller(OfferController::class)->prefix('offers')->group(function () {
        Route::post('/', 'store')->name('offers.store');
        Route::post('/{id}/accept', 'accept')->name('offers.accept');
        Route::post('/{id}/reject', 'reject')->name('offers.reject');
        Route::get('/my-offers', 'showOffers')->name('offers.index');
    });
    
    // Project Offers
    Route::controller(ProjectOfferController::class)->group(function () {
        Route::post('/project-offers', 'store')->name('project-offers.store');
        Route::get('/projects/{project_id}/offers', 'index')->name('project-offers.index');
        Route::post('/project-offers/{offer_id}/accept', 'accept')->name('project-offers.accept');
        Route::post('/project-offers/{offer_id}/reject', 'reject')->name('project-offers.reject');
    });
    
    // Final Delivery
    Route::post('/consultant/projects/{project}/final-delivery', [FinalDeliveryController::class, 'submitDelivery'])
        ->name('consultant.final.delivery.submit');
    
    // Proposals
    Route::controller(ProposalController::class)->group(function () {
        Route::post('/accept', 'accept')->name('proposal.accept');
        Route::post('/consultant/projects/{project}/proposal', 'store')->name('proposals.store');
    });
    
    // Views
    Route::view('/myoffers', 'myoffer')->name('myoffers');
    Route::view('/add-project', 'add-project')->name('add-project');
    
    // Messaging
    Route::controller(MessageController::class)->prefix('messages')->group(function () {
        Route::get('/', 'index')->name('messages.index');
        Route::get('/chat/{recipient_id}', 'chat')->name('messages.chat');
        Route::post('/send', 'sendMessage')->name('messages.send');
        Route::post('/typing/{recipient_id}', 'typing')->name('messages.typing');
        Route::get('/unread-count', 'unreadCount')->name('messages.unreadCount');
        Route::post('/online', 'setOnline')->name('messages.setOnline');
        Route::post('/offline', 'setOffline')->name('messages.setOffline');
    });
    
  // Contractor Routes
Route::middleware('role:contractor')->prefix('contractor')->name('contractor.')->group(function () {
    Route::controller(ContractorController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/profile/edit', 'editProfile')->name('profile.edit');
        Route::put('/profile', 'updateProfile')->name('profile.update');
        Route::get('/projects', 'availableProjects')->name('projects.available');
        Route::get('/available-projects', 'availableProjects')->name('projects.available-alt');
        Route::get('/my-projects', 'projects')->name('projects.my');
        Route::get('/projects/{project}', 'showProject')->name('projects.show');
        Route::post('/projects/{project}/offer', [ContractorController::class, 'submitOffer'])->name('contractor.offer.accept');
        Route::post('/projects/{project}/contractor-offer', [ContractorOfferController::class, 'store'])->name('offers.store');
        Route::get('/projects/{proposal}/consultant-proposal', 'showConsultantProposal')
            ->name('project.proposal.consultant-proposal');
    });
    
    Route::prefix('contractor/offers')->group(function () {
        Route::get('/', [ContractorOfferController::class, 'listOffers'])->name('offers.list');
        Route::get('/create', [ContractorOfferController::class, 'create'])->name('offers.create');
        Route::get('/{offer}', [ContractorOfferController::class, 'show'])->name('offers.show');
        Route::get('/{offer}/edit', [ContractorOfferController::class, 'edit'])->name('offers.edit');
    });
    
    Route::controller(ContractorOfferController::class)->group(function () {
        Route::get('/projects/{project}/contractor-offer', 'create')->name('offers.create-form');
        Route::get('/projects/{project}/offers/preview/{offer?}', 'preview')->name('offers.preview');
        Route::delete('/projects/{project}/contractor-offer/{offer}', 'destroy')->name('offers.destroy');
    });
    
    // الـ Route الجديد لتقديم العرض عبر AJAX
    Route::post('/offer/submit/{project}', [ContractorOfferController::class, 'submitOffer'])->name('contractor.offer.submit');
    
    Route::get('/my-offers', [ContractorController::class, 'myOffers'])->name('my.offers');
});
    // Consultant Routes
    Route::middleware('role:consultant')->prefix('consultant')->name('consultant.')->group(function () {
        Route::controller(ConsultantController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/messages', 'messages')->name('messages');
            Route::get('/my-offers', 'myOffers')->name('my-offers');
            Route::get('/my-offers-view', 'myOffersView')->name('my-offers.view');
            Route::get('/profile/edit', 'editProfile')->name('profile.edit');
            Route::put('/profile', 'updateProfile')->name('profile.update');
            Route::get('/available-projects', 'availableProjects')->name('available-projects');
            Route::get('/projects/details/{id}', 'show')->name('projects.details');
        });
        
        Route::controller(ProjectController::class)->group(function () {
            Route::get('/projects', 'index')->name('projects.index');
        });
        
        Route::controller(ProposalController::class)->group(function () {
            Route::get('/projects/{id}/proposal', 'create')->name('proposals.create');
            Route::post('/projects/proposal', 'store')->name('proposals.store');
            Route::get('/projects/proposal/{proposal}/edit', 'edit')->name('proposals.edit');
            Route::post('/proposals/{proposal}/accept', 'accept')->name('proposals.accept');
            Route::post('/proposals/{id}/accept', 'accept')->name('proposal.accept');
        });
        
        Route::get('/projects/{id}/final-delivery', [ConsultantController::class, 'showFinalDeliveryForm'])
            ->name('final.delivery.form');
    });
    
    // Regular User Routes
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/profile/edit', 'editProfile')->name('profile.edit');
            Route::put('/profile', 'updateProfile')->name('profile.update');
        });
        
        Route::post('/proposals/{proposal}/accept', [ProposalController::class, 'accept'])
            ->name('proposals.accept');
    });
    
    // Supplier Routes
    Route::middleware('role:supplier')->prefix('supplier')->name('supplier.')->group(function () {
        Route::controller(SupplierController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/profile/edit', 'editProfile')->name('profile.edit');
            Route::put('/profile', 'updateProfile')->name('profile.update');
            Route::get('/projects', 'projects')->name('projects');
            Route::get('/projects/{id}', 'showProject')->name('projects.show');
            Route::post('/projects/{id}/offer', 'storeOffer')->name('projects.offer');
        });
    });
    
    // Supplier Offers Review
    Route::prefix('consultant')->group(function () {
        Route::get('/projects/{project}/supplier-offers', [\App\Http\Controllers\Consultant\ProposalController::class, 'supplierOffers'])
            ->name('consultant.projects.supplier-offers');
        Route::post('/supplier-offers/{offer}/accept', [\App\Http\Controllers\Consultant\ProposalController::class, 'acceptSupplierOffer'])
            ->name('consultant.supplier-offers.accept');
        Route::post('/supplier-offers/{offer}/reject', [\App\Http\Controllers\Consultant\ProposalController::class, 'rejectSupplierOffer'])
            ->name('consultant.supplier-offers.reject');
    });
});

// Messaging Web Routes
Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('sendMessage');

Route::get('/contractor/offers', [ContractorOfferController::class, 'listOffers'])
     ->name('offers.list')
     ->middleware(['auth', 'role:contractor']);