<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:ingredients|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название ингредиента обязательно!',
            'name.unique' => 'Ингредиент с таким названием уже существует!',
            'name.max' => 'Название должно быть не больше 255 символов.',
            'category_id.exists' => 'Выбранная категория не существует.',
        ];
    }
}
