@extends('admin.layouts.admin')

@section('title', 'Список ингредиентов')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full">
            <h1 class="text-3xl font-bold mb-6">Список ингредиентов</h1>
            <a href="{{ route('ingredients.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">Добавить ингредиент</a>
            <ul class="space-y-4">
                @foreach($ingredients as $ingredient)
                    <li class="border rounded-lg p-4 hover:bg-gray-100 transition">
                        <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="text-lg font-medium text-blue-600 hover:underline">{{ $ingredient->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
