<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository
{
    /**
     * Поиск и фильтрация данных категорий
     */
    public function searchAndSort(Request $request)
    {
        $query = Category::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($sort = $request->input('sort')) {
            if ($sort == 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort == 'name_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($sort == 'recipes_asc') {
                $query->withCount('recipes')->orderBy('recipes_count', 'asc');
            } elseif ($sort == 'recipes_desc') {
                $query->withCount('recipes')->orderBy('recipes_count', 'desc');
            }
        } else {
            $query->orderBy('name', 'asc');
        }

        return $query->withCount('recipes')->paginate(10);
    }
}
