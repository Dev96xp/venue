<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();               // CT-2026-0001
            $table->string('status')->default('draft')->index();

            // Relaciones
            $table->foreignId('user_id')->constrained('users');                              // Cliente
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->foreignId('contract_template_id')->nullable()->constrained('contract_templates')->nullOnDelete();
            $table->unsignedInteger('template_version')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            // Copia de los datos del cliente al momento del contrato
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_state')->nullable();
            $table->string('client_zip')->nullable();

            // Datos del evento
            $table->string('event_type');                   // Wedding, Quinceañera, Birthday...
            $table->date('event_date')->index();
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('guest_count');
            $table->string('room')->nullable();             // Salón / área contratada
            $table->text('services')->nullable();           // Servicios incluidos

            // Montos
            $table->decimal('rental_fee', 10, 2);           // Precio total
            $table->decimal('deposit_amount', 10, 2);       // Depósito de reserva (no reembolsable)
            $table->decimal('security_deposit', 10, 2)->default(0); // Depósito por daños (reembolsable)
            $table->date('balance_due_date')->nullable();
            $table->decimal('overtime_rate', 10, 2)->nullable();    // Costo por hora extra

            // Resolución del depósito por daños
            $table->decimal('security_deposit_refunded', 10, 2)->nullable();
            $table->text('security_deposit_notes')->nullable();

            $table->text('special_terms')->nullable();
            $table->text('internal_notes')->nullable();

            // Texto final del contrato (se congela al salir de borrador)
            $table->longText('body')->nullable();

            // Fechas de cada estado
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();

            $table->timestamps();
        });

        Schema::create('contract_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained('contracts')->cascadeOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_status_logs');
        Schema::dropIfExists('contracts');
    }
};
