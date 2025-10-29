@extends('layouts.app')

@section('main')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Categories</h1>
            <p class="text-sm text-gray-400">Showing {{ $categories->count() }} of {{ $categories->total() }} categories</p>
        </div>

        <div class="flex gap-3">
            <form method="GET" action="{{ route('categories.index') }}" class="relative">
                <input name="search" value="{{ request('search') }}" placeholder="Search categories..." 
                       class="rounded-lg bg-gray-800 border border-gray-700 text-gray-200 px-3 py-2 w-64">
            </form>

            <a href="{{ route('categories.create') }}" class="inline-flex items-center bg-gradient-to-r from-pink-600 to-purple-600 text-white px-4 py-2 rounded-lg shadow">
                + Add Category
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-600 text-white">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <div class="bg-gray-900/70 border border-gray-800 rounded-xl p-4 shadow">
                <div class="h-40 bg-gray-800 rounded overflow-hidden mb-3">
                    @if($category->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image))
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500">No image</div>
                    @endif
                </div>

                <h3 class="text-white font-semibold">{{ $category->name }}</h3>
                <p class="text-gray-400 text-sm line-clamp-2">{{ $category->description }}</p>
                <p class="text-gray-300 text-xs mt-2">Products: {{ $category->products_count }}</p>

                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('categories.show', $category) }}" class="text-pink-400 hover:underline">View</a>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('categories.edit', $category) }}" class="text-blue-400">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $categories->withQueryString()->links() }}
    </div>
</div>
@endsection
