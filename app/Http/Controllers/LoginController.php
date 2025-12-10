<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Http\Requests\Login\RegisterRequest;
use App\Http\Requests\Usuario\UsuarioRequest;
use App\Http\Respositories\Interfaces\UsuarioRepositoryInterface;
use App\Models\UsuarioModel;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller{
    protected $usuarioRepository;

    public function __construct(
        UsuarioRepositoryInterface $usuarioRepository
    )
    {
        $this->usuarioRepository = $usuarioRepository;
        
    }

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

    public function register(UsuarioRequest $request){
        $datos = [
            's_nombre' => $request->s_nombre,
            's_email' => $request->s_email,
            's_contrasenia' => $request->s_contrasenia,
            's_repite_contrasenia'=>$request->s_contrasenia,
            'c_usu_alta' => 'ADMIN',
            'c_activo' => 'S'
        ];

        $usuario = $this->usuarioRepository->Guardar($datos);

        return response()->json([
            'success' => true,
            'message' => 'Se creo correctamente',
            'data' => $usuario
        ],Response::HTTP_CREATED);
    }
}