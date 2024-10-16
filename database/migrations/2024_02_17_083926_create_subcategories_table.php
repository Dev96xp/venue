<?php

use App\Models\Subcategory;
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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->boolean('color')->default(false);
            $table->boolean('size')->default(false);

            $table->boolean('active')->default(true);
            $table->boolean('company')->default(false);     // Que se muestre esta informacion en la pantalla de venta en el website, segun la categoria
            $table->boolean('model')->default(false);
            $table->boolean('quantity')->default(false);
            $table->boolean('bust')->default(false);
            $table->boolean('waist')->default(false);
            $table->boolean('hip')->default(false);
            $table->boolean('date')->default(false);
            $table->boolean('coupon')->default(false);
            $table->boolean('description')->default(false);
            $table->boolean('note1')->default(false);
            $table->boolean('note2')->default(false);
            $table->boolean('note3')->default(false);
            $table->boolean('video')->default(false);
            $table->enum('status', [Subcategory::ACTIVE, Subcategory::INACTIVE, Subcategory::PENDING])->default(Subcategory::ACTIVE);

            // 1- Definicion de la columna
            $table->unsignedBigInteger('category_id');

            // 2- Restriciones a la relacion1
            // MASTER CLASS - En el caso de que se elimine una Categoria, en cascada se eliminaran tambien
            //                las subcategorias
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');


            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedBigInteger('impost_id')->nullable();
            // EN CASO DE QUE SE ELIMINE UN REGISTRO DE LA TABLA: IMPUESTO,
            // EN ESTA TABLA: SUBCATEGORIAS EL REGISTRO QUE APUNTA A ELLA
            // NO SERA BORRADO, SOLO SERA CONVERTIDO A NULO.
            $table->foreign('impost_id')->references('id')->on('imposts')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
