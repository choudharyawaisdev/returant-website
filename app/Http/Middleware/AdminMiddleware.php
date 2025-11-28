<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return $next($request); // allow access
            }
            return redirect('/')->withErrors('You do not have admin access.');
        }
        return redirect('/login');
    }
}
