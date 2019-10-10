<?php

namespace App\Http\Middleware;

use Closure;
use http\Client\Request;

class IP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if ('36.239.120.19' != $request->getClientIp()) {
//            die($request->ip());
//            abort('404', "page not found");
//        }
        return $next($request);
    }
}
