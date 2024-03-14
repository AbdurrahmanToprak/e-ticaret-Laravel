<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentFromRequest extends FormRequest
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
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Ad Soyad alanı zorunludur.',
            'name.string' => 'Ad Soyad karakterlerden oluşmalı.',
            'name.min' => 'Ad Soyad en az 5 karakter olmalı.',
            'email.required' => 'E-posta alanı zorunludur.',
            'subject.required' => 'Konu alanı boş geçilemez.',
            'message.required' => 'Mesaj alanı boş geçilemez.',
            'email.email' => 'E-posta geçersiz.',

        ];
    }
}
