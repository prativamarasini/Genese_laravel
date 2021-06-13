<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
Route::get('/', function () {
// $product1 = array(
    //     'product_name'=>'First Product ',
    //     'product_desc'=>'This is a good product. This is the product we wat to sell. This is a nice product.This is a good
    //     product.'
    // );
    // $product2 = array(
    //     'product_name'=>'Second Product',
    //     'product_desc'=>'This is a good product. This is the product we wat to sell. This is a nice product.This is a good
    //     product.'
    // );
    // $product3 = array(
    //     'product_name'=>'Third Product',
    //     'product_desc'=>'This is a good product. This is the product we wat to sell. This is a nice product.This is a good
    //     product.'
    // );

    // $products_list = array($product1 ,$product2 ,$product3);
    
});

Route::get('/create_product', function () {
    // creating product
// Product::create([
//     'product_name' => 'Laptop1',
//     'product_desc' => 'This is very nice laptop1',
//     'price' => '100000'
//     ]);

// creating product
// $product = new Product;
// $product->product_name = 'Pen';
// $product->product_desc = 'This is pen';
// $product->price = '10';
// $product->save();

// get product by id
// $product = Product::find(2);

// get all products
// $products = Product::all();

// get product by price
// $products = Product::wherePrice('1000')->get();
});

//web.php after laravel:breeze
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';