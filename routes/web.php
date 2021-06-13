<?php

use App\Http\Controllers\ProductsController;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
   $products = Product::latest()->get();
    return view('home',['products' => $products]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Route::get('/laravel', function () {
//     $products = Product::all();
//     return view('products', ['products' => $products]);
// });

// Route::get('/product', function () {
Route::get('/products/{product}', function (Product $product) {
    // $product = Product::find($id);
    return view('product', ['product' => $product]);
});

// Route::get('/home', function () {s
//     $products = Product::latest()->get();
//     return view('home', ['products' => $products]);
// });

Route::get('/home',[ProductsController::class,'index']);
Route::get('/checkout' , [ProductsController::class , 'checkout']);
Route::get('/shop-grid' , [ProductsController::class , 'shop']);
Route::get('/contact' , [ProductsController::class , 'contact']);
Route::get('products/search', [ProductsController::class,'search'])->name('products.search');
Route::resource('products', ProductsController::class)->only(['index', 'show']);


Route::get('/categories/{category}',function(Category $category){
    // $products=Product::wherecategoryId($category->id)->get();
    $products= $category->products;
    $categories= Category::all();
     // return $products;
    return view('category', ['products' => $products, 'category'=> $category,'categories'=>$categories]);

});

Route::get('/create_product', function () {
    Product::create([
        'product_name' => 'summer wear',
        'product_desc' => 'Lorem ipsum dolor sit amet ',
        'price' => '1000',
        'image' => '',
        'category_id'=>'1'
    ]);
});

Route::get('/get_product', function () {
    $products = Product::get();
    return $products;
});

Route::get('/create_post', function () {
    Post::create([
        'title' => 'summer wear',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium tempore, vel laboriosam quos enim itaque nihil maiores cum nam doloribus quaerat praesentium voluptatum recusandae deleniti ab rem quas molestiae eum?'
    ]);
});

Route::get('/get_post', function () {
    $posts = Post::get();
    return $posts;
});

//admin routing
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');
// Route::get('products',[App\Http\Controllers\Admin\ProductsController::class,'index'])->name('products_list');
// Route::get('products/create',[App\Http\Controllers\Admin\ProductsController::class,'create'])->name('create_product');
// Route::post('products/store',[App\Http\Controllers\Admin\ProductsController::class,'store']);
Route::resource('categories', App\Http\Controllers\Admin\CategoriesController::class);
Route::resource('products', App\Http\Controllers\Admin\ProductsController::class);



});

//search................
Route::get('/search' , [App\Http\Controllers\SearchController::class , 'search'])->name('search');
//cart.............
Route::post('/cart/store' , [App\Http\Controllers\OrderItemsController::class , 'store'])->middleware('auth');
Route::put('/cart/update/{id}' , [App\Http\Controllers\OrderItemsController::class , 'update']);
Route::delete('/cart/destroy/{id}' , [App\Http\Controllers\OrderItemsController::class , 'destroy']);



Route::get('/order' ,[App\Http\Controllers\OrderController::class , 'index']);


