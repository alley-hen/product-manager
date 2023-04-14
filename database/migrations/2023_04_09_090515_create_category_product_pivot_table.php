<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignId('category_id');
            $table->foreignId('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
