<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monthOrdersCount = Order::where('created_at', '>=' , now()->subDays(30))->count();
        $monthOrdersPrice = Order::select(DB::raw('SUM(piece * price * (1+ kdv / 100)) as total_revenue'))
            ->where('created_at', '>=' , now()->subDays(30))
            ->value('total_revenue');

        $ordersCount = Order::count();

        $orderPrice =  Order::select(DB::raw('SUM(piece * price * (1+ kdv / 100)) as total_revenue'))
            ->value('total_revenue');

        $topProducts = Order::select('product_id' , 'name' , DB::raw('SUM(piece) as total_sold'))
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('backend.pages.index' , compact('monthOrdersCount','monthOrdersPrice' ,'ordersCount' , 'orderPrice' ,'topProducts'));
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
