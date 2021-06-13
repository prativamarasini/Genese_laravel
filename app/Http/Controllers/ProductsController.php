<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
         return view('home', ['products' => $products]);
    }

    public function show(Product $product){
        return view('product', compact('product') );
    }
    public function search(){
        return 'this is a search';
    }
    public function checkout(){
        $categories = Category::all();
        $order_id = session('order_id',0);
        $order = Order::find($order_id);
        $orderitem = OrderItem::whereOrderId($order_id)->get();
        return view('checkout',[ 'categories'=>$categories , 'orderitem'=>$orderitem,'order'=>$order]);
    }
    public function shop(){
        $products = product::latest()->get();
        $categories = Category::all();
        $order_id = session('order_id',0);
        $order = Order::find($order_id);
        $orderitem = OrderItem::whereOrderId($order_id)->get();
         return view('shop-grid', [ 'categories'=> $categories ,'orderitem'=>$orderitem,'order'=>$order, 'products' => $products]);
    }
    public function contact(){
        $products = product::latest()->get();
        $categories = Category::all();
        return view('contact', [ 'categories'=> $categories , 'products' => $products]);
}
}