<?php
namespace App\Http\Respositories\Interfaces;
Interface UsuarioRepositoryInterface
{
    public function Listar();
    public function UsuarioById($id);
    // public function findByEmail($email);
    public function Guardar(array $data);
    public function Actualizar($id, array $data);
    // public function Eliminar($id);
    // public function Recuperar($id);
}
