<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // this is for authenticated Admin and User;

    // public function handle($request, Closure $next)
    // {
    //     if(Auth::user()->usertype == 'admin')
    //     {
    //         return $next($request);
    //     }
    //     else
    //     {
    //         return redirect('/home');
    //     }
    // }

    // For basic middleware

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
