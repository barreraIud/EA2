<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolAdminIsValid
{

    const ADMIN_ROLE = 1;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) //explicado en hora 1.42 de AAA4
    {
        if ($request->user()->role_id != self::ADMIN_ROLE) {
            return redirect('home');
        }

        return $next($request);
    }
}
