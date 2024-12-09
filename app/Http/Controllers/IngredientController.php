<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use App\Repositories\IngredientRepository;
use App\Models\Category;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    protected $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ingredients = $this->ingredientRepository->searchAndSort($request);

        return view('admin.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.ingredients.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IngredientRequest $request)
    {
        $validated = $request->validated();

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')->with('success', 'Ингредиент успешно добавлен!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        $categories = Category::all();
        return view('admin.ingredients.edit', compact('ingredient', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IngredientRequest $request, Ingredient $ingredient)
    {
        $validated = $request->validated();

        $ingredient->update($validated);

        return redirect()->route('ingredients.index')->with('success', 'Ингредиент успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ингредиент успешно удален!');
    }
}
