@extends('admin.layouts.admin')

@section('title', 'Список рецептов')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full">
            <h1 class="text-3xl font-bold mb-6">Список рецептов</h1>
            <a href="{{ route('recipes.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">Добавить рецепт</a>
            <ul class="space-y-4">
                @foreach($recipes as $recipe)
                    <li class="border rounded-lg p-4 hover:bg-gray-100 transition">
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-lg font-medium text-blue-600 hover:underline">{{ $recipe->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
