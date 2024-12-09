@extends('admin.layouts.admin')

@section('title', 'Список рецептов')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full">
            <h1 class="text-3xl font-bold mb-6">Список рецептов</h1>

            <!-- Форма поиска и фильтрации -->
            <form method="GET" action="{{ route('recipes.index') }}" class="mb-6 flex items-center space-x-4">
                <input
                    type="text"
                    name="search"
                    placeholder="Поиск по названию"
                    value="{{ request('search') }}"
                    class="border border-gray-300 px-4 py-2 rounded w-1/3"
                >
                <select
                    name="category"
                    class="border border-gray-300 px-4 py-2 rounded"
                >
                    <option value="">Все категории</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <select
                    name="sort"
                    class="border border-gray-300 px-4 py-2 rounded"
                >
                    <option value="">Сортировать по</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Названию (А-Я)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Названию (Я-А)</option>
                    <option value="ingredients_asc" {{ request('sort') == 'ingredients_asc' ? 'selected' : '' }}>Ингредиентам (возр.)</option>
                    <option value="ingredients_desc" {{ request('sort') == 'ingredients_desc' ? 'selected' : '' }}>Ингредиентам (убыв.)</option>
                    <option value="steps_asc" {{ request('sort') == 'steps_asc' ? 'selected' : '' }}>Шагам (возр.)</option>
                    <option value="steps_desc" {{ request('sort') == 'steps_desc' ? 'selected' : '' }}>Шагам (убыв.)</option>
                </select>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Применить
                </button>
                <a
                    href="{{ route('recipes.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400"
                >
                    Сбросить
                </a>
            </form>

            <a href="{{ route('recipes.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">Добавить рецепт</a>

            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Название</th>
                    <th class="border border-gray-300 px-4 py-2">Категория</th>
                    <th class="border border-gray-300 px-4 py-2">Ингредиенты</th>
                    <th class="border border-gray-300 px-4 py-2">Шаги</th>
                    <th class="border border-gray-300 px-4 py-2">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($recipes as $recipe)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-blue-600 hover:underline">{{ $recipe->name }}</a>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $recipe->category->name ?? 'Без категории' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $recipe->ingredients_count }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $recipe->steps_count }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-blue-500 hover:underline">Редактировать</a> |
                            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Вы уверены?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">Рецепты не найдены</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Пагинация -->
            <div class="mt-6">
                {{ $recipes->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
