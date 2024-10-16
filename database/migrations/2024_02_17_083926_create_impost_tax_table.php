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
        Schema::create('impost_tax', function (Blueprint $table) {
            $table->id();

            // 1. Define el campo para la tax_id
            $table->unsignedBigInteger('tax_id');
            // 2. Define hacia que tabla apunta este campo(tax_id), en este caso hacia la tabla: taxes
            // 3. Define que, si se borra un registros de la tabla taxes, que de igual manera
            //    se elimine el registro en esta tabla.
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');


            $table->unsignedBigInteger('impost_id');
            $table->foreign('impost_id')->references('id')->on('imposts')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impost_tax');
    }
};
