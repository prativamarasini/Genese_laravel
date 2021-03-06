<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        // $order_id = session('order_id',0);
        // $order_id = request()->session()->get('order_id', '0');

        $key = Auth::user()->id;
        // return $order_id;
        //$result = Order::where('user_id','=',$order_id);


        // $result = Order::whereUserId($key)->get();  
        // return $result[0]->user_id;


        $result = Order::whereUserId($key)->first(); //returns array
        if ($result) {
            if ($result->user_id == $key) {
                //adding items to cart ->creating new order item
                $order_item = new OrderItem();
                $order_item->order_id = $result->id;
                $order_item->product_id = $request->input('product_id');
                $product = product::find($order_item->product_id);
                $order_item->product_price = $product->price;
                $order_item->quantity = $request->input('quantity');
                $order_item->total = $order_item->quantity *  $order_item->product_price;
                $order_item->save();
                session(['order_id' => $result->id]);

                $order_update =  Order::whereUserId($key)->first();
                $order_update->sub_total += $order_item->total;
                $order_update->total_price += ($order_item->total + $order_update->shipping_price - $order_update->discount);
                $order_update->save();
                return redirect('order.index');
            }
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->order_status = 'cart';
        $order->sub_total = 0;
        $order->discount = 0;
        $order->shipping_price = 0;
        $order->total_price = 0;
        $order->shipping_address = '';
        $order->save();
        session(['order_id' => $order->id]);
        $key = $order->user_id;
        //adding items to cart ->creating new order item
        $order_item = new OrderItem();
        $order_item->order_id = $order->id;
        $order_item->product_id = $request->input('product_id');
        $product = product::find($order_item->product_id);
        $order_item->product_price = $product->price;
        $order_item->quantity = $request->input('quantity');
        $order_item->total = $order_item->quantity *  $order_item->product_price;
        $order_item->save();

        $order_update =  Order::whereUserId($key)->first();
        // return $order_update;
        $order_update->sub_total += $order_item->total;
        $order_update->total_price += ($order_item->total + $order_update->shipping_price - $order_update->discount);
        $order_update->save();
        return redirect('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = OrderItem::find($id);
        //return $item;
        $product->quantity = $request->input('quantity');
        $product->total = $product->quantity * $product->product_price;
        $product->save();
        $product->order->sub_total = ($product->order->sub_total - $product->product_price + $product->total);
        $product->order->total_price = ($product->order->total_price - $product->product_price + $product->total);
        $product->order->save();
        return redirect('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItem $id)
    {
        $item = OrderItem::find($id);

         $item->order->sub_total -=$item->total;
         $item->order->total_price -=$item->total; 
         $item->order->save();
         $item->delete();
         return redirect('order.index');
    }
}
