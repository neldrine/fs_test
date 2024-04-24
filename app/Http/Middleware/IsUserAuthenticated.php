<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // look out for the authorization header
        $token = $request->header('Authorization');

        // if the token does not match our "dynamic" token they are 401'd
        if ($token !== env('FIXED_API_TOKEN')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // continue

        return $next($request);
    }
}
