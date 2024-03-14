<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function contactStore(Request $request)
    {
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
