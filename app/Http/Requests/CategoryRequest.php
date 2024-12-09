<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'max:255',
            'image' => 'max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название категории обязательно!',
            'name.unique' => 'Категория с таким названием уже существует!',
            'name.max' => 'Название категории не должно превышать 255 символов.',
        ];
    }
}
