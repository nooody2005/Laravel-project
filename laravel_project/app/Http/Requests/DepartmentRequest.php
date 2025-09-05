<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
    $departmentId = $this->route('id');  // للتحديث نتجنب فحص الاسم للجدول نفسه

    return [
        'name' => [
            'required',
            'string',
            'max:255',
            $departmentId
                ? Rule::unique('departments', 'name')->ignore($departmentId)
                : Rule::unique('departments', 'name')
        ],
        'photo' => ['nullable', 'image', 'max:2048'], // حجم الصورة مثلاً 2 ميجابايت
        'description' => ['nullable', 'string', 'max:1000'],
    ];
}

}
