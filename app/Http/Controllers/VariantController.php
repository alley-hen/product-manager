<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVariantRequest;
use App\Http\Requests\UpdateVariantRequest;
use App\Models\Product;
use App\Models\Variant;

class VariantController extends Controller
{

    public function store(CreateVariantRequest $createVariantRequest)
    {
        $validatedData = $createVariantRequest->validated();
        Variant::create($validatedData);

        $product = Product::find($createVariantRequest->product_id);

        return to_route('products.edit', $product);
    }

    public function destroy(Variant $variant)
    {
        $product = Product::find($variant->product_id);
        $variant->delete();

        return to_route('products.edit', $product);
    }
}
