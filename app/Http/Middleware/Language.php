<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'),0,2);
        if($locale != "es" && $locale!="en"){
            $locale ="en";
        }
        App::setLocale($locale);
        return $next($request);
    }
}
