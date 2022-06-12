<?php

namespace Admins\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        // echo 'In admin middleware handle<br/>';
        // echo 'guard sent parameter=' . ($guard) . '<br/>';
        // echo 'Is admin?' . (Auth::guard($guard)->check()) . '-<br/>';

        if (!Auth::guard($guard)->check()) {
            //dd('going to admin login');
            return redirect('/admin/login');
        }

        return $next($request);

    }
}