<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null ,$redirect_to = "/login")
    {
        if (!Auth::guard($guard)->check())
        return redirect($redirect_to);


        Auth::shoulduse($guard);
        return $next($request);
    }
}
