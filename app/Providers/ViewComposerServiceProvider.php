<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.header', function ($view) {
            if (Auth::check()) {
                $users = User::where('id', '!=', Auth::id())->get();
                $view->with('users', $users);
            }
        });
    }
}
