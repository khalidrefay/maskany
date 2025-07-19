<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Consultant Contact Routes
    Route::post('/consultant/contact', [ConsultantController::class, 'sendMessage'])
        ->name('api.consultant.contact')
        ->middleware('auth');

    // Users API
    Route::get('/users', function() {
        $users = \App\Models\User::select('id', 'first_name', 'last_name', 'image')
            ->where('id', '!=', auth()->id())
            ->get()
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'avatar_url' => $user->image ? asset('storage/' . $user->image) : null
                ];
            });

        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    });

    // Messaging API Routes
    Route::get('/users', [MessageController::class, 'users'])->name('api.users');
    Route::get('/conversations', [MessageController::class, 'conversations'])->name('api.conversations');
    Route::get('/conversations/{conversation}/messages', [MessageController::class, 'messages'])->name('api.messages');
    Route::post('/messages', [MessageController::class, 'store'])->name('api.messages.store');
    Route::post('/conversations/{conversation}/read', [MessageController::class, 'markAsRead'])->name('api.messages.read');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('api.messages.destroy');
    Route::get('/messages/unread-count', [MessageController::class, 'unreadCount'])->name('api.messages.unread-count');
});
