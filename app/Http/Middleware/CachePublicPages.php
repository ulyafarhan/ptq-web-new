<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\ResponseCache\Middlewares\CacheResponse;
use Symfony\Component\HttpFoundation\Response;

class CachePublicPages extends CacheResponse
{
    /**
     * Tentukan apakah respons harus di-cache.
     * Halaman Publik akan di-cache selama 10 menit (600 detik).
     */
    protected function shouldCache(Response $response): bool
    {
        // Jangan cache jika user login (ada sesi/cookie)
        if (auth()->check()) {
            return false;
        }

        // Jangan cache jika response bukan 200 OK
        if ($response->getStatusCode() !== 200) {
            return false;
        }

        return true;
    }

    /**
     * Tentukan masa berlaku cache (TTL).
     */
    protected function cacheLifetimeInSeconds(): int
    {
        // 10 menit (600 detik) untuk halaman publik
        return 60 * 10;
    }
}