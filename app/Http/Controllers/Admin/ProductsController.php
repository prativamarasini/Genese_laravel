<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;




class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::latest()->get();
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
     return view('admin.products.create',compact('categories'));
    //  return view('admin.products.create',['categories'=>$categories]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'product_name' => 'required|max:255|unique:products',
            'product_desc' => 'required',
            'price' => 'required',
            'category_id' => 'required|integer|min:1',
        ],
        [
            'required' => ':attribute is required',
            'product_name.required' => 'Product Name is required. Please input it.'
        ]
        );

        $product=new Product;
        $product->product_name=$request->input('product_name');
        $product->product_desc=$request->input('product_desc');
        $product->price=$request->input('price');
        $product->category_id=$request->input('category_id');
        if ($request->hasFile('image_upload')) {
             $name = $request->file('image_upload')->getClientOriginalName();
             $request->file('image_upload')->storeAs('public/images', $name);
            //  croping the image and saving it to thumbnail folder inside images folder
            // $image_resize =Image::make(storage_path('app/public/images/'.$name));
            // $image_resize->resize(550, 750);
            // $image_resize->save(storage_path('app/public/images/thumbnail/'.$name));
            image_crop($name, 550, 750);
             $product->image=$name;

        }
        //  return $product;
        if($product->save()){
            return redirect()->route('products_list');
        }else{
            return redirect()->back();

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // using authorize helper function to check user authorization
        //  $this->authorize('update', $product);
         // return $request;
         $validated = $request->validate([
             'product_name' => 'required|max:255',
             'product_desc' => 'required',
             'price' => 'required',
             'category_id' => 'required|integer|min:1',
         ],
         [
             'required' => ':attribute is required',
             'product_name.required' => 'Product Name is required. Please input it.'
         ]
         );
         $product = new Product;
         $product->product_name = $request->input('product_name');
         $product->product_desc = $request->input('product_desc');
         $product->price = $request->input('price');
         $product->category_id = $request->input('category_id');
         if ($request->hasFile('image_upload')) {
             // uploading image to images folder
             $name = $request->file('image_upload')->getClientOriginalName();
             $request->file('image_upload')->storeAs('public/images', $name);
             // croping the image and saving it to thumbnail folder inside images folder
             // $image_resize = Image::make(storage_path('app/public/images/'.$name));
             // $image_resize->resize(550, 750);
             // $image_resize->save(storage_path('app/public/images/thumbnail/'.$name));
             image_crop($name, 550, 750);
             $product->image = $name;
         }
         // return $product;
         if($product->save()){
             return redirect()->route('admin.products.index');
         }else {
             return redirect()->back();
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete($id);
        return redirect('admin.products.index');
    }
}
