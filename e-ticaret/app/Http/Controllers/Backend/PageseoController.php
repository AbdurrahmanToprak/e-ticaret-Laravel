<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PageSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageseoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageseos = Pageseo::all();
        return view('backend.pages.pageseo.index',compact('pageseos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.pageseo.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pagereq = $request->page;
        $sor = PageSeo::where('page' , $pagereq)->first();

        if(!empty($sor)){
            return back()->withSuccess('Zaten Kayıtlı Sayfa!');
        }

        Pageseo::create([
            'dil' => $request->dil,
            'page' => $request->page,
            'page_ust' => $request->page_ust,
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'contents' => $request->contents,

        ]);
        return redirect()->route('panel.pageseo')->withSuccess('Başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageseo = Pageseo::where('id' , $id)->first();
        return view('backend.pages.pageseo.edit' ,compact('pageseo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pageseo = Pageseo::where('id',$id)->findOrFail($id);

        $pagereq = $request->page;
        $sor = PageSeo::where('id', '!=' , $pageseo->id)->where('page' , $pagereq)->first();

        if(!empty($sor)){
            return back()->withSuccess('Zaten Kayıtlı Sayfa!');
        }

        $pageseo->update([
            'dil' => $request->dil,
            'page' => $request->page,
            'page_ust' => $request->page_ust,
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'contents' => $request->contents,
        ]);
        return redirect()->route('panel.pageseo')->withSuccess('Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $pageseo = Pageseo::where('id', $request->id)->firstOrFail();

        dosyayiSil('img/pageseo/' . $pageseo->image);
        $pageseo->delete();

        return response(['error' => false, 'message' => 'Başarıyla silindi.']);
    }

}
