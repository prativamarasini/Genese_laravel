<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     $posts= Post::all();
//     return view('index' ,['posts' => $posts ]);
// });
Route::get('/post/{post}', function (Post $post) {
    return view('post' ,['post' => $post ]);
});

Route::get('/',[PostController::class,'index'])->name('index');
//Admin controller
Route::get('/create',[App\Http\Controllers\Admin\PostsController::class,'create']);
Route::post('/create/store',[App\Http\Controllers\Admin\PostsController::class,'store']);