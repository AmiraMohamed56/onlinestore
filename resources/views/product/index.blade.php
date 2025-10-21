@extends('layouts.app')

@section('main')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Perfume Collection</h2>
        <p class="text-sm text-gray-600">Showing {{ count($perfumes ?? []) }} perfumes</p>
    </div>

    <div class="flex items-center gap-3">
        <div class="relative w-full max-w-xs">
            <input 
                type="text" 
                id="search-input"
                placeholder="Search by name..." 
                class="w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" 
                oninput="filterAndSortProducts()"
            >
            <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" 
                viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg>
        </div>

        <a href="{{ url('/products/create') }}" 
            class="inline-flex items-center justify-center w-40 rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
            Add Product
        </a>
    </div>
</div>

<!-- Filter + Sort -->
<div class="flex flex-wrap gap-4 mb-6 items-center">
    <div>
        <label for="category-filter" class="text-sm font-medium text-gray-700">Category:</label>
        <select id="category-filter" onchange="filterAndSortProducts()" class="ml-2 border border-gray-300 rounded-md text-sm px-2 py-1">
            <option value="all">All</option>
            <option value="men">Men</option>
            <option value="women">Women</option>
            <option value="unisex">Unisex</option>
        </select>
    </div>

    <div>
        <label for="price-sort" class="text-sm font-medium text-gray-700">Sort by:</label>
        <select id="price-sort" onchange="filterAndSortProducts()" class="ml-2 border border-gray-300 rounded-md text-sm px-2 py-1">
            <option value="none">Default</option>
            <option value="low">Price: Low → High</option>
            <option value="high">Price: High → Low</option>
        </select>
    </div>
</div>

{{-- Product Grid --}}
<div id="students-grid" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @foreach(($perfumes ?? []) as $perfume)
        <div 
            class="group overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md" 
            data-name="{{ strtolower($perfume['name']) }}"
            data-category="{{ strtolower($perfume['category']) }}"
            data-price="{{ $perfume['price'] }}"
        >
            <div class="relative aspect-[4/3] bg-gray-100">
                <img
                    src="{{ asset('images/' . $perfume['image']) }}"
                    alt="{{ $perfume['name'] }}"
                    loading="lazy"
                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/600x450?text=Perfume';"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3 flex items-end justify-between">
                    <h3 class="text-lg font-semibold text-white">{{ $perfume['name'] }}</h3>
                    <span class="rounded-full bg-white/90 px-2 py-0.5 text-xs font-medium text-gray-800 shadow">
                        {{ ucfirst($perfume['category']) }}
                    </span>
                </div>
            </div>

            <div class="p-4 flex flex-col gap-2">
                <p class="text-base font-medium text-gray-800">${{ number_format($perfume['price'], 2) }}</p>
                <div class="flex items-center justify-between mt-auto">
                    <a href="{{ url('/products/' . $perfume['id']) }}" 
                        class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-500">
                        View details
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" 
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                    <span class="text-xs text-gray-500">#{{ $perfume['id'] }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
