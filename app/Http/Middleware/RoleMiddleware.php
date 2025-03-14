<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role = null)
    {
        if ($role && auth()->check() && auth()->user()->role !== $role) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        return $next($request);
    }
}
