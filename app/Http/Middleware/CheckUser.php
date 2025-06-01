<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->is_admin === 'no') {
            return $next($request);
        }

        return redirect()->route('adminDashboard');
    }
}