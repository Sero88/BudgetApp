<?php

namespace App\Http\Middleware;

use Closure;
use Fideloper\Proxy\TrustProxies as Middleware;

class VerifyCronKey extends Middleware
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
        if( !isset($request['key']) || $request['key'] != config('app.recurring_trans_cron_key') ){
            abort(404);
        }

        return $next($request);
    }
}
