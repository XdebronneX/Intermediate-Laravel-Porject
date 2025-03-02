<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Role
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
        return redirect()->route('user.signin')->with('info', 'You must be logged in to access this page.');
        }

        // Check if the user's role is authorized
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect()->back()->with('warning', 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
