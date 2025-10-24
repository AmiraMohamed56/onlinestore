@extends('layouts.app')

@section('main')
<div class="max-w-2xl mx-auto mt-10 bg-gray-900/80 p-8 rounded-2xl shadow-lg border border-gray-800">
    <h2 class="text-2xl font-bold text-white mb-6">➕ Add New Product</h2>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-500/20 border border-red-500 p-3 text-red-300 text-sm">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="list-disc pl-5 mt-2 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-200 py-2 px-3 focus:ring-1 focus:ring-pink-500 focus:border-pink-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="3" required
                class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-200 py-2 px-3 focus:ring-1 focus:ring-pink-500 focus:border-pink-500">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Price ($)</label>
                <input type="number" name="price" step="0.01" value="{{ old('price') }}" required
                    class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-200 py-2 px-3 focus:ring-1 focus:ring-pink-500 focus:border-pink-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                <select name="category" required
                    class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-200 py-2 px-3 focus:ring-1 focus:ring-pink-500 focus:border-pink-500">
                    <option value="men">Men</option>
                    <option value="women">Women</option>
                    <option value="unisex">Unisex</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Stock quantity</label>
            <input type="number" name="stock_quantity" step="0.01" value="{{ old('stock_quantity') }}" required
                class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-200 py-2 px-3 focus:ring-1 focus:ring-pink-500 focus:border-pink-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Product Image</label>
            <input type="file" name="image" accept="image/*"
                class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 
                       file:rounded-md file:border-0 file:text-sm 
                       file:font-semibold file:bg-pink-600 file:text-white hover:file:bg-pink-700">
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('products.index') }}"
                class="px-4 py-2 text-sm rounded-md bg-gray-700 text-gray-200 hover:bg-gray-600 transition">Cancel</a>
            <button type="submit"
                class="px-5 py-2 rounded-md bg-gradient-to-r from-pink-600 to-purple-600 text-white font-medium shadow-md hover:opacity-90 transition">
                Save Product
            </button>
        </div>
    </form>
</div>
@endsection
