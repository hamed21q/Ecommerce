<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ProductRegisterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!User::hasRole(3) && !User::hasRole(2) && !User::hasRole(1))
        {
            return response(['message' => 'hello dont have permission to access / on this server.'], 403);

        }
        return $next($request);
    }
}
