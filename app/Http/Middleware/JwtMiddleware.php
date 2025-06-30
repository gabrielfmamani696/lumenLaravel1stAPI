<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action
        // si el request no trae un header que se llame autherization
        if(!$request->header('Authorization')){
            return response()->json([
                'error'=> 'se requier el token'
            ], 401);
        }
        // en caso de si traerlo
        // sera un explode de algo vacio, o sea un Bearer Authorization
        $array_token = explode(' ', $request->header('Authorization'));
        // se supond que el 0token viene en 2da posicion ya que la primera siempre sera la palabra bearer.
        $token = $array_token[1];

        try {
            $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            
        } catch (ExpiredException $e) {// es una clase que trae el catch
            return response()->json([
                'error'=> 'el token ha expirado'
            ], 400);
        } catch(Exception $e) {
            return response()->json([
                'error'=>'Algo ha ocurrido al decodear el token'
            ], 400);
        }

        // en caso de que todo este correcto
        // que busque el suer con su id 
        $user = User::find($credentials->sub);
        
        $request->auth = $user;

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
