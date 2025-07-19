<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareUsers
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            View::share('users', User::where('id', '!=', Auth::id())->get());
        }
        return $next($request);
    }
}
