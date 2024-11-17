<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ApplyUserPreferences
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (brand()->check()) {
            // Set language and theme from the authenticated user
            $brand = brand()->user();

            // Apply the user's language preference
            App::setLocale($brand->language);
            session()->put('locale', $brand->language);

            // Apply theme preference (optional, you can use a view composer instead)
            session()->put('theme', $brand->theme);
        }

        return $next($request);
    }

}
