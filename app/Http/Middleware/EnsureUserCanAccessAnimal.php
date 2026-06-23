<?php

namespace App\Http\Middleware;

use App\Models\Animal;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanAccessAnimal
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user) {
            abort(403, 'No tienes permiso para acceder a esta mascota.');
        }

        if ($user->isAdmin()) {
            return $next($request);
        }

        $animal = $request->route('animal');

        if ($animal instanceof Animal && $animal->user_id === $user->id) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder a esta mascota.');
    }
}
