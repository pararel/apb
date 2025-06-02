<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirebaseAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['auth' => 'Please login first.']);
        }

        return $next($request);
    }
}
