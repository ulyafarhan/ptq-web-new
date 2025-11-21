<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

// Import Custom Middleware
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\TrackTraffic;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
            SecurityHeaders::class, 
            TrackTraffic::class,    
        ]);

        $middleware->throttleApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // PERBAIKAN DISINI: Gunakan \Throwable (Global Namespace)
        $exceptions->respond(function (Response $response, \Throwable $exception, Request $request) {
            
            // Logic Error Page
            if (
                in_array($response->getStatusCode(), [403, 404, 500, 503]) 
                && ! $request->is('api/*') 
            ) {
                return Inertia::render('Error', [
                    'status' => $response->getStatusCode(),
                ])
                ->toResponse($request)
                ->setStatusCode($response->getStatusCode());
            } 
            
            if ($response->getStatusCode() === 419) {
                return back()->with([
                    'message' => 'Halaman kadaluarsa, silakan muat ulang.',
                ]);
            }
    
            return $response;
        });
    })->create();