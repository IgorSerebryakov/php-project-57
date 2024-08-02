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
        $rules = [
            'name' => 'required|unique:task_statuses,name,' . $this->route()->id
        ];

        if ($this->getMethod() === "PATCH") {
            $rules['name'] .= ',name,' . $this->route()->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.unique' => __('validation.unique', ['model' => 'Статус'])
        ];
    }
}
