@extends('layouts.app')

@section('main')
<div class="max-w-5xl mx-auto py-8 px-4">
    <div class="bg-gray-900/80 p-6 rounded-2xl border border-gray-800">
        <div class="flex items-start gap-6">
            <div class="w-64 flex-shrink-0">
                @if ($category->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image))
                    <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-48 object-cover rounded-lg">
                @else
                    <div class="w-full h-48 bg-gray-800 flex items-center justify-center text-gray-500">No image</div>
                @endif
            </div>

            <div class="flex-1">
                <h1 class="text-2xl font-bold text-white">{{ $category->name }}</h1>
                <p class="text-gray-300 mt-2">{{ $category->description }}</p>

                <div class="mt-4 flex items-center gap-3">
                    <a href="{{ route('categories.edit', $category) }}" class="bg-blue-500 text-white px-3 py-2 rounded">Edit</a>
                    <a href="{{ route('products.index') }}?category={{ $category->id }}" class="bg-pink-600 text-white px-3 py-2 rounded">View Products</a>
                </div>

                <p class="text-gray-400 mt-3">Products: {{ $category->products->count() }}</p>
            </div>
        </div>

        {{-- Products (if loaded) --}}
        @if ($category->relationLoaded('products') && $category->products->isNotEmpty())
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($category->products as $product)
                    <div class="bg-gray-800 p-4 rounded-lg">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300' }}" class="w-full h-40 object-cover rounded mb-3">
                        <h4 class="text-white font-semibold">{{ $product->name }}</h4>
                        <p class="text-pink-400 font-bold">${{ number_format($product->price,2) }}</p>
                        <a href="{{ route('products.show', $product) }}" class="text-sm text-blue-400">View</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
