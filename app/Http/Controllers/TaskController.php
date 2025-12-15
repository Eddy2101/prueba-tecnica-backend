<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\TaskRepositoryInterface;
use App\Http\Requests\Task\TaskRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskController extends Controller
{
    //
    protected $TaskRepository;

    public function __construct(TaskRepositoryInterface $TaskRepository)
    {
        $this->TaskRepository = $TaskRepository;
    }

    public function Listar(Request $request)
    {
        $f_ini     = $request->input('f_ini');
        $f_fin     = $request->input('f_fin');
        $c_activo  = $request->input('c_activo');

        $tasks =  $this->TaskRepository->Listar($f_ini,$f_fin,$c_activo);

        return response()->json([
            'status'=> "OK",
            "message"=>"Se ejecuto correctamente",
            "data"=> $tasks
        ],Response::HTTP_OK);
    }
    public function Guardar(TaskRequest $request)
    {
        $user = JWTAuth::parseToken()->getPayload();
        
        $data = $request->validated();

        $data['c_usu_alta'] = $user->get('sub');

        $task = $this->TaskRepository->Guardar($data);

        if(!$task){
            return response()->json([
                'status'=> "ERROR",
                "message"=>"No se pudo registrar",
                "data"=> $task
            ],Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'status'=> "OK",
            "message"=>"Se registro correctamente",
            "data"=> $task
        ],Response::HTTP_OK);
    }
    public function Actualizar(TaskRequest $request,$id)
    {
        $user = JWTAuth::parseToken()->getPayload();

        $data = $request->validated();

        $data['c_usu_actualiza'] = $user->get('sub');

        $data['f_actualiza'] = now();


        $task = $this->TaskRepository->Actualizar($id,$data);

        if(!$task){
            return response()->json([
                'status'=> "ERROR",
                "message"=>"No se pudo actualizar",
                "data"=> $task
            ],Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'status'=> "OK",
            "message"=>"Se actualizo correctamente",
            "data"=> $task
        ],Response::HTTP_OK);
    }
    public function Eliminar($id)
    {

         $user = JWTAuth::parseToken()->getPayload();

       
        $task = $this->TaskRepository->Eliminar(
            $id,
            $user->get('sub')
        );

        if(!$task){
            return response()->json([
                'status'=> "ERROR",
                "message"=>"No se pudo eliminar",
                "data"=> $task
            ],Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'status'=> "OK",
            "message"=>"Se elimino correctamente",
            "data"=> $task
        ],Response::HTTP_OK);
    }

    public function Recuperar($id)
    {

         $user = JWTAuth::parseToken()->getPayload();

       
        $task = $this->TaskRepository->Recuperar(
            $id,
            $user->get('sub')
        );

        if(!$task){
            return response()->json([
                'status'=> "ERROR",
                "message"=>"No se pudo recuperar la tarea",
                "data"=> $task
            ],Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'status'=> "OK",
            "message"=>"Se recupero correctamente",
            "data"=> $task
        ],Response::HTTP_OK);
    }
}
