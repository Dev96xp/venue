<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER upd_id_product AFTER INSERT ON products FOR EACH ROW
                UPDATE ids SET ids.nextid = ids.nextid + 1 WHERE TABLES = "PRODUCTS"
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('product_triggers');  ORIGINAL
        DB::unprepared('DROP TRIGGER upd_id_product');
    }
};
