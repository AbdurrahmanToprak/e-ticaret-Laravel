<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function products()
    {
        $products = Product::where('status' , '1')->paginate(1);
        return view("frontend.pages.products" , compact('products'));
    }
    public function productsOnSale()
    {
        return view("frontend.pages.products");
    }
    public function cart()
    {
        return view("frontend.pages.cart");
    }
    public function about()
    {
        $about = About::where('id', 1)->first();
        return view("frontend.pages.about" , compact('about'));
    }
    public function contact()
    {
        return view("frontend.pages.contact");
    }
    public function productDetail($slug)
    {
        $product = Product::where('slug' , $slug)->first();
        return view("frontend.pages.product" , compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
