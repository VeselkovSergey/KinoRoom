<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Analytics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        \App\Models\Analytics::create([
            "client_ip_address" => request()->server('REMOTE_ADDR'),
            "data" => request()->fullUrl(),
        ]);
        return $next($request);
    }
}
