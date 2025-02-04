<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUpdateRequest extends FormRequest
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
    public function rules()
    {
        $materialId = $this->route('materials') ? $this->route('materials')->id : null;

        return [
            'name' => 'required|string|max:255|unique:materials,name,' . $materialId,
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Material nomini kiritish majburiy.',
            'name.string'   => 'Material nomi faqat matn bo‘lishi kerak.',
            'name.max'      => 'Material nomi 255 ta belgidan oshmasligi kerak.',
            'name.unique'   => 'Bunday nomdagi material allaqachon mavjud.',
        ];
    }
}
