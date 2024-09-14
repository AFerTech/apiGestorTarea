<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        $method = $this->method();

        if($method == 'PUT'){
            return [
            'titulo' => ['required'],
            'descripcion' => ['required'],
            'prioridad' => ['required',Rule::in(['baja','media','alta'])],
            'fecha_vencimiento' => ['required']
            ];
        }else{
            return [
            'titulo' => ['sometimes','required'],
            'descripcion' => ['sometimes','required'],
            'prioridad' => ['sometimes','required',Rule::in(['baja','media','alta'])],
            'fecha_vencimiento' => ['sometimes','required']
            ];

        }

    }
}
