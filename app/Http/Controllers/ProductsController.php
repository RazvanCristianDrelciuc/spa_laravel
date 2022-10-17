<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function addTocart(Request $request, $id)
    {
        $product = Product::find($id);

        $product = ['product_id' => $id];
        $productIds = $request->session()->has('cart') ? array_column(session()->get('cart'), 'product_id') : [];
        if (!(in_array($id, $productIds))) {
            $request->session()->push('cart', $product);
        }

        return redirect()->route('index');
    }

    public function removeFromCart($id)
    {
        foreach(session('cart') as $key =>$val){
            if ($val['product_id'] == $id) {
                session()->pull('cart.' . $key);
            }
        }
        return redirect()->route('products');
    }

    public function deleteProduct($id){

        $productRemove=Product::find($id);
        $productRemove->delete();
        $cart=session()->get('cart');
        foreach(session('cart') as $key =>$val){
            if ($val['product_id'] == $id) {
                session()->pull('cart.' . $key);
            }
        }
        return redirect()->route('products');

    }

    public function updateProduct(Request $request, $id){

        $product=Product::find($id);
        return view('product', ['product' => $product]);
    }

    public function update(Request $request, $id){
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $product = Product::find($id);

        $product->title=$request->input('title');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->image=$request->input('image');
        $product->update();

        return redirect()->route('index');
    }

    public function create(Request $request, $id){
        $product= Product::find($id);
        return view('product', ['product' => $product]);

    }

    public function add(Request $request){
        return view('product');
    }

    public function addProduct(Request $request){

        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $data=$request->input();
        $product = new Product;
        $product->title=$data['title'];
        $product->description=$data['description'];
        $product->price=$data['price'];
        $product->image=$data['image'];
        $product->save();

        return redirect()->route('index');

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $product = Product::all();
        return view('product', [
            'products' => $products,
        ]);

    }


    public function edit(Product $proudct)
    {
        //
    }





    public function destroy(Product $proudct)
    {
        //
    }
}
