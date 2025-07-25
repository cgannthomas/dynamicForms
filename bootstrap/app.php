<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use \Illuminate\Session\HttpException;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest' => RedirectIfAuthenticated::class,
            'auth_admin'  => RedirectIfNotAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e, $request) {
            // dd(get_class($e)); Symfony\Component\HttpKernel\Exception\HttpException
            
            if(isset($e->validator) && $request->ajax() && $request->expectsJson()) {
                return response()->json([
                        'status' => 422,
                        'message' => 'Validation failed.',
                        'errors' => $e->validator->errors(),
                    ], 422);
            }
            if ($e->getStatusCode() && $e->getStatusCode() === 419) { //CSRF token exception 

                if ($request->ajax() || $request->expectsJson()) {
                    return response()->json([
                        'message' => 'Session expired! Please refresh the page.',
                        'code' => $e->getStatusCode()
                    ], $e->getStatusCode());
                } else {
                    if(!$request->is('admin/*')) 
                        return redirect()->route('dashboard')->with('error', 'Your session has expired. Please try again.');

                    return redirect()->route('admin.login')->with('commonError', 'Your session has expired. Please reload your page.');
                }
                
            }
        });        
    })->create();
