<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
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
        if(session()->get('coupon_code')){
            $coupon = Coupon::where('name' , session()->get('coupon_code'))->where('status' , '1')->first();
            $couponPrice = $coupon->price ?? 0;
            $couponCode = $coupon->name ?? '';

            $newTotalPrice = $totalPrice - $couponPrice;
        }else{
            $newTotalPrice = $totalPrice;
        }

        session()->put('total_price' ,$newTotalPrice);
        return view("frontend.pages.cart" , compact('cartItem'));

    }

    public function sepetForm()
    {
        $cartItem = session('cart', []);
        $totalPrice = 0;

        foreach ($cartItem as $cart)
        {
            $totalPrice += $cart['price'] * $cart['piece'];
        }
        if(session()->get('coupon_code')){
            $coupon = Coupon::where('name' , session()->get('coupon_code'))->where('status' , '1')->first();
            $couponPrice = $coupon->price ?? 0;
            $couponCode = $coupon->name ?? '';

            $newTotalPrice = $totalPrice - $couponPrice;
        }else{
            $newTotalPrice = $totalPrice;
        }

        session()->put('total_price' ,$newTotalPrice);
        return view("frontend.pages.cartForm" , compact('cartItem'));

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
                'piece' => $piece ?? 1,
                'size' => $size,
            ];
        }
        session(['cart' => $cartItem]);

        if($request->ajax()){
            return response()->json(['Sepet Güncellendi.']);
        }
        return back()->withSuccess('Urun Sepete Eklendi.');
    }

    public function newqty(Request $request){
        $product_id = $request->product_id;
        $itemTotal = 0;
        $piece = $request->piece;
        $urun = Product::find($product_id);
        if(!$urun){

            return response()->json(['Urun Bulunamadi.']);
        }
        $cartItem = session('cart' , []);

        if(array_key_exists($product_id,$cartItem)){
            $cartItem[$product_id]['piece'] = $piece;
            if($piece == 0 || $piece < 0){
                unset($cartItem[$product_id]);
            }
            $itemTotal = $urun->price * $piece;
        }

        session(['cart' => $cartItem]);

        if($request->ajax()){
            return response()->json(['itemTotal' => $itemTotal,'message' => 'Sepet Güncellendi.']);
        }
        return back()->withSuccess('Urun Sepete Eklendi.');
    }
    public function remove(Request $request)
    {
        $product_id = $request->product_id;
        $cartItem = session('cart' , []);
        if(array_key_exists($product_id,$cartItem)){
            unset($cartItem[$product_id]);
        }
        session(['cart' => $cartItem]);
        return back()->withSuccess('Basariyla sepetten cikarildi.');

    }
    public function couponCheck(Request $request)
    {

        $cartItem = session('cart', []);
        $totalPrice = 0;

        foreach ($cartItem as $cart)
        {
            $totalPrice += $cart['price'] * $cart['piece'];
        }

        $coupon = Coupon::where('name' , $request->coupon_name)->where('status' , '1')->first();
        if(empty($coupon)){
            return back()->withError('Kupon Bulunamadı.');
        }
        $couponPrice = $coupon->price ?? 0;
        $couponCode = $coupon->name ?? '';

        $newTotalPrice = $totalPrice - $couponPrice;
        session()->put('total_price' ,$newTotalPrice);
        session()->put('coupon_code' ,$couponCode);

        return back()->withSuccess('Kupon Başarıyla Uygulandı.');
    }

    public function cartSave(Request $request)
    {
        return $request->all();
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
