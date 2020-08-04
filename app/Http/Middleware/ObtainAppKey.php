<?php

namespace App\Http\Middleware;

use Closure;

class ObtainAppKey
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
        if( isset($_GET['key_phrase']) && $_GET['key_phrase'] === config('app.key_phrase') ){
           return $next($request);
        }
        abort(403);
    }
}
