<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
        {
            if (!auth()->check()){

                return redirect('/login');

        }
        if (auth()->user()->role !== $role) {
            
                return match (auth()->user()->role) {
                        'admin' => redirect('/admin/dashboard'),
                        'student' => redirect('/student'),
                        'teacher' => redirect('/teacher'),
                        default => redirect('/login'),
                };
        }
        return $next($request);
    }
}
