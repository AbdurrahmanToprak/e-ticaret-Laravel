<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('subcategory:id,cat_ust,name')->get();
        return view('backend.pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.pages.category.edit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyaadi  = time().'-'. Str::slug($request->name).'.'.$resim->getClientOriginalExtension();
            $resim->move(public_path('img/category') , $dosyaadi);

        }
        Category::create([
            'name' => $request->name,
            'cat_ust' => $request->cat_ust,
            'status' => $request->status,
            'content' => $request->content,
            'image' => $dosyaadi,
        ]);
        return redirect()->route('panel.category.index')->withSuccess('Başarıyla oluşturuldu.');
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
        $category = Category::where('id' , $id)->first();
        $categories = Category::get();
        return view('backend.pages.category.edit' ,compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyaadi  = time().'-'. Str::slug($request->name).'.'.$resim->getClientOriginalExtension();
            $resim->move(public_path('img/category') , $dosyaadi);

            if ($category->image) {
                $eskiDosyaYolu = public_path('img/category') . '/' . $category->image;
                if (file_exists($eskiDosyaYolu)) {
                    unlink($eskiDosyaYolu);
                }
            }
        } else {

            $dosyaadi = $slider->image;
        }
        Category::where('id',$id)->update([
            'name' => $request->name,
            'cat_ust' => $request->cat_ust,
            'status' => $request->status,
            'content' => $request->content,
            'image' => $dosyaadi,
        ]);
        return redirect()->route('panel.category.index')->withSuccess('Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->firstOrFail();

        dosyayiSil('img/category/' . $category->image);
        $category->delete();

        return response(['error' => false, 'message' => 'Başarıyla silindi.']);
    }


    public function status(Request $request)
    {
        $update = $request->status;
        $updateCheck = $update == "false" ? '0' : '1';
        Category::where('id' , $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false , 'status' =>$update]);

    }
}
