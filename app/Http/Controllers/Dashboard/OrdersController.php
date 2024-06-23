<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders=Order::paginate(5);

        return view('dashboard.orders.index',compact('orders'));
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
    public function products( Order $order)
    {
        // $products =$order->products()->get();

        // dd($products);

        $products =$order->products;

        return view('dashboard.orders._products',compact('products','order'));




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
    public function destroy(Order $order)
    {
        //
        // dd($order->products->first()->pivot->quantity); //2

        foreach($order->products as $product)
        {
           $product->update([

            'stock' =>$product->stock +$product->pivot->quantity,
           ]);
        }

        // dd('done');

        $order->delete();

        return redirect()->route('dashboard.orders.index')->with('success',__('site.deleted_successfully'));
    }
}
