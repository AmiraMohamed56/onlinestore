@extends('layouts.app')

@section('main')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">
        Add New Product
    </h2>

    <form action="{{ url('/newproducts') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Product Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Product Name
            </label>
            <input type="text" name="name" id="name" 
                class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                placeholder="Enter perfume name" required>
        </div>

        {{-- Price --}}
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                Price ($)
            </label>
            <input type="number" name="price" id="price" step="0.01" min="0"
                class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                placeholder="Enter price" required>
        </div>

        {{-- Category --}}
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                Category
            </label>
            <select name="category" id="category"
                class="w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
                <option value="" disabled selected>Select category</option>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
                <option value="Unisex">Unisex</option>
            </select>
        </div>

        {{-- Image --}}
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                Product Image
            </label>
            <input type="file" name="image" id="image" accept="image/*"
                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500">
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center justify-center rounded-md bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </button>
        </div>
    </form>
</div>
@endsection