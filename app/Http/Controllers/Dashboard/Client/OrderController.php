<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return 'hello';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request, Client $client)
    {

        $categories=category::with('product')->get();

         $orders =$client->orders()->with('products')->paginate(5);

        return view('dashboard.clients.orders.create',compact('categories','client','orders'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Client $client)
    {

         //    $total_price=0;

    //   foreach( $request->product_ids as $index=>$product_id )
    //   {
    //       $order->products()->attach($product_id,['quantity'=>$request->quantity[$index]]);

    //       $product=Products::findOrFail($product_id);

    //       $total_price += $product->sale_price;
    //   }

    //   $order->update([
    //     'total_price'=>$total_price,
    //   ]);

    //   $product->update([
    //     'stock'=>$product->stock - $request->quantity[$index],
    //   ]);

        // dd($request->all());

        $request->validate(
            [
                'products'=>'required|array',
                // 'product_ids'=>'required|array',
                // 'quantity'=>'required|array',
            ]
        );


       $order=$client->orders()->create([]);

       $order->products()->attach($request->products);

    //    dd( $order);

       $total_price=0;


       foreach( $request->products as $id=>$quantity)
      {

          $product=Products::findOrFail($id);

          $total_price += $product->sale_price * $quantity['quantity'];
      }

        $order->update([
        'total_price'=>$total_price,
      ]);

         $product->update([
        'stock'=>$product->stock - $quantity['quantity'],
      ]);


      return redirect()->route('dashboard.clients.orders.create',$client->id)->with('success',__('site.added_successfully'));


    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client,Order $order)
    {

        //  return $order->products; //return product
        //  return $order;  //return order ->total_price

        $categories = Category::with('product')->get();
        // dd($categories);
        $orders = $client->orders()->with('products')->paginate(5);

        return view('dashboard.clients.orders.edit' ,compact('categories','client','order','orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Client $client,Order $order)
    {
        $request->validate(
            [
                'products'=>'required|array',
            ]
        );

        $this->detach_order($order);

        // $this->attach_order($request, $client);

        $order=$client->orders()->create([]);

        $order->products()->attach($request->products);

        //    dd( $order);

           $total_price=0;


           foreach( $request->products as $id=>$quantity)
          {

              $product=Products::findOrFail($id);

              $total_price += $product->sale_price * $quantity['quantity'];
          }

            $order->update([
            'total_price'=>$total_price,
          ]);

             $product->update([
            'stock'=>$product->stock - $quantity['quantity'],
          ]);


          return redirect()->route('dashboard.orders.index')->with('success',__('site.updated_successfully'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    //function to delete old order in update

    private function detach_order($order)
    {
        foreach($order->products as $product)
        {
           $product->update([

            'stock' =>$product->stock +$product->pivot->quantity,
           ]);
        }
        $order->delete();
    }

    //functon to add new order in update

    private function attach_order($client,$request)
    {

        $order=$client->orders()->create([]);

        $order->products()->attach($request->products);

        //    dd( $order);

           $total_price=0;


           foreach( $request->products as $id=>$quantity)
          {

              $product=Products::findOrFail($id);

              $total_price += $product->sale_price * $quantity['quantity'];
          }

            $order->update([
            'total_price'=>$total_price,
          ]);

             $product->update([
            'stock'=>$product->stock - $quantity['quantity'],
          ]);
    }

}
