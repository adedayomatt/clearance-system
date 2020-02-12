<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthenticatedAdminAndStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    //     if (Auth::guard($guard)->check()) {
    //         return $next($request);
    //     }
    //    return redirect()->back()->with('info', 'Not allowed');

                return $next($request);

    }
}
