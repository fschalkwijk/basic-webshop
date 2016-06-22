<?php

namespace App\Http\Middleware;

use Closure;

class SerializeCartMiddleware
{
    /**
     * Serialize the cart in the session after the request finished
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        \Cart::serialize();

        return $response;
    }
}
