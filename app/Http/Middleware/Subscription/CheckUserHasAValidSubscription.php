<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserHasAValidSubscription
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

        if($request->session()->has('choosed_plan')) {
            return redirect()->route('plan.subscription', $request->session()->get('choosed_plan'));
        }

        $userPlan = auth()->user()->plan();

        if(!$userPlan->exists() || $userPlan->first()->status != 'ACTIVE') {

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }

        return $next($request);
    }
}
