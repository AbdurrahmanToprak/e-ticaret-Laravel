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
        return view('backend.pages.slider.edit');
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
        return redirect()->route('panel.slider')->withSuccess('Başarıyla oluşturuldu.');
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
        $slider = Slider::findOrFail($id);

        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyaadi  = time().'-'. Str::slug($request->name).'.'.$resim->getClientOriginalExtension();
            $resim->move(public_path('img/slider') , $dosyaadi);

            if ($slider->image) {
                $eskiDosyaYolu = public_path('img/slider') . '/' . $slider->image;
                if (file_exists($eskiDosyaYolu)) {
                    unlink($eskiDosyaYolu);
                }
            }
        } else {

            $dosyaadi = $slider->image;
        }
        Slider::where('id',$id)->update([
            'name' => $request->name,
            'content' => $request->content,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $dosyaadi,
        ]);
        return redirect()->route('panel.slider')->withSuccess('Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::where('id' , $id)->firstOrFail();

        if(file_exists($slider->image)){
            if(!empty($slider->image)){
                unlink('img/slider/'.$slider->image);
            }
        }
        $slider->delete();
        return redirect()->route('panel.slider')->withSuccess('Başarıyla Silindi.');

    }

    public function status(Request $request)
    {
        $update = $request->status;
        $updateCheck = $update == "false" ? '0' : '1';
        Slider::where('id' , $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false , 'status' =>$update]);

    }
}
