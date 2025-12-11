<?php
namespace App\Http\Respositories;

use App\Models\Task;
use App\Http\Respositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function Listar($f_ini,$f_fin,$c_activo){
        return $this->model
                ->where('c_activo','S')
                ->Select('c_id','s_nombre','s_email','c_activo','c_usu_alta','c_usu_actualiza','f_alta','f_actualiza')
                ->OrderBy('f_alta','DESC')
                ->get();
    }
    public function Guardar(array $data)
    {
        throw new \Exception('Not implemented');
    }
    public function Eliminar($id)
    {
        throw new \Exception('Not implemented');
    }
    public function Actualizar($id, array $data)
    {
        throw new \Exception('Not implemented');
    }
}