@extends('layouts.app')

@section('main')
<div class="max-w-2xl mx-auto bg-gray-900/80 p-8 rounded-2xl border border-gray-800 shadow-lg">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">✏️ Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2 focus:ring-pink-500 focus:border-pink-500" required>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="3" 
                class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2 focus:ring-pink-500 focus:border-pink-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Price -->
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Price ($)</label>
            <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}"
                class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2 focus:ring-pink-500 focus:border-pink-500" required>
        </div>

        <!-- Category -->
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Category</label>
            <select name="category" 
                class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2 focus:ring-pink-500 focus:border-pink-500" required>
                <option value="men" {{ old('category', $product->category) == 'men' ? 'selected' : '' }}>Men</option>
                <option value="women" {{ old('category', $product->category) == 'women' ? 'selected' : '' }}>Women</option>
                <option value="unisex" {{ old('category', $product->category) == 'unisex' ? 'selected' : '' }}>Unisex</option>
            </select>
        </div>

        <!-- Stock Quantity -->
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Stock Quantity</label>
            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2 focus:ring-pink-500 focus:border-pink-500" required>
        </div>

        <!-- Image -->
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2">Product Image</label>
            
            @if ($product->image)
                <div class="mb-3">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="w-32 h-32 object-cover rounded-lg border border-gray-700">
                </div>
            @endif

            <input type="file" name="image" 
                class="block w-full text-sm text-gray-400 border border-gray-700 rounded-lg cursor-pointer bg-gray-800 focus:ring-pink-500 focus:border-pink-500">
            <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('products.index') }}" 
                class="text-gray-400 hover:text-gray-200 transition text-sm">← Back to Products</a>

            <button type="submit" 
                class="rounded-md bg-gradient-to-r from-pink-600 to-purple-600 px-5 py-2 text-white font-semibold shadow hover:opacity-90 transition">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection
