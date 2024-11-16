<?php

namespace App\Http\Middleware;

use Closure;

use Exception;
use Illuminate\Http\Request;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

class JWT
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
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException){
                return response()->json([
                    'status' => 'El token es invalido.',
                    'code' => 401
                ],);
            }else if ($e instanceof TokenExpiredException){
                return response()->json([
                    'status' => 'El token expiró.',
                    'code' => 401
                ],);
            }else {
                return response()->json([
                    'status' => 'No se encontro ningun token.',
                    'code' => 401
                ],);
            }
        }
        return $next($request);
    }
}
