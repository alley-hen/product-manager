<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'slug' => fake()->word,
        ];
    }

    public function createSlug(): ProductFactory
    {
        return $this->afterCreating(function (Product $product) {
            $slug = Str::slug($product->name);
            $product->update(['slug' => $slug]);
        });
    }

    public function withVariants(): ProductFactory
    {
        return $this->afterCreating(function (Product $product){
            $product->variants = Variant::factory()->count(3)->create([
                'product_id' => $product->id
            ]);
        });
    }
}
