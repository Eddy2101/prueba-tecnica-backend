<?php

namespace App\Http\Repositories;

use App\Models\Task;
use App\Http\Repositories\Interfaces\TaskRepositoryInterface;
use Carbon\Carbon;

class TaskRepository implements TaskRepositoryInterface
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function Listar($f_ini, $f_fin, $c_activo)
    {
        $query = $this->model
            ->leftJoin('usuarios as ua', 'ua.c_id', '=', 'tasks.c_usu_alta')
            ->leftJoin('usuarios as uu', 'uu.c_id', '=', 'tasks.c_usu_actualiza')
            ->select(
                'tasks.c_id as c_id',
                'tasks.title',
                'tasks.description',
                'tasks.c_id_status',
                'tasks.c_id_priority',
                'tasks.c_activo',
                'tasks.c_usu_alta',
                'tasks.c_usu_actualiza',
                'tasks.f_alta',
                'tasks.f_actualiza',
                'ua.s_nombre as usuario_crea',
                'uu.s_nombre as usuario_actualiza'
            );
            

        if (!empty($c_activo)) {
            $query->where('tasks.c_activo', $c_activo);
        }

        $query->whereBetween('tasks.f_alta', [
            Carbon::parse($f_ini)->startOfDay(),
            Carbon::parse($f_fin)->endOfDay()
        ]);

        $query->orderBy('tasks.f_alta', 'DESC');

        return $query->get();
    }
    public function Guardar(array $data)
    {
        return $this->model->create($data);
    }
    public function Eliminar($id, $usuarioId)
{
        $task = $this->model->findOrFail($id);

        $task->c_activo = 'N';
        $task->c_usu_actualiza = $usuarioId;
        $task->f_actualiza = now();

        $task->save();

        return $task;
    }
    public function Actualizar($id, array $data)
    {
        $task = $this->model->findOrFail($id);

        $task->fill($data)->save();

        return $task;
    }
    public function Recuperar($id, $usuarioId)
    {
        $task = $this->model->findOrFail($id);

        $task->c_activo = 'S';
        $task->c_usu_actualiza = $usuarioId;
        $task->f_actualiza = now();

        $task->save();

        return $task;
    }
}
