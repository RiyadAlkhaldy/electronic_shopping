<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()
                ->constrained('stores', 'id')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()
                ->constrained('categories', 'id')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->float('price')->default(0);
            $table->float('compare_price')->nullable();
            $table->json('options')->nullable();
            $table->float('rating')->default(0);
            $table->boolean('featured')->default(0);
            $table->enum('status', ['active', 'draft','archvied'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
