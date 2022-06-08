<?php

namespace Admins\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Middleware
{
    /**
     * @var array
     */
    protected $guards = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // echo '$guard=' . $guard . '<br/>';
        //echo 'in handle() admins middleware admin<br/>';
        //dd('hi');
        //echo $guard[0] . '<br/>';
        // dd($request->hasSession());
        /// dd($guards[0] !== 'admin');
        // perform action
        // if ($guards[0] !== 'admin') {
        //     return redirect('/admin/home');
        // }

        // return $next($request);
        //dd(!Auth::guard($guard)->check());
        //if (!Auth::guard($guard)->check())
        if ($guard !== 'admin') {
            return redirect('/admin/home');
        }

        return $next($request);

    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        dd('redirectTo auth app ');
        //  dd(session()->all());

        if (!$request->expectsJson()) {
            echo ('reset($this->guards) === admin is ' . reset($this->guards) === 'admin');
            if (reset($this->guards) === 'admin') {
                return route('admin.home');
            }

        }
    }
}