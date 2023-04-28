<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
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

        if (Auth::guard('api')->check() && Auth::guard('api')->user()->phanQuyen == 2) {
            return $next($request);
        }
        return response()->json(['error' => Auth::guard('api')->check() ? 'Bạn không có quyền.' : 'Bạn chưa đăng nhập.'], 401);
    }
}
