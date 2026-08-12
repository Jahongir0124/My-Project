<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {

  
      
        if (auth()->check())
            {
                App::setlocale(auth()->user()->lang);
            }else 
            {
                App::setLocale('uz');
            }
        return $next($request);
    }
}
