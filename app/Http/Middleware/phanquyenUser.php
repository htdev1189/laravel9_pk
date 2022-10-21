<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class phanquyenUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array(\Session::get('current_user')->group,$roles)) {
            return redirect('/admin/dashboard');
        }
        // dd(\Session::get('current_user')->group);
        // dd($request->user());
        // dd($roles);
        return $next($request);
    }
}
