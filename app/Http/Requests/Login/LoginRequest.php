<?php
namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            's_email' => 'required|email',
            's_contrasenia' => 'required|string|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            's_email.required' => 'El correo es obligatorio.',
            's_email.email' => 'Debe ser un correo válido.',
            's_contrasenia.required' => 'La contraseña es obligatoria.',
            's_contrasenia.min' => 'La contraseña debe tener mínimo 6 caracteres.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($validator === null) {
           $validator = $this->validator;
        }
        throw new HttpResponseException(response()->json([
            'status' => "ERROR",
            'errors' => $validator->errors()
        ], 422));
    }
}