<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStatusRequest extends FormRequest
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
        if ($this->getMethod() === "PATCH") {
            return [
                'name' => 'required|unique:task_statuses,name,' . $this->route()->id
            ];
        }
        return [
            'name' => 'required|unique:task_statuses|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => __('validation.unique', ['model' => 'Статус'])
        ];
    }
}