<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Invoice::withCount('orders')->paginate(10);
        return view('backend.pages.orders.index',compact('orders'));
    }



    public function edit(string $id)
    {
        $invoice = Invoice::where('id', $id)->with('orders')->firstOrFail();
        return view('backend.pages.orders.edit',compact('invoice'));

    }


    public function update(Request $request, string $id)
    {
    //
    }

    public function destroy(Request $request)
    {
        $order = Invoice::where('id', $request->id)->firstOrFail();
        Order::where('order_no', $order->order_no)->delete();
        $order->delete();

        return response(['error' => false, 'message' => 'Başarıyla silindi.']);
    }


    public function status(Request $request)
    {
        $update = $request->status;
        $updateCheck = $update == "false" ? '0' : '1';
        Invoice::where('id' , $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false , 'status' =>$update]);

    }
}
