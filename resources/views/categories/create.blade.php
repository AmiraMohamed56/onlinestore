@extends('layouts.app')

@section('main')
<div class="max-w-2xl mx-auto p-8 bg-gray-900/80 rounded-2xl border border-gray-800">
    <h2 class="text-2xl font-bold text-white mb-4">Create Category</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-700 text-white rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="text-gray-300 block mb-1">Name</label>
            <input name="name" value="{{ old('name') }}" required class="w-full p-2 bg-gray-800 border border-gray-700 rounded text-gray-200">
        </div>

        <div>
            <label class="text-gray-300 block mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full p-2 bg-gray-800 border border-gray-700 rounded text-gray-200">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="text-gray-300 block mb-1">Image (jpg, png, webp)</label>
            <input type="file" name="image" accept="image/*" class="w-full text-gray-200">
        </div>

        <div>
            <label class="inline-flex items-center text-gray-300">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                Active
            </label>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('categories.index') }}" class="text-gray-400">Cancel</a>
            <button class="bg-pink-600 text-white px-4 py-2 rounded">Create</button>
        </div>
    </form>
</div>
@endsection
