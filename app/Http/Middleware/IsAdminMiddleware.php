<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use Closure;

class IsAdminMiddleware
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
        $role=Auth::user()->role;
        if($role!==1)
        return redirect(RouteServiceProvider::HOME);
        return $next($request);
    }
}
