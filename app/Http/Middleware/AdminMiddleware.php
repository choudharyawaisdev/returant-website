<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (Auth::check()) {
            // Check if user role is admin
            if (Auth::user()->is_admin === 'admin') {
                return $next($request); // allow access
            }

            // Logged in but not admin → redirect to clients page
            return redirect('/clients')->withErrors('You do not have admin access.');
        }

        // Not logged in → redirect to login page
        return redirect('/login');
    }
}
