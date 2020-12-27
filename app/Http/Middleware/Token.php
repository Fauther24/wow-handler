<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Token
{
    public function handle(Request $request, Closure $next)
    {
        if (getenv('WOW_HANDLER_BEARER') !== $request->bearerToken()) {
            return response('NOAUTH', 401);
        }

        return $next($request);
    }
}
