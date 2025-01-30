<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionCreateRequest extends FormRequest
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
            'group_id' => 'required|exists:permission_groups,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Permission Nomi majburiy maydon.',
            'name.string' => 'Permission Nomi matn ko‘rinishida bo‘lishi kerak.',
            'name.max' => 'Permissioni Nomi maksimal 255 ta belgidan oshmasligi kerak.',

            'group_id.required' => 'Guruhni tanlash majburiy.',
            'group_id.exists' => 'Tanlangan guruh mavjud emas.',
        ];
    }
}
