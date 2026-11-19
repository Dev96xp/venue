<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Versión en español de la plantilla
        Schema::table('contract_templates', function (Blueprint $table) {
            $table->longText('body_es')->nullable()->after('body');
        });

        // Texto congelado del contrato en español
        Schema::table('contracts', function (Blueprint $table) {
            $table->longText('body_es')->nullable()->after('body');
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('body_es');
        });

        Schema::table('contract_templates', function (Blueprint $table) {
            $table->dropColumn('body_es');
        });
    }
};
