<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si hay login
        if (Auth::check()) {
            $user = Auth::user();

            // Verificar si es admin
            if ($user->isAdmin()) {
                return $next($request);
            }
        }

        return redirect()->route('dashboard');
    }
}
