<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTemplate extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Variables disponibles para usar en el texto de la plantilla
    const PLACEHOLDERS = [
        'contract_code' => 'Número de contrato',
        'contract_date' => 'Fecha de hoy',
        'venue_name' => 'Nombre del salón (Business)',
        'venue_address' => 'Dirección del salón',
        'venue_phone' => 'Teléfono del salón',
        'venue_email' => 'Email del salón',
        'client_name' => 'Nombre del cliente',
        'client_email' => 'Email del cliente',
        'client_phone' => 'Teléfono del cliente',
        'client_address' => 'Dirección completa del cliente',
        'event_type' => 'Tipo de evento',
        'event_date' => 'Fecha del evento',
        'start_time' => 'Hora de inicio',
        'end_time' => 'Hora de terminación',
        'guest_count' => 'Número de invitados',
        'room' => 'Salón / área',
        'services' => 'Servicios incluidos',
        'rental_fee' => 'Precio total',
        'deposit_amount' => 'Depósito de reserva',
        'balance_due' => 'Saldo pendiente',
        'balance_due_date' => 'Fecha límite del saldo',
        'security_deposit' => 'Depósito por daños',
        'overtime_rate' => 'Costo por hora extra',
        'special_terms' => 'Términos especiales',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderByDesc('version');
    }
}
