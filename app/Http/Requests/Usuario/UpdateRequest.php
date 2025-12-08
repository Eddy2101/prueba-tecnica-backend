<?php
namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(){
        return [
            's_nombre'=>'required|string|max:100',
            's_email' => 'required|email|max:150|unique:usuarios,s_email',
            's_contrasenia' => 'required|string|min:6|confirmed'
        ];
    }
}