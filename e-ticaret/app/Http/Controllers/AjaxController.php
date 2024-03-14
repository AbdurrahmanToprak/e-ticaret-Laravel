<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentFromRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function contactStore(ContentFromRequest $request)
    {
      /*  $validationdata = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',

        ],
            [
                'name.required' => 'Ad Soyad alanı zorunludur.',
                'name.string' => 'Ad Soyad karakterlerden oluşmalı.',
                'name.min' => 'Ad Soyad en az 5 karakter olmalı.',
                'email.required' => 'E-posta alanı zorunludur.',
                'subject.required' => 'Konu alanı boş geçilemez.',
                'message.required' => 'Mesaj alanı boş geçilemez.',
                'email.email' => 'E-posta geçersiz.',

        ]); */
        $newdata = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => request()->ip(),

        ];
        Contact::create($newdata);

        return back()->with(['message' => 'Başarıyla kaydedildi.']);
    }
}
