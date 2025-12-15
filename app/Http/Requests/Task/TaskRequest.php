<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'c_id_priority' => 'required|string',
            'c_id_status' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'c_id_priority.required' => 'La prioridad es obligatoria.',
            'c_id_status.required' => 'El estado es obligatorio.',
            'title.required' => 'El titulo es obligatoria.',
            
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
