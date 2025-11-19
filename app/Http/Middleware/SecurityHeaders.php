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

        // 1. Header Dasar (Selalu Aktif)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Force HTTPS hanya di Production
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        // 2. LOGIKA DINAMIS CSP (Jantung Perbaikan)
        $isLocal = app()->environment(['local', 'testing']);

        if ($isLocal) {
            // === MODE DEVELOPMENT (Permissive) ===
            // Mengizinkan wildcard '*' untuk script/connect/style agar Vite (IPv4/IPv6)
            // dan Hot Module Replacement (HMR) berjalan lancar tanpa error sintaks.
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
            // === MODE PRODUCTION (Iron Dome) ===
            // Ketat. Hanya izinkan domain sendiri dan whitelist terpercaya.
            $csp = implode('; ', [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://js.stripe.com",
                "style-src 'self' 'unsafe-inline' https://fonts.bunny.net",
                "img-src 'self' data: blob: https://www.w3.org",
                "font-src 'self' https://fonts.bunny.net",
                "connect-src 'self' wss:", // Batasi koneksi keluar
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'"
            ]);
        }

        // Terapkan Header
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}