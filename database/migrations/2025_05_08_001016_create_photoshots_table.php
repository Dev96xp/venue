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
        Schema::create('photoshots', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('cus_id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('phone');
            $table->date('date')->nullable();
            $table->date('scheduled_at');
            $table->string('status');
            $table->string('aux1')->nullable();
            $table->string('aux2')->nullable();
            $table->string('aux3')->nullable();
            $table->string('aux4')->nullable();
            $table->string('description')->nullable();
            $table->text('note')->nullable();

            $table->unsignedBigInteger('photopack_id');
            $table->foreign('photopack_id')->references('id')->on('photopacks')->onDelete('cascade');

            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // $table->unsignedBigInteger('package_id');
            // $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photoshots');
    }
};
