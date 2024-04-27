<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class CartController extends Controller
{

    public function index()
    {
        $cartItem = $this->cartList();
        return view("frontend.pages.cart" , compact('cartItem'));

    }

    public function cartList(){
        $cartItem = session()->get('cart') ?? [];

        $totalPrice = 0;

        foreach ($cartItem as $cart)
        {
            $kdvOrani = $cart['kdv'] ?? 0;
            $kdvTutar = ($cart['price'] * $cart['piece']) * ($kdvOrani /100);
            $toplamTutar = $cart['price'] * $cart['piece'] + $kdvTutar;

            $totalPrice += $toplamTutar;
        }
        if(session()->get('coupon_code') && $totalPrice != 0){
            $coupon = Coupon::where('name' , session()->get('coupon_code'))->where('status' , '1')->first();
            $couponPrice = $coupon->price ?? 0;

            $newTotalPrice = $totalPrice - $couponPrice;
        }else{
            $newTotalPrice = $totalPrice;
        }

        session()->put('total_price' ,$newTotalPrice);

        if(empty(session()->get('cart'))){
            session()->forget('coupon_code');
        }
        return $cartItem;
    }

    public function sepetForm()
    {
        $cartItem = $this->cartList();

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
                'kdv' => $urun->kdv,
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
            $kdvOraniitem = $urun->kdv ?? 0;
            $kdvTutaritem = ($urun->price * $piece) * ($kdvOraniitem /100);
            $itemTotal = $urun->price * $piece + $kdvTutaritem;
        }

        session(['cart' => $cartItem]);

        $this->cartList();

        if($request->ajax()){
            return response()->json(['itemTotal' => $itemTotal,'totalPrice' => session()->get('total_price'),'message' => 'Sepet Güncellendi.']);
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

        if(count(session()->get('cart')) == 0){
            session()->forget('coupon_code');
        }
        return back()->withSuccess('Basariyla sepetten cikarildi.');

    }
    public function couponCheck(Request $request)
    {

        $coupon = Coupon::where('name' , $request->coupon_name)->where('status' , '1')->first();
        if(empty($coupon)){
            return back()->withError('Kupon Bulunamadı.');
        }
        $couponCode = $coupon->name ?? '';
        session()->put('coupon_code' ,$couponCode);

        $couponPrice = $coupon->price ?? 0;
        session()->put('coupon_price' ,$couponPrice);


        $this->cartList();

        return back()->withSuccess('Kupon Başarıyla Uygulandı.');
    }

    function generateCode(){
        $siparis_no = generateOTP(7);
        if($this->barcodeKodExists($siparis_no)){
            return $this->generateCode();
        }
        return $siparis_no;
    }

    function barcodeKodExists($siparis_no){
        return Invoice::where('order_no',$siparis_no)->exists();
    }

    public function cartSave(Request $request)
    {
        $request->validate([
            'name' => 'required | string | min:3',
            'country' => 'required | string',
            'company_name' => 'nullable | string',
            'address' => 'required | string',
            'city' => 'required | string',
            'district' => 'required | string',
            'zip_code' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required | string',
            'note' => 'nullable | string',
        ],[
            'name.min' => 'İsim en az :min karakterden oluşmalıdır.',
            'country.required' => 'Ülke alanı boş bırakılamaz.',
            'country.string' => 'Ülke dize türünde olmalıdır.',
            'name.required' => 'İsim alanı boş bırakılamaz.',
            'name.string' => 'İsim dize türünde olmalıdır.',
            'company_name.string' => 'Şirket adı dize türünde olmalıdır.',
            'address.required' => 'Adres alanı boş bırakılamaz.',
            'address.string' => 'Adres dize türünde olmalıdır.',
            'city.required' => 'Şehir alanı boş bırakılamaz.',
            'city.string' => 'Şehir dize türünde olmalıdır.',
            'district.required' => 'İlçe/Görev alanı boş bırakılamaz.',
            'district.string' => 'İlçe/Görev dize türünde olmalıdır.',
            'zip_code.required' => 'Posta kodu alanı boş bırakılamaz.',
            'zip_code.string' => 'Posta kodu dize türünde olmalıdır.',
            'email.required' => 'E-posta adresi alanı boş bırakılamaz.',
            'email.email' => 'Geçerli bir e-posta adresi girilmelidir.',
            'phone.required' => 'Telefon numarası alanı boş bırakılamaz.',
            'phone.string' => 'Telefon numarası dize türünde olmalıdır.',
            'note.string' => 'Not dize türünde olmalıdır.',
    ]);

        $invoice = Invoice::create([
            "user_id" => auth()->user()->id ?? null,
            "order_no"=> $this->generateCode(),
            "country"=> $request->country,
            "name"=> $request->name,
            "company_name"=> $request->company_name,
            "address"=> $request->address,
            "city"=> $request->city,
            "district"=> $request->district,
            "zip_code"=> $request->zip_code,
            "email"=> $request->email,
            "phone"=> $request->phone,
            "note"=> $request->note,
        ]);

        $cart = session()->get('cart') ?? [];
        foreach ($cart as $key => $item){
            Order::create([
                'order_no' => $invoice->order_no,
                'product_id' =>$key,
                'name' => $item['name'],
                'price' => $item['price'],
                'piece' => $item['piece'],
                'kdv' => $item['kdv'],

            ]);


        }
        session()->forget('cart');
        return redirect()->route('home')->withSuccess('Alışveriş başarıyla tamamlandı');
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
