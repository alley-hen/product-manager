<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'variants',
            'categories' => fn($query) => $query->select('id', 'name')
        ])->orderBy('name')
            ->get();
        return Inertia::render('Products', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('ProductCreate');
    }

    public function store(CreateProductRequest $createProductRequest)
    {
        $validatedData = $createProductRequest->validated();
        $product = Product::create($validatedData);

        return to_route('products.edit', $product);
    }

    public function addToCategory(Product $product, Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|int',
        ]);
        $product->categories()->attach($validated);

        return to_route('products.edit', $product);
    }

    public function removeFromCategory(Product $product, Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|int',
        ]);
        $product->categories()->detach($validated);

        return to_route('products.edit', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $product = Product::where('id',$product->id)->with(['variants', 'categories' ])->first();
        return Inertia::render('ProductEdit',[
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(UpdateProductRequest $updateProductRequest, Product $product)
    {
        $validated = $updateProductRequest->validated();

        $product->update($validated);

        return to_route('products');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products');
    }

    public function addVariant(Product $product)
    {
        return Inertia::render('VariantCreate', [
            'product' => $product
        ]);
    }
}
