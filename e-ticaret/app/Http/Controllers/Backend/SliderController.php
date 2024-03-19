<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.pages.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyaadi  = time().'-'. Str::slug($request->name).'.'.$resim->getClientOriginalExtension();
            $resim->move(public_path('img/slider') , $dosyaadi);

        }
        Slider::create([
           'name' => $request->name,
           'content' => $request->content,
           'link' => $request->link,
            'status' => $request->status,
            'image' => $dosyaadi,
        ]);
        return back()->withSuccess('Başarıyla oluşturuldu.');
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
        $slider = Slider::where('id' , $id)->first();
        return view('backend.pages.slider.edit' ,compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
