<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $role): Response
    {
        $user = $request->user(); // Récupérer l'utilisateur authentifié
        $userRole = $user->role;  // Utiliser la relation pour récupérer le rôle

        if ($userRole->name !== $role) {
            return redirect('dashboard');
        }

        return $next($request);
    }
}
