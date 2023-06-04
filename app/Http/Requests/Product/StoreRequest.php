<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'preview_image' => 'required|image',
            'images' => 'nullable|array',
            'price' => 'required|decimal:2',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'title' => 'Обязательное поле',
            'preview_image' => 'Обязательное поле',
            'images' => 'Загрузите изображения',
            'price' => 'Обязательное поле, формат xxxx.xx',
            'description' => 'Обязательное поле',
            'category_id' => 'Обязательное поле',
            'size' => 'Обязательное поле'
        ];
    }
}
