@extends('layouts.app')

@section('main')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <img src="{{ asset('images/' . $perfume['image']) }}" 
             alt="{{ $perfume['name'] }}" 
             class="w-full h-80 object-contain bg-gray-100">

        <div class="p-6">
            <h2 class="text-3xl font-semibold text-gray-900 mb-2">{{ $perfume['name'] }}</h2>
            <p class="text-gray-500 text-sm mb-4">{{ ucfirst($perfume['category']) }} Collection</p>

            <div class="flex items-center justify-between mb-4">
                <span class="text-2xl font-bold text-blue-600">${{ $perfume['price'] }}</span>
                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                    #{{ $perfume['id'] }}
                </span>
            </div>

            <p class="text-gray-700 leading-relaxed">
                This is a premium {{ strtolower($perfume['category']) }} fragrance that blends elegant notes for a timeless scent.
            </p>

            <div class="mt-6 flex gap-3">
                <a href="{{ url('/products') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                    ← Back to products
                </a>
                <a href="#" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">
                    Buy Now
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
