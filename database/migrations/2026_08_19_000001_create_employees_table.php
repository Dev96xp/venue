<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('employee_code')->nullable()->unique();
            $table->string('password');
            $table->string('role')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('salary_period')->nullable();
            $table->string('status')->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
