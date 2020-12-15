<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request,Closure $next, ...$roles)
    {
        if(!$request->user() || !$request->user()->authoriseRoles($roles))
        {
          return redirect()->route('home');
        }
        return $next($request);
    }
}
