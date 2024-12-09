@extends('admin.layouts.admin')

@section('title', 'Редактировать категорию')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full max-w-md mx-auto">
            <h1 class="text-3xl font-bold mb-6">Редактировать категорию</h1>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Название категории</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full border rounded-lg p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Обновить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
