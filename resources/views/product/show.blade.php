@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">

    <h1 class="text-3xl font-bold text-pink-400 mb-6">{{ $product->name }}</h1>

    <div class="bg-gray-800 border border-gray-700 rounded-xl shadow p-6">
        @if ($product->image)
            <img src="{{ Storage::url($product->image)}}" 
                 alt="{{ $product->name }}" 
                 class="rounded-lg mb-4 w-full max-h-96 object-cover">
        @endif

        <p class="text-gray-300 mb-2"><strong>Description:</strong> {{ $product->description }}</p>
        <p class="text-gray-300 mb-2"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p class="text-gray-300 mb-2">
            <strong>Category:</strong> 
            {{ $product->category ? $product->category->name : 'Uncategorized' }}
        </p>
        <p class="text-gray-300 mb-2"><strong>Stock:</strong> {{ $product->stock_quantity }}</p>
        <p class="text-gray-300 mb-2">
            <strong>Status:</strong> 
            <span class="{{ $product->is_active ? 'text-green-400' : 'text-red-400' }}">
                {{ $product->is_active ? 'Active' : 'Inactive' }}
            </span>
        </p>

        <div class="mt-6 flex space-x-3">
            <a href="{{ route('products.edit', $product) }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
                Edit
            </a>

            <form action="{{ route('products.destroy', $product) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this product?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">
                    Delete
                </button>
            </form>

            <a href="{{ route('products.index') }}" 
               class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                Back
            </a>
        </div>
    </div>

</div>
@endsection
