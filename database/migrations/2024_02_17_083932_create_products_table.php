<?php

use App\Models\Product;
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
            $table->string('sku')->unique();
            $table->string('model');
            $table->string('style');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->float('webprice');
            $table->float('suggestedprice');
            $table->float('wholesaleprice');
            $table->string('sign')->default('none');
            $table->float('discount');
            $table->enum('status', [Product::BORRADOR, Product::REVISION, Product::PUBLICADO])->default(Product::PUBLICADO);
            $table->string('type')->default('none');
            $table->string('aux')->default('none');
            $table->string('aux2')->default('none');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->unsignedBigInteger('status_product_id');
            $table->foreign('status_product_id')->references('id')->on('status_products')->onDelete('cascade');

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
