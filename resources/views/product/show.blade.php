@extends('layouts.app')

@section('main')
<div class="max-w-3xl mx-auto py-12">
    <div class="bg-gray-900/80 backdrop-blur-md border border-gray-800 rounded-2xl shadow-2xl overflow-hidden transition hover:border-pink-600">
        <!-- Image -->
        <img 
            src="{{ asset('images/' . $product->image) }}" 
            alt="{{ $product->name }}" 
            class="w-full h-96 object-contain bg-gradient-to-b from-gray-800 to-gray-900 p-6"
            onerror="this.onerror=null;this.src='https://via.placeholder.com/600x450?text=Perfume';"
        >

        <!-- Details -->
        <div class="p-8">
            <h2 class="text-4xl font-bold text-white mb-3">{{ $product->name }}</h2>
            <p class="text-pink-400 text-sm mb-6 uppercase tracking-wide">
                {{ ucfirst($product->category) }} Collection
            </p>

            <div class="flex items-center justify-between mb-6">
                <span class="text-3xl font-extrabold text-pink-500">
                    ${{ $product->price }}
                </span>
                <span class="px-3 py-1 text-xs font-semibold bg-gray-800 text-gray-300 rounded-full shadow-inner">
                    #{{ $product->id }}
                </span>
            </div>

            <p class="text-gray-300 leading-relaxed">
                Immerse yourself in the allure of {{ strtolower($product->category) }} elegance. 
                This fragrance harmonizes subtle floral, woody, and musk notes — designed to leave a lasting impression.
            </p>

            <div class="flex items-center justify-between mb-6">
                <span class="px-3 py-1 text-xs font-semibold bg-gray-800 text-gray-300 rounded-full shadow-inner">
                    In Stock: {{ $product->stock_quantity }}
                </span>
            </div>

            <div class="mt-8 flex gap-4">
                <!-- Back Button -->
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center gap-1 px-5 py-2.5 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" 
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Products
                </a>

                <a href="{{ route('products.edit', $product->id) }}" 
                    class="inline-flex items-center justify-center gap-1 px-5 py-2.5 rounded-md bg-gradient-to-r from-pink-600 to-purple-600 text-white font-semibold shadow-md hover:opacity-90 transition">
                        Edit Product
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                </a>

            </div>

            <div class="mt-8 flex gap-4">
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-1 px-5 py-2.5 rounded-md bg-gradient-to-r from-red-600 to-pink-700 text-white font-semibold shadow-md hover:opacity-90 transition">
                        Delete Product
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
