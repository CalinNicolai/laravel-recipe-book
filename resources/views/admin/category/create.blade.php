@extends('admin.layouts.admin')

@section('title', 'Добавить категорию')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full max-w-md mx-auto">
            <h1 class="text-3xl font-bold mb-6">Добавить категорию</h1>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Название категории</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border rounded-lg p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Изображение</label>
                    <input type="file" name="image" id="image" value="{{ old('image') }}" class="mt-1 block w-full border rounded-lg p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
