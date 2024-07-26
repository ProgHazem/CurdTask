<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct(private RateLimiter $limiter)
    {
    }

    public function handle($request, Closure $next, $maxAttempts = 5, $decayMinutes = 1)
    {
        $maxAttempts = env('MAX_ATTEMPTS') ?? $maxAttempts;
        $decayMinutes = env('DECAY_MINUTES') ?? $decayMinutes;
        $key = $request->ip(); // You can customize the key based on your needs
        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return response('Too Many Attempts.', Response::HTTP_TOO_MANY_REQUESTS);
        }
        $this->limiter->hit($key, $decayMinutes * 60);
        return $next($request);
    }
}
