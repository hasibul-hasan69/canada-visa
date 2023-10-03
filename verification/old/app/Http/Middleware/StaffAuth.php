<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class StaffAuth
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
        if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->status==1)
            return $next($request);
        else
            return redirect()->route('home');
    }
}
