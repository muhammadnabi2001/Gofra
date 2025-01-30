<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class GroupUpdateRequest extends FormRequest
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
            'name.required' => 'Group nomi majburiy! Iltimos, nomni kiriting.',
            'name.string' => 'Group nomi faqat matn bo\'lishi kerak.',
            'name.max' => 'Group nomi 255 belgidan oshmasligi kerak.',
        ];
    }
}
