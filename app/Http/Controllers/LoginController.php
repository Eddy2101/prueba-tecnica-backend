<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Models\UsuarioModel;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller{
    public function login(LoginRequest $request){
        $usuario = UsuarioModel::where('s_email', $request->s_email)
            ->where('c_activo', 'S')
            ->first();

        if (!$usuario) {
            return response()->json(['message' => 'No existe usuario con estas credenciales','token'=>null], Response::HTTP_UNAUTHORIZED);
        }

        if (!Hash::check($request->s_contrasenia, $usuario->s_contrasenia)) {
            return response()->json(['message' => 'La contraseña es incorrecta','token'=>null], Response::HTTP_UNAUTHORIZED);
        }

        $token = JWTAuth::fromUser($usuario);
        return response()->json([
            'success' => true,
            'message' => 'Autenticación exitosa',
            'token' => $token
        ],Response::HTTP_OK);
    }
}