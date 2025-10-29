@extends('layouts.app')

@section('main')
<div class="max-w-2xl mx-auto p-8 bg-gray-900/80 rounded-2xl border border-gray-800">
    <h2 class="text-2xl font-bold text-white mb-4">Edit Category</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-700 text-white rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="text-gray-300 block mb-1">Name</label>
            <input name="name" value="{{ old('name', $category->name) }}" required class="w-full p-2 bg-gray-800 border border-gray-700 rounded text-gray-200">
        </div>

        <div>
            <label class="text-gray-300 block mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full p-2 bg-gray-800 border border-gray-700 rounded text-gray-200">{{ old('description', $category->description) }}</textarea>
        </div>

        <div>
            <label class="text-gray-300 block mb-1">Current Image</label>
            @if ($category->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image))
                <img src="{{ asset('storage/' . $category->image) }}" class="w-36 h-24 object-cover rounded mb-2">
            @else
                <div class="w-36 h-24 bg-gray-800 flex items-center justify-center text-gray-500 mb-2">No image</div>
            @endif
            <label class="text-gray-300 block mb-1">Replace Image</label>
            <input type="file" name="image" accept="image/*" class="w-full text-gray-200">
        </div>

        <div>
            <label class="inline-flex items-center text-gray-300">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="mr-2">
                Active
            </label>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('categories.index') }}" class="text-gray-400">Cancel</a>
            <button class="bg-pink-600 text-white px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>
@endsection
