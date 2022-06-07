<?php

namespace Admins\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{/**
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
        ///dd('from the Admin middleware');
        // dd('is admin guard?' . Auth::guard('admin')->check());
        // // dd(Auth::guard($guard));

        // if (!Auth::guard('admin')->check()) {
        //     dd('not admin');
        //     return route('admin.home');
        // }
        // dd($next($request));
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
        if (!$request->expectsJson()) {

            if (reset($this->guards) === 'admin') {
                return route('admin.home');
            }

            return route('/');
        }
    }
}
