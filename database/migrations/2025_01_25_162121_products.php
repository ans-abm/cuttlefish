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
            $table->bigIncrements('id');
			$table->string('sku')->unique();
			$table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->string('productTitle');
            $table->text('description');
			$table->decimal('price', 5, 2);
			$table->string('image')->nullable();
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->timestamps();
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
