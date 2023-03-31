<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    //Menambahkan Sebuah Produk
    public function create_product()
    {
        return view ('create_product');
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);

        return Redirect::route('index_product');
    }

    //Menampilkan Seluruh Produk
    public function index_product()
    {
        $products = Product::all();
        return view ('index_product', compact ('products'));
    }

    //Menampilkan Detail Produk
    public function detail_product(Product $product)
    {
        return view ('detail_product', compact ('product'));
    }

    //Mengubah Konten Produk
    public function edit_product(Product $product)
    {
        return view ('edit_product', compact ('product'));
    }

    public function update_product (Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);

        return Redirect::route('detail_product', $product);
    }

    //Delete Product
    public function delete_product(Product $product)
    {
        $product->delete();
        return Redirect::route('index_product');
    }
}
