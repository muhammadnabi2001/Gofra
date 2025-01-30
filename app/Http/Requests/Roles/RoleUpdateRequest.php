<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'name.required' => 'Role nomi majburiy! Iltimos, nomni kiriting.',
            'name.string' => 'Role nomi faqat matn bo\'lishi kerak.',
            'name.max' => 'Role nomi 255 belgidan oshmasligi kerak.',
        ];
    }
}
