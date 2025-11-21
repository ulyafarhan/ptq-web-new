<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        $isLocal = app()->environment(['local', 'testing']);

        if ($isLocal) {
            // Mengizinkan wildcard '*' untuk script/connect/style agar Vite (IPv4/IPv6) dan Hot Module Replacement (HMR) berjalan lancar tanpa error sintaks.
            $csp = implode('; ', [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' *",
                "style-src 'self' 'unsafe-inline' *",
                "img-src 'self' data: blob: *",
                "font-src 'self' data: *",
                "connect-src 'self' *", // Mengizinkan ws:// dan http:// ke mana saja (Vite)
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'"
            ]);
        } else {
            // Hanya izinkan domain sendiri dan whitelist terpercaya.
            $csp = implode('; ', [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://js.stripe.com",
                "style-src 'self' 'unsafe-inline' https://fonts.bunny.net",
                "img-src 'self' data: blob: https://www.w3.org",
                "font-src 'self' https://fonts.bunny.net",
                "connect-src 'self' wss:", 
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'"
            ]);
        }

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}