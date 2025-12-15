<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;
use App\Http\Repositories\Interfaces\UsuarioRepositoryInterface;
use App\Http\Requests\Usuario\UsuarioRequest as saveUsuarioRequest;
use Illuminate\Http\Response;

class UsuarioController extends Controller{
    protected $usuarioRepository;

    public function __construct(
        UsuarioRepositoryInterface $usuarioRepository
    )
    {
        $this->usuarioRepository = $usuarioRepository;
        
    }

    public function Listar(){
        $usuarios = $this->usuarioRepository->Listar();

        return response()->json([
            "status"=> "OK",
            "message"=>"Se ejecuto correctamente",
            "data"=> $usuarios
        ],Response::HTTP_OK);

    }

    public function Guardar(saveUsuarioRequest $request){
        $datos = [
            's_nombre' => $request->s_nombre,
            's_email' => $request->s_email,
            's_contrasenia' => $request->s_contrasenia,
            'c_usu_alta' => 'ADMIN',
            'c_activo' => 'S'
        ];

        $usuario = $this->usuarioRepository->Guardar($datos);

        return response()->json([
            'status'=> "OK",
            'message' => 'Se creo correctamente',
            'data' => $usuario
        ],Response::HTTP_CREATED);
    }

    public function Actualizar(UpdateUsuarioRequest $request,$c_id){
        $datos = $request->only(['s_nombre', 's_email']);
        
        if ($request->filled('s_contrasenia')) {
            $datos['s_contrasenia'] = $request->s_contrasenia;
        }

        $datos['c_usuario_modificacion'] = 'ADMIN';

        $usuario = $this->usuarioRepository->Actualizar($c_id, $datos);

        if (!$usuario) {
            return response()->json([
                'status'=> "ERROR",
                'message' => 'No se encontro el usuario'
            ], 404);
        }

        return response()->json([
            'status'=> "OK",
            'message' => 'Se actualizo correctamente',
            'data' =>$usuario
        ], 200);

    }
}