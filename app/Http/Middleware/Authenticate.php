<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * @var array
     */
    protected $guards = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string[] ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        dd(Auth::guard('admin')->check());

        $this->guards = $guards;

        echo 'handle';

        return parent::handle($request, $next, ...$guards);
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
