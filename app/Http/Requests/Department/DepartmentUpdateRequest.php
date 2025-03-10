<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Deparment nomi majburiy! Iltimos, nomni kiriting.',
            'name.string' => 'Deparment nomi faqat matn bo\'lishi kerak.',
            'name.max' => 'Deparment nomi 255 belgidan oshmasligi kerak.',
        ];
    }
}
