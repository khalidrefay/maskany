<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Conversation;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('layouts.header', function ($view) {
            $unreadCount = 0;
            $headerConversations = [];

            if (Auth::check()) {
                $userId = Auth::id();

                // عدد الرسائل غير المقروءة
                $conversationIds = Conversation::where('sender_id', $userId)
    ->orWhere('recipient_id', $userId)
    ->pluck('id');

$unreadCount = Message::whereIn('conversation_id', $conversationIds)
    ->where('sender_id', '!=', $userId)
    ->whereNull('read_at')
    ->count();


                // المحادثات
                $headerConversations = Conversation::with(['sender', 'recipient', 'messages' => function($q) {
                    $q->latest()->limit(1);
                }])
                ->where('sender_id', $userId)
                ->orWhere('recipient_id', $userId)
                ->latest('updated_at')
                ->limit(5)
                ->get();
            }

            $view->with([
                'unreadCount' => $unreadCount,
                'headerConversations' => $headerConversations,
            ]);
        });
    }
}
