<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = NULL): Response
    {
        dd(Auth::guard($guard)->check());
        if (Auth::guard($guard)->check()) {
            return redirect( ( $guard == 'admin' ? RouteServiceProvider::ADMIN_DASHBOARD : RouteServiceProvider::HOME ));
        }
        
        return $next($request);
    }
}
