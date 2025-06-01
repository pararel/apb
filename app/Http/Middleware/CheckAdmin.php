<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->is_admin === 'yes') {
            return $next($request);
        }

        return redirect()->route('dashboard');
    }
}