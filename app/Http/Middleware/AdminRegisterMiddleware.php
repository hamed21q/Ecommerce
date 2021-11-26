<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\models\User;

class AdminRegisterMiddleware
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
        if(!User::HasRole(1))
        {
            return response(['message' => 'hello dont have permission to access / on this server.'], 403);
        }
        return $next($request);
    }
}
