<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category:id,cat_ust,name')->orderBy('id','desc')->paginate(20);
        return view('backend.pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.pages.product.edit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyaadi  = time().'-'. Str::slug($request->name).'.'.$resim->getClientOriginalExtension();
            $resim->move(public_path('img/product') , $dosyaadi);

        }


        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'content' => $request->content,
            'short_text' => $request->short_text,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'piece' => $request->piece,
            'image' => $dosyaadi,
        ]);
        return redirect()->route('panel.product.index')->withSuccess('Başarıyla oluşturuldu.');
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
        $product = Product::where('id' , $id)->first();
        $categories = Category::get();
        return view('backend.pages.product.edit' ,compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyaadi  = time().'-'. Str::slug($request->name).'.'.$resim->getClientOriginalExtension();
            $resim->move(public_path('img/product') , $dosyaadi);

            if ($product->image) {
                $eskiDosyaYolu = public_path('img/product') . '/' . $product->image;
                if (file_exists($eskiDosyaYolu)) {
                    unlink($eskiDosyaYolu);
                }
            }
        } else {

            $dosyaadi = $product->image;
        }
        Product::where('id',$id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'content' => $request->content,
            'short_text' => $request->short_text,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'piece' => $request->piece,
            'image' => $dosyaadi,
        ]);
        return redirect()->route('panel.product.index')->withSuccess('Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id', $request->id)->firstOrFail();

        if (!empty($product->image)) {
            dosyayiSil('img/product/' . $product->image);
        }

        $product->delete();

        return response(['error' => false, 'message' => 'Başarıyla silindi.']);
    }



    public function status(Request $request)
    {
        $update = $request->status;
        $updateCheck = $update == "false" ? '0' : '1';
        Product::where('id' , $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false , 'status' =>$update]);

    }
}
