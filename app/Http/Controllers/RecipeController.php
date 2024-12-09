<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('admin.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('admin.recipes.create', compact('categories', 'ingredients'));
    }

    // Store recipe in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'ingredients' => 'array',
            'ingredients.*.id' => 'exists:ingredients,id',
            'ingredients.*.quantity' => 'required_with:ingredients.*.id|string',
            'steps' => 'array',
            'steps.*.description' => 'required|string',
        ]);

        $recipe = Recipe::create($validated);

        if (isset($validated['ingredients'])) {
            foreach ($validated['ingredients'] as $ingredient) {
                $recipe->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
            }
        }

        if (isset($validated['steps'])) {
            foreach ($validated['steps'] as $index => $step) {
                $recipe->steps()->create([
                    'description' => $step['description'],
                    'step_number' => $index + 1,
                ]);
            }
        }

        return redirect()->route('recipes.index')->with('success', 'Рецепт успешно добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('admin.recipes.edit', compact('recipe', 'categories', 'ingredients'));
    }

    // Update recipe in the database
    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'ingredients' => 'array',
            'ingredients.*.id' => 'exists:ingredients,id',
            'ingredients.*.quantity' => 'required_with:ingredients.*.id|string',
            'steps' => 'array',
            'steps.*.description' => 'required|string',
        ]);

        $recipe->update($validated);

        $recipe->ingredients()->detach();
        if (isset($validated['ingredients'])) {
            foreach ($validated['ingredients'] as $ingredient) {
                $recipe->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
            }
        }

        $recipe->steps()->delete();
        if (isset($validated['steps'])) {
            foreach ($validated['steps'] as $index => $step) {
                $recipe->steps()->create([
                    'description' => $step['description'],
                    'step_number' => $index + 1,
                ]);
            }
        }

        return redirect()->route('recipes.index')->with('success', 'Рецепт успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Рецепт успешно удален!');
    }
}
