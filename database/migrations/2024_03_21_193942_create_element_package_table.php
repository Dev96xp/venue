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
        Schema::create('element_package', function (Blueprint $table) {
            $table->id();
            $table->string('bkpackage_id')->nullable();
            $table->integer('product_id')->default(0);
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('element_id');
          // restricion de la llave foranea
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');
            $table->foreign('element_id')->references('id')->on('elements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_package');
    }
};
