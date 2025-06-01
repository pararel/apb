<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $intendedUrl = $request->path();

            if (in_array($intendedUrl, ['/', 'signup', 'login'])) {
                if ($user->is_admin === 'yes') {
                    return redirect('/admin');
                } else {
                    return redirect('/dashboard');
                }
            }
        }

        return $next($request);
    }
}
