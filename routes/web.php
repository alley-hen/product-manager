<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VariantController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('categories');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('products');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/{product}/variant', [ProductController::class, 'addVariant'])->name('products.add-variant');
    Route::patch('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('products/{product}/add-to-category', [ProductController::class, 'addToCategory'])->name('products.add-to-category');
    Route::post('products/{product}/remove-from-category', [ProductController::class, 'removeFromCategory'])->name('products.remove-from-category');

    Route::post('/variants/store', [VariantController::class, 'store'])->name('variants.store');
    Route::delete('/variants/{variant}', [VariantController::class, 'destroy'])->name('variants.destroy');
});

require __DIR__ . '/auth.php';
