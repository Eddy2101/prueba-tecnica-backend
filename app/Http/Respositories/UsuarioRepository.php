<?php

namespace App\Http\Respositories;

use App\Models\UsuarioModel;
use App\Http\Respositories\Interfaces\UsuarioRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    protected $model;

    public function __construct(UsuarioModel $model)
    {
        $this->model = $model;
    }

    public function Listar()
    {
        return $this->model
                ->where('c_activo','S')
                ->Select('c_id','s_nombre','s_email','c_activo','c_usu_alta','c_usu_actualiza','f_alta','f_actualiza')
                ->OrderBy('f_alta','DESC')
                ->get();
    }

    public function Guardar(array $data)
    {
        if (isset($data['s_contrasenia'])) {
            $data['s_contrasenia'] = Hash::make($data['s_contrasenia']);

        }

        return $this->model->create($data);
    }

    public function UsuarioById($id)
    {
        return $this->model->find($id);
    }

    public function Actualizar($id, array $data)
    {
        $usuario = $this->UsuarioById($id);

        if (!$usuario) {
            return null;
        }

        if (isset($data['s_contrasenia'])) {
            $data['s_contrasenia'] = Hash::make($data['s_contrasenia']);
        }

        $usuario->update($data);

        return $usuario->fresh();

    }

}