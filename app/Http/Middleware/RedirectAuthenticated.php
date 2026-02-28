<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function redirectTo($request)
    {
       if (!$request->expectsJson()) {
            if(request()->is('panel/*')){
                return route('loginadmin');
            }else{
                return route('login');
            }
       }
    }
}
