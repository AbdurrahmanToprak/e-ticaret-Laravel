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
            'name' => 'required|string|min:5',
            'content' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Başlık alanı zorunludur.',
            'name.string' => 'Başlık karakterlerden oluşmalı.',
            'name.min' => 'Başlık en az 5 karakter olmalı.',
            'content.required' => 'İçerik alanı zorunludur.',
            'image.mimes' => 'Resim alanı jpeg,png,jpg,gif formatında yüklenebilir.',

        ];
    }
}
