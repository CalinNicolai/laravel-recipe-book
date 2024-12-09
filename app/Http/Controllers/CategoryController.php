<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->searchAndSort($request);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('category-images', 'public');
        } else {
            $path = null;
        }

        Category::create([
            'name' => $request->name,
            'image' => $path,
        ]);

        return redirect()->route('categories.index')->with('success', 'Категория успешно добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('category-images', 'public');
        } else {
            $path = $category->image;
        }

        if ($category->image && Storage::exists('public/' . $category->image)) {
            Storage::delete('public/' . $category->image);
        }
        $category->image = $path;

        $category->name = $request->name;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Категория успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->recipes()->delete();

            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }

            $category->delete();
        } catch (\Exception $e) {
            Log::error('Ошибка при удалении категории: ', ['exception' => $e->getMessage()]);
            return redirect()->route('categories.index')->with('error', 'Ошибка при удалении категории.');
        }

        return redirect()->route('categories.index')->with('success', 'Категория успешно удалена!');
    }
}
