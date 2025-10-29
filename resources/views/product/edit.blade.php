@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">

    <h1 class="text-3xl font-bold text-pink-400 mb-6">Edit Product</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-300 mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2" required>
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Description</label>
            <textarea name="description" rows="3" class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Price ($)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2" required>
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Category</label>
            <select name="category_id" class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Stock Quantity</label>
            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="w-full rounded-lg bg-gray-800 border border-gray-700 text-gray-200 p-2">
        </div>

        <div>
            <label class="block text-gray-300 mb-2">Image</label>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 rounded-lg mb-2 object-cover">
            @endif
            <input type="file" name="image" class="w-full text-gray-200">
        </div>

        <div>
            <label class="flex items-center space-x-2 text-gray-300">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                <span>Active</span>
            </label>
        </div>

        <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg shadow">
            Update Product
        </button>
    </form>
</div>
@endsection
