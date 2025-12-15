<?php
namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UsuarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('id');
        
        return [
            's_nombre' => 'sometimes|string|max:100',
            's_email' => 'sometimes|email|max:150|unique:usuarios,s_email,' . $userId . ',c_id',
            's_contrasenia' => 'sometimes|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            's_nombre.max' => 'El nombre no puede exceder 100 caracteres',
            's_nombre.string' => 'El nombre debe ser un texto válido',
            's_email.email' => 'El email no es válido',
            's_email.unique' => 'Este email ya está registrado',
            's_contrasenia.string' => 'La contraseña debe ser un texto válido',
            's_contrasenia.min' => 'La contraseña debe tener al menos 6 caracteres',
            's_contrasenia.confirmed' => 'Las contraseñas no coinciden',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => "ERROR",
            'errors' => $validator->errors()
        ], 422));
    }
}