<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Exceptions\Exception;
use App\Models\UsuarioModel;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware{

    public function handle(Request $request, Closure $next): Response
    {

        try {
            $payload = JWTAuth::parseToken()->getPayload();

            
            if (!$payload) {
                return response()->json([
                    "status" => "ERROR",
                    "message" => "Usuario no encontrado"
                ], 404);
            }


            $sub = $payload->get('sub');
            $user = UsuarioModel::find($sub);
            
            if (!$user) {
                return response()->json([
                    "status" => "ERROR",
                    "message" => "Usuario no encontrado"
                ], 404);
            }
        

        } catch (TokenExpiredException $e) {
            return response()->json([
                "status" => "ERROR",
                "message" => "Token expirado"
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                "status" => "ERROR",
                "message" => "Token inválido"
            ], 401);
        } catch (JWTException $e) {
           
            return response()->json([
                "status" => "ERROR",
                "message" => "Error JWT: " . $e->getMessage()
            ], 401);
        } catch (\Exception $e) {
         
            return response()->json([
                "status" => "ERROR",
                "message" => "Error de autenticación: " . $e->getMessage()
            ], 401);
        }

        return $next($request);
    }
}