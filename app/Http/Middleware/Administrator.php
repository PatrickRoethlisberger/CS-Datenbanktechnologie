<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrator
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
        if ( ! $request->user() || empty($request->user()->roles) || ! $request->user()->roles->contains("admin")) {
            return abort(403, 'FORBIDDEN - keine Admin Rechte');
        }

        return $next($request);
    }
}
