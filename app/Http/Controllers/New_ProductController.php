<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\New_Product;

class New_ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store1(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer',
            'unit_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ]);

        $product = new New_Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category = $request->category;
        $product->stock = $request->stock;
        $product->unit_price = $request->unit_price;
        $product->sale_price = $request->sale_price;
        $product->save();

        return response()->json(['success' => true]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer',
            'unit_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ]);
       echo "<pre>"; print($request->code); die();

        $product = new New_Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category = $request->category;
        $product->stock = $request->stock;
        $product->unit_price = $request->unit_price;
        $product->sale_price = $request->sale_price;
        $product->save();

        return response()->json(['success' => true]);
    }
}
