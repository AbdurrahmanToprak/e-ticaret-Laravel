<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'name' => 'required | string | min:3',
            'country' => 'required | string',
            'company_name' => 'nullable | string',
            'address' => 'required | string',
            'city' => 'required | string',
            'district' => 'required | string',
            'zip_code' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required | string',
            'note' => 'nullable | string',


        ];
    }
    public function messages(): array
    {
        return [
            'name.min' => 'İsim en az :min karakterden oluşmalıdır.',
            'country.required' => 'Ülke alanı boş bırakılamaz.',
            'country.string' => 'Ülke dize türünde olmalıdır.',
            'name.required' => 'İsim alanı boş bırakılamaz.',
            'name.string' => 'İsim dize türünde olmalıdır.',
            'company_name.string' => 'Şirket adı dize türünde olmalıdır.',
            'address.required' => 'Adres alanı boş bırakılamaz.',
            'address.string' => 'Adres dize türünde olmalıdır.',
            'city.required' => 'Şehir alanı boş bırakılamaz.',
            'city.string' => 'Şehir dize türünde olmalıdır.',
            'district.required' => 'İlçe/Görev alanı boş bırakılamaz.',
            'district.string' => 'İlçe/Görev dize türünde olmalıdır.',
            'zip_code.required' => 'Posta kodu alanı boş bırakılamaz.',
            'zip_code.string' => 'Posta kodu dize türünde olmalıdır.',
            'email.required' => 'E-posta adresi alanı boş bırakılamaz.',
            'email.email' => 'Geçerli bir e-posta adresi girilmelidir.',
            'phone.required' => 'Telefon numarası alanı boş bırakılamaz.',
            'phone.string' => 'Telefon numarası dize türünde olmalıdır.',
            'note.string' => 'Not dize türünde olmalıdır.',
        ];
    }

}
