<?php

namespace App\Http\Controllers;

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


    public function add()
    {
        //
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
