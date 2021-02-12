<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;

class AddAChoosedPlanInSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        dd($request->route('plan'));
        $request->session()->put('choosed_plan', );
        return $next($request);
    }
}
