<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('backend.pages.contact.index',compact('contacts'));
    }



    public function edit(string $id)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        return view('backend.pages.contact.edit',compact('contact'));

    }


    public function update(Request $request, string $id)
    {
        $update = $request->status;
        Contact::where('id' , $id)->update(['status' => $update]);
        return back()->withSuccess('Başarıyla güncellendi.');
    }

    public function destroy(Request $request)
    {
        $contact = Contact::where('id', $request->id)->firstOrFail();

        $contact->delete();

        return response(['error' => false, 'message' => 'Başarıyla silindi.']);
    }


    public function status(Request $request)
    {
        $update = $request->status;
        $updateCheck = $update == "false" ? '0' : '1';
        Contact::where('id' , $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false , 'status' =>$update]);

    }
}
