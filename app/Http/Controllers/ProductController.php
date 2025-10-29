<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function index(Request $request)
    {
        // return "index works";
        // $products = Product::when($search, function($query, $search){
        //     $query->where('name', 'like', "%{$search}%")
        //            ->orWhere('category', 'like', "%{$search}%");
        // })->paginate(8);

        $search = $request->input('search');
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                });
            })->paginate(9);
        
        return view('product.index', compact('products', 'search'));
    }

   public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:100',
            'description'     => 'required|string|max:500',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'required|exists:categories,id',
            'stock_quantity'  => 'nullable|integer|min:0',
            'is_active'       => 'boolean',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'));
        }

        $product = Product::create($validated);

        return redirect()->route('products.show', $product->id);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:100',
            'description'     => 'required|string|max:500',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'required|exists:categories,id',
            'stock_quantity'  => 'nullable|integer|min:0',
            'is_active'       => 'boolean',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image from storage
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Upload new image
            $validated['image'] = $this->uploadImage($request->file('image'));
        }

        $product->update($validated);

        return redirect()->route('products.show', $product->id);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }


    private function uploadImage($imageObject)
    {
        $image_name = now()->format('Ymd_His') . '.' . $imageObject->getClientOriginalExtension();
        $imageObject->storeAs('products', $image_name, 'public');
        return "products/{$image_name}";
    }
}
