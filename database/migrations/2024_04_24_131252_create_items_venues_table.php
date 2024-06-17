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
        Schema::create('items_venues', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->text('status');

            $table->string('aux')->default('ACTIVE');
            $table->string('aux2')->default('NADA');
            $table->string('aux3')->default('NADA');
            $table->integer('executive_id')->nullable();


            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');

            $table->unsignedBigInteger('status_items_venue_id');
            $table->foreign('status_items_venue_id')->references('id')->on('status_items_venues')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_venues');
    }
};
