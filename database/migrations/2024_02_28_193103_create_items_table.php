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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->default('...');
            $table->string('model')->nullable();
            $table->text('description')->default('...');
            $table->text('note')->nullable();
            $table->float('price')->default(0.00);
            $table->float('payment')->default(0.00);
            $table->float('tax')->default(7.5);
            $table->integer('qty')->default(0.00);
            $table->string('size')->default(0.00);
            $table->string('color')->default("");
            $table->float('bust')->default(0.00);
            $table->float('waist')->default(0.00);
            $table->float('hip')->default(0.00);
            $table->string('status')->default(3);
            $table->integer('executive_id')->nullable();

            // Su jefe es la tabla:companies, NO SE USA EN ESTE MOMENTO
            // $table->unsignedBigInteger('company_id')->nullable();
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');

            $table->unsignedBigInteger('store_id')->nullable();
                    $table->foreign('store_id')->references('id')->on('stores')->onDelete('set null');

            // Su jefe es la tabla:transaction
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');


            // Su jefe es la tabla:requisition

            // Crear columnas para llaves FORANEAS
            //$table->unsignedBigInteger('requisition_id')->nullable();
            // Agregar las restriciones para las llaves foraneas
            //$table->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
