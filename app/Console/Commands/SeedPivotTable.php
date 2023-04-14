<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class SeedPivotTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-pivot-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the category_product table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = $this->fetchProducts();
        $categoriesCount = $this->getCategoriesCount();
        $products->each(function($product) use ($categoriesCount){
            $random = rand(1, $categoriesCount - 1);
            $product->categories()->attach([
                $random,
                $random + 1,
            ]);
        });
    }

    private function fetchProducts()
    {
        return Product::all();
    }

    public function getCategoriesCount(): int
    {
        return Category::all()->count();
    }


}
