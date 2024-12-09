@extends('admin.layouts.admin')

@section('title', 'Список категорий')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full">
            <h1 class="text-3xl font-bold mb-6">Список категорий</h1>

            <!-- Форма поиска и фильтрации -->
            <form method="GET" action="{{ route('categories.index') }}" class="mb-6 flex items-center space-x-4">
                <input
                    type="text"
                    name="search"
                    placeholder="Поиск по названию"
                    value="{{ request('search') }}"
                    class="border border-gray-300 px-4 py-2 rounded w-1/3"
                >
                <select
                    name="sort"
                    class="border border-gray-300 px-4 py-2 rounded"
                >
                    <option value="">Сортировать по</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Названию (А-Я)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Названию (Я-А)</option>
                    <option value="recipes_asc" {{ request('sort') == 'recipes_asc' ? 'selected' : '' }}>Кол-ву рецептов (возр.)</option>
                    <option value="recipes_desc" {{ request('sort') == 'recipes_desc' ? 'selected' : '' }}>Кол-ву рецептов (убыв.)</option>
                </select>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Применить
                </button>
                <a
                    href="{{ route('categories.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400"
                >
                    Сбросить
                </a>
            </form>

            <a href="{{ route('categories.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">Добавить категорию</a>

            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Название категории</th>
                    <th class="border border-gray-300 px-4 py-2">Количество рецептов</th>
                    <th class="border border-gray-300 px-4 py-2">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:underline">{{ $category->name }}</a>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $category->recipes_count }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:underline">Редактировать</a> |
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Вы уверены, что хотите удалить категорию?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border border-gray-300 px-4 py-2 text-center">Категории не найдены</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Пагинация -->
            <div class="mt-6">
                {{ $categories->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
