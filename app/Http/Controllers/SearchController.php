<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(){
        // return request(['search' , 'category']);
        $category = Category::all();
          $products = Product::latest()->search(request(['search' , 'category']))->get();
          return view('products'  ,['categories'=>$category , 'products'=> $products]);
    }
}
