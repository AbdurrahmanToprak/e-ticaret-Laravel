<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $cartItem = session('cart', []);
        $totalPrice = 0;

        foreach ($cartItem as $cart)
        {
            $totalPrice += $cart['price'] * $cart['piece'];
        }
        return view("frontend.pages.cart" , compact('cartItem' , 'totalPrice'));

    }


    public function add(Request $request)
    {
        $product_id = $request->product_id;
        $piece = $request->piece;
        $size = $request->size;
        $urun = Product::find($product_id);
        if(!$urun){
            return back()->withErrors('Urun Bulunamadi.');
        }
        $cartItem = session('cart' , []);
        if(array_key_exists($product_id,$cartItem)){
            $cartItem[$product_id]['piece'] += $piece;
        }else{
            $cartItem[$product_id] = [
              'image' => $urun->image,
                'name' => $urun->name,
                'price' => $urun->price,
                'piece' => $piece,
                'size' => $size,
            ];
        }
        session(['cart' => $cartItem]);
        return back()->withSuccess('Urun Sepete Eklendi.');
    }
    public function remove(string $id)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

}
