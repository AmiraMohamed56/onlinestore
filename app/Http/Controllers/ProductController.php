<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function index(Request $request)
    {
        // return "index works";
        $search = $request->input('search');
        $products = Product::when($search, function($query, $search){
            $query->where('name', 'like', "%{$search}%")
                   ->orWhere('category', 'like', "%{$search}%");
        })->paginate(8);
        return view('product.index', compact('products', 'search'));
    }

     function create()
    {
        // return "create works";
        return view('product.create');
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|max:2048',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        if($request->hasFile('image'))
        {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);

            // Save only the filename in DB
            $validated['image'] = $filename;
        }
        $product = Product::create($validated);

        return redirect()->route('products.show', $product->id);
    }

     function show($id)
    {
        // return "show works";
       $product = Product::findorFail($id);
       return view('product.show', compact('product'));
    }

    function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    function update(Request $request, Product $product)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category' => 'required|string|max:100',
        'image' => 'nullable|image|max:2048',
        'stock_quantity' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) 
        {
            // delete the old image
            if ($product->image && file_exists(public_path('images/' . $product->image))) 
                {
                unlink(public_path('images/' . $product->image));
            }

            // Save the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/'), $imageName);
            $validated['image'] = $imageName;
        }

        $product->update($validated);

        return redirect()->route('products.index');
    }

    function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image file if it exists
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
