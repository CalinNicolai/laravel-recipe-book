@extends('admin.layouts.admin')

@section('title', 'Список категорий')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full">
            <h1 class="text-3xl font-bold mb-6">Список категорий</h1>
            <a href="{{ route('categories.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">Добавить категорию</a>
            <ul class="space-y-4">
                @foreach($categories as $category)
                    <li class="border rounded-lg p-4 hover:bg-gray-100 transition">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-lg font-medium text-blue-600 hover:underline">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
