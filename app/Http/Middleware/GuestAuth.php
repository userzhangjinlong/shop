<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class GuestAuth extends Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        if (Auth::guard($guard)->guest()) {
            return redirect('home/login');
        }

        return $next($request);
    }
}
