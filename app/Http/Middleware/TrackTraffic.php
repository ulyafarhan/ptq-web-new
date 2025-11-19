<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;

class TrackTraffic
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin*') && !$request->is('livewire*')) {
            Visit::create([
                'ip_address' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->header('User-Agent'),
            ]);
        }

        return $next($request);
    }
}