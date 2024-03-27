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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->integer('rating');
            $table->string('model')->nullable();

            $table->string('aux')->default('ACTIVE');
            $table->string('aux2')->default('NADA');

            // TABLA POLIMORFICA
            $table->unsignedBigInteger('noteable_id');
            $table->string('noteable_type');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // retricion de la llave foranea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
