<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Categories', [
            'categories' => Category::withCount('products')->orderBy('name')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('CategoryCreate');
    }

    public function store(CreateCategoryRequest $createCategoryRequest)
    {
        $validatedData = $createCategoryRequest->validated();
        Category::create($validatedData);

        return to_route('categories');
    }

    public function show(Category $category)
    {
        $category = Category::where('id',$category->id)->with('products.variants')->first();
        return Inertia::render('CategoryProducts',[
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        return Inertia::render('CategoryEdit',[
            'category' => $category
        ]);
    }

    public function update(UpdateCategoryRequest $updateCategoryRequest, Category $category)
    {
        $validatedData = $updateCategoryRequest->validated();
        $category->update($validatedData);

        return to_route('categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories');
    }
}
