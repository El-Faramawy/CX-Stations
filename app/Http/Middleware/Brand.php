<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Brand
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('brand')->check()) {
            if ($request == 'login') {
                return redirect('brand/home');
            }
            return $next($request);
        }
        return redirect('brand/login');
    }
}
