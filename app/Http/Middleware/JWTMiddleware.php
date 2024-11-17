<?php

namespace App\Http\Middleware;

use App\Http\Traits\PaginateTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTMiddleware
{
    use  PaginateTrait;
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return $this->apiResponse(null, 'Token has expired', 'simple',401);
        } catch (TokenInvalidException $e) {
            return $this->apiResponse(null, 'Token is invalid', 'simple',401);
        } catch (JWTException $e) {
            return $this->apiResponse(null, 'Token is not provided', 'simple',401);
        }

        return $next($request);
    }
}
