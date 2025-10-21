@extends('layouts.app')

@section('main')
<div class="max-w-xl mx-auto bg-white shadow-md rounded-xl p-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">
        Submitted Product Data
    </h2>

    <div class="space-y-4 text-gray-700">
        <p><strong>Name:</strong> {{ $data['name'] ?? '—' }}</p>
        <p><strong>Price:</strong> ${{ $data['price'] ?? '—' }}</p>
        <p><strong>Category:</strong> {{ $data['category'] ?? '—' }}</p>
        <p><strong>Image:</strong> {{ $data['image']->getClientOriginalName() ?? '—' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ url('/products/create') }}" 
           class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
            Add Another Product
        </a>
    </div>

    <div class="mt-6">
        <a href="{{ url('/products') }}" 
           class="inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500">
            View all Products
        </a>
    </div>
</div>
@endsection
