@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-pink-400">Products</h1>

        <a href="{{ route('products.create') }}"
           class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow">
           + Add Product
        </a>
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="mb-4 flex items-center space-x-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or category"
               class="flex-1 p-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 focus:ring-pink-500 focus:border-pink-500">
        <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">Search</button>
    </form>

    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <p class="text-gray-400">No products found.</p>
    @else
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow p-4">
            <!-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg mb-3 w-full h-48 object-cover"> -->
             <img src="{{ Storage::url($product->image)}}" alt="{{ $product->name }}" class="rounded-lg mb-3 w-full h-48 object-cover">
            <h3 class="text-lg font-semibold text-white mb-1">{{ $product->name }}</h3>
            <p class="text-gray-400 text-sm mb-1">{{ $product->category ? $product->category->name : 'Uncategorized' }}</p>
            <p class="text-pink-400 font-bold mb-2">${{ number_format($product->price, 2) }}</p>

            <div class="flex justify-between">
                <a href="{{ route('products.edit', $product) }}" class="text-blue-400 hover:underline">Edit</a>
                <a href="{{ route('products.show', $product) }}" class="text-blue-400 hover:underline">View</a>
                <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:underline">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
