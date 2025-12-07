<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddNgrokHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Add header to skip Ngrok browser warning
        $response->headers->set('ngrok-skip-browser-warning', 'true');
        
        // Remove X-Powered-By header for security
        $response->headers->remove('X-Powered-By');
        
        return $response;
    }
}
