<nav class="bg-gray-100 border-b border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-800">
                Recipe Book
            </a>
            <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 lg:hidden"
                    aria-controls="navbarNav" aria-expanded="false">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
            <div class="hidden lg:flex lg:items-center lg:space-x-4" id="navbarNav">
                <a href="{{ route('recipes.index') }}" class="text-gray-800 hover:text-gray-600 transition">Рецепты</a>
                <a href="{{ route('ingredients.index') }}" class="text-gray-800 hover:text-gray-600 transition">Ингредиенты</a>
                <a href="{{ route('categories.index') }}"
                   class="text-gray-800 hover:text-gray-600 transition">Категории</a>
                <a class="text-gray-800 hover:text-gray-600 transition" href="http://localhost:100/logout" onclick="event.preventDefault();
                                                this.closest('form').submit();">Выйти</a>
            </div>
        </div>
        <div class="lg:hidden">
            <div class="flex flex-col space-y-2 pt-2" id="navbarNav">
                <a href="{{ route('recipes.index') }}" class="text-gray-800 hover:text-gray-600 transition">Рецепты</a>
                <a href="{{ route('ingredients.index') }}" class="text-gray-800 hover:text-gray-600 transition">Ингредиенты</a>
                <a href="{{ route('categories.index') }}"
                   class="text-gray-800 hover:text-gray-600 transition">Категории</a>
                <a class="text-gray-800 hover:text-gray-600 transition" href="http://localhost:100/logout" onclick="event.preventDefault();
                                                this.closest('form').submit();">Log Out</a>
            </div>
        </div>
    </div>
</nav>
