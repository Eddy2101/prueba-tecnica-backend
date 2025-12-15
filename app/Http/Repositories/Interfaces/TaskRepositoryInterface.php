<?php
namespace App\Http\Repositories\Interfaces;

Interface TaskRepositoryInterface
{
    public function Listar($f_ini,$f_fin,$c_activo);
    public function Guardar(array $data);
    public function Actualizar($id, array $data);
    public function Eliminar($id,$usuarioId);
    public function Recuperar($id, $usuarioId);
}