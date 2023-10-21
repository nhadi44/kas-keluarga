<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottleMiddleware extends ThrottleRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function buildResponse($key, $maxAttempts): Response
    {
        $response = parent::buildResponse($key, $maxAttempts);
        if ($response->getStatusCode() === 429) {
            return response()->json(['message' => 'Too many requests. Please try again later.'], 429);
        }

        return $response;
    }
}
