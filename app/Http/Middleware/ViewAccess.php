<?php

namespace App\Http\Middleware;

use Closure;

class ViewAccess
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
        $whitelist = [
            route('access.obtain_access_key'),
            route('cron.recurring_transactions'),
            route('cron.budget_history')
        ];


        //if no access key is present and request is not on the whitelist, abort
        if( empty($request->cookie('access_key') ) && !in_array($request->url(), $whitelist) ){
            //abort(403);
        }

        return $next($request);
    }
}
