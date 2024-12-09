@extends('admin.layouts.admin')

@section('title', 'Добавить рецепт')

@section('content')
    <div class="container mx-auto py-8">
        <div class="w-full max-w-md mx-auto">
            <h1 class="text-3xl font-bold mb-6">Добавить рецепт</h1>
            <form action="{{ route('recipes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Название рецепта</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border rounded-lg p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border rounded-lg p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Категория</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border rounded-lg p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Без категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="ingredients" class="block text-sm font-medium text-gray-700">Ингредиенты</label>
                    <div id="ingredient-list">
                        <div class="flex space-x-2 mb-2">
                            <select name="ingredients[0][id]" class="border rounded-lg p-2 w-full">
                                <option value="">Выберите ингредиент</option>
                                @foreach($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="ingredients[0][quantity]" placeholder="Количество" class="border rounded-lg p-2 w-full">
                            <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-ingredient">-</button>
                        </div>
                    </div>
                    <button type="button" id="add-ingredient" class="bg-green-500 text-white px-4 py-2 rounded">Добавить ингредиент</button>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function attachRemoveHandler(button) {
            button.addEventListener('click', (e) => {
                e.target.closest('div').remove();
            });
        }

        document.getElementById('add-ingredient').addEventListener('click', () => {
            const list = document.getElementById('ingredient-list');
            const index = list.children.length;
            const div = document.createElement('div');
            div.className = 'flex space-x-2 mb-2';
            div.innerHTML = `
                <select name="ingredients[${index}][id]" class="border rounded-lg p-2 w-full">
                    <option value="">Выберите ингредиент</option>
                    @foreach($ingredients as $ingredient)
            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
            </select>
            <input type="text" name="ingredients[${index}][quantity]" placeholder="Количество" class="border rounded-lg p-2 w-full">
                <button type="button" class="bg-red-500 text-white px-2 py-1 rounded remove-ingredient">-</button>
            `;
            list.appendChild(div);
            attachRemoveHandler(div.querySelector('.remove-ingredient'));
        });

        document.querySelectorAll('.remove-ingredient').forEach(attachRemoveHandler);
    </script>
@endsection
