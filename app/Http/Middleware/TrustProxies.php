<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrustProxies
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->secure()) {
            $request->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }
        
        $response = $next($request);
        
        if (method_exists($response, 'header')) {
            $response->header('Content-Security-Policy', "default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval'; font-src 'self' https://fonts.gstatic.com data:; style-src 'self' https://fonts.googleapis.com 'unsafe-inline'; img-src 'self' data: https:;");
        }
        
        return $response;
    }
} 