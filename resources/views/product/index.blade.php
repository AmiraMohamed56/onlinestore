@extends('layouts.app')

@section('main')
<div class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-2xl font-bold text-white">✨ Product Collection</h2>
        <p class="text-sm text-gray-400">Showing {{ $products->count() }} of {{ $products->total() }} products</p>
    </div>

    <div class="flex items-center gap-3">
        <!-- Search Form -->
        <form method="GET" action="{{ route('products.index') }}" class="relative w-full max-w-xs">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search by name or category..." 
                class="w-full rounded-lg bg-gray-800/70 border border-gray-700 py-2 pl-3 pr-10 text-sm text-gray-200 placeholder-gray-400 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition"
            >
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-400">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
            </button>
        </form>

        <!-- Add Product Button -->
        <a href="{{ route('products.create') }}" 
            class="inline-flex items-center justify-center w-40 rounded-md bg-gradient-to-r from-pink-600 to-purple-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pink-600 transition">
            + Add Product
        </a>
    </div>
</div>

{{-- Product Grid --}}
@if ($products->isEmpty())
    <div class="text-center py-20 text-gray-400">
        <p class="text-lg">No products found 😔</p>
    </div>
@else
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($products as $product)
            <div 
                class="group overflow-hidden rounded-2xl border border-gray-800 bg-gray-900/80 backdrop-blur-sm shadow-lg transition hover:scale-[1.02] hover:border-pink-600 hover:shadow-pink-700/30"
            >
                <!-- Image -->
                <div class="relative aspect-[4/3]">
                    <img 
                        src="{{ asset('images/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/600x450?text=Perfume';"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-3 right-3 flex items-end justify-between">
                        <h3 class="text-lg font-semibold text-white">{{ $product->name }}</h3>
                        <span class="rounded-full bg-pink-600/80 px-2 py-0.5 text-xs font-medium text-white shadow">
                            {{ ucfirst($product->category) }}
                        </span>
                    </div>
                </div>

                <!-- Details -->
                <div class="p-4 flex flex-col gap-2">
                    <p class="text-base font-semibold text-pink-400">${{ number_format($product->price, 2) }}</p>
                    <div class="flex items-center justify-between mt-auto">
                        <a href="{{ route('products.show', $product->id) }}" 
                            class="inline-flex items-center gap-1 text-sm font-medium text-purple-400 hover:text-pink-400 transition">
                            View details
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" 
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                        <span class="text-xs text-gray-500">#{{ $product->id }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $products->links('pagination::tailwind') }}
    </div>
@endif
@endsection
