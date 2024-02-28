<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RateLimitMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $sessionKey = 'active_session_' . $ip;

        if (Session::has($sessionKey)) {
            if ($request->header('X-Requested-With') !== 'XMLHttpRequest') {
                return response()->json(['message' => 'Another session is already in progress.'], 403);
            }
        }

        // Store IP as active session
        Session::put($sessionKey, true);

        // Process request
        $response = $next($request);

        // Remove active session after request completes
        if ($request->header('X-Requested-With') !== 'XMLHttpRequest') {
            Session::forget($sessionKey);
        }

        return $response;
    }
}
