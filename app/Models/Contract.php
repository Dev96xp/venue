<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use InvalidArgumentException;

class Contract extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'event_date' => 'date',
        'balance_due_date' => 'date',
        'rental_fee' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'security_deposit_refunded' => 'decimal:2',
        'overtime_rate' => 'decimal:2',
        'sent_at' => 'datetime',
        'signed_at' => 'datetime',
        'activated_at' => 'datetime',
        'paid_at' => 'datetime',
        'completed_at' => 'datetime',
        'archived_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // ---------------------------------------------------------------
    // ESTADOS
    // ---------------------------------------------------------------
    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_SIGNED = 'signed';
    const STATUS_ACTIVE = 'active';
    const STATUS_PAID = 'paid_in_full';
    const STATUS_COMPLETED = 'completed';
    const STATUS_ARCHIVED = 'archived';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_EXPIRED = 'expired';

    const STATUSES = [
        self::STATUS_DRAFT => 'Borrador',
        self::STATUS_SENT => 'Enviado',
        self::STATUS_SIGNED => 'Firmado',
        self::STATUS_ACTIVE => 'Activo / Confirmado',
        self::STATUS_PAID => 'Pagado completo',
        self::STATUS_COMPLETED => 'Completado',
        self::STATUS_ARCHIVED => 'Archivado',
        self::STATUS_CANCELLED => 'Cancelado',
        self::STATUS_EXPIRED => 'Expirado',
    ];

    // Transiciones permitidas: estado actual => [estados siguientes]
    const TRANSITIONS = [
        self::STATUS_DRAFT => [self::STATUS_SENT, self::STATUS_SIGNED, self::STATUS_CANCELLED],
        self::STATUS_SENT => [self::STATUS_SIGNED, self::STATUS_DRAFT, self::STATUS_EXPIRED, self::STATUS_CANCELLED],
        self::STATUS_SIGNED => [self::STATUS_ACTIVE, self::STATUS_CANCELLED],
        self::STATUS_ACTIVE => [self::STATUS_PAID, self::STATUS_COMPLETED, self::STATUS_CANCELLED],
        self::STATUS_PAID => [self::STATUS_COMPLETED, self::STATUS_CANCELLED],
        self::STATUS_COMPLETED => [self::STATUS_ARCHIVED],
        self::STATUS_CANCELLED => [self::STATUS_ARCHIVED],
        self::STATUS_EXPIRED => [self::STATUS_DRAFT, self::STATUS_ARCHIVED],
        self::STATUS_ARCHIVED => [],
    ];

    // Columna de fecha que se llena al entrar a cada estado
    const STATUS_TIMESTAMPS = [
        self::STATUS_SENT => 'sent_at',
        self::STATUS_SIGNED => 'signed_at',
        self::STATUS_ACTIVE => 'activated_at',
        self::STATUS_PAID => 'paid_at',
        self::STATUS_COMPLETED => 'completed_at',
        self::STATUS_ARCHIVED => 'archived_at',
        self::STATUS_CANCELLED => 'cancelled_at',
    ];

    // Estados que bloquean la fecha del salón
    const BOOKING_STATUSES = [self::STATUS_SENT, self::STATUS_SIGNED, self::STATUS_ACTIVE, self::STATUS_PAID];

    const EVENT_TYPES = [
        'Wedding', 'Quinceañera', 'Birthday', 'Baptism', 'Anniversary',
        'Graduation', 'Baby Shower', 'Corporate Event', 'Other',
    ];

    // ---------------------------------------------------------------
    // RELACIONES
    // ---------------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function template()
    {
        return $this->belongsTo(ContractTemplate::class, 'contract_template_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function statusLogs()
    {
        return $this->hasMany(ContractStatusLog::class)->latest('id');
    }

    // ---------------------------------------------------------------
    // HELPERS
    // ---------------------------------------------------------------
    public static function generateCode(): string
    {
        $prefix = 'CT-' . now()->year . '-';
        $last = static::where('code', 'like', $prefix . '%')->orderByDesc('code')->value('code');
        $next = $last ? ((int) Str::afterLast($last, '-')) + 1 : 1;

        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public static function badgeClass(string $status): string
    {
        return match ($status) {
            self::STATUS_DRAFT => 'bg-gray-100 text-gray-800',
            self::STATUS_SENT => 'bg-blue-100 text-blue-800',
            self::STATUS_SIGNED => 'bg-indigo-100 text-indigo-800',
            self::STATUS_ACTIVE => 'bg-green-100 text-green-800',
            self::STATUS_PAID => 'bg-emerald-100 text-emerald-800',
            self::STATUS_COMPLETED => 'bg-teal-100 text-teal-800',
            self::STATUS_ARCHIVED => 'bg-slate-200 text-slate-700',
            self::STATUS_CANCELLED => 'bg-red-100 text-red-800',
            self::STATUS_EXPIRED => 'bg-amber-100 text-amber-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function isEditable(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isArchived(): bool
    {
        return $this->status === self::STATUS_ARCHIVED;
    }

    public function allowedTransitions(): array
    {
        return self::TRANSITIONS[$this->status] ?? [];
    }

    public function canTransitionTo(string $status): bool
    {
        return in_array($status, $this->allowedTransitions(), true);
    }

    public function balanceDue(): float
    {
        return max(0, (float) $this->rental_fee - (float) $this->deposit_amount);
    }

    /**
     * Cambia el estado del contrato, registra la fecha y deja bitácora.
     * Al salir de borrador el texto del contrato se congela.
     */
    public function transitionTo(string $status, ?string $note = null, ?int $userId = null): void
    {
        if (! $this->canTransitionTo($status)) {
            throw new InvalidArgumentException("No se puede pasar de '{$this->status}' a '{$status}'.");
        }

        if ($status === self::STATUS_CANCELLED && blank($note)) {
            throw new InvalidArgumentException('Debes indicar el motivo de la cancelación.');
        }

        DB::transaction(function () use ($status, $note, $userId) {
            $from = $this->status;

            if ($from === self::STATUS_DRAFT) {
                // Congelar texto en ambos idiomas
                $this->body = $this->renderBody('en');
                $this->body_es = $this->renderBody('es') ?: null;
            }
            if ($status === self::STATUS_DRAFT) {
                // Se vuelve a generar al editar
                $this->body = null;
                $this->body_es = null;
            }

            if ($column = self::STATUS_TIMESTAMPS[$status] ?? null) {
                $this->{$column} = now();
            }
            if ($status === self::STATUS_CANCELLED) {
                $this->cancellation_reason = $note;
            }

            $this->status = $status;
            $this->save();

            $this->statusLogs()->create([
                'from_status' => $from,
                'to_status' => $status,
                'user_id' => $userId ?? auth()->id(),
                'note' => $note,
            ]);
        });
    }

    // Idiomas disponibles del contrato
    const LANGUAGES = ['en' => 'English', 'es' => 'Español'];

    // Traducción de los tipos de evento para la versión en español
    const EVENT_TYPES_ES = [
        'Wedding' => 'Boda', 'Quinceañera' => 'Quinceañera', 'Birthday' => 'Cumpleaños',
        'Baptism' => 'Bautizo', 'Anniversary' => 'Aniversario', 'Graduation' => 'Graduación',
        'Baby Shower' => 'Baby Shower', 'Corporate Event' => 'Evento corporativo', 'Other' => 'Otro',
    ];

    /**
     * ¿Hay versión en español? (congelada o en la plantilla)
     */
    public function hasSpanish(): bool
    {
        if ($this->body) {
            return filled($this->body_es);
        }

        return filled(($this->template ?? ContractTemplate::active()->first())?->body_es);
    }

    /**
     * Texto del contrato en Markdown. Si ya se congeló, devuelve la copia guardada.
     */
    public function contractText(string $lang = 'en'): string
    {
        if ($lang === 'es') {
            return $this->body ? ($this->body_es ?? '') : $this->renderBody('es');
        }

        return $this->body ?? $this->renderBody('en');
    }

    public function contractHtml(string $lang = 'en'): string
    {
        return Str::markdown($this->contractText($lang), [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    public function renderBody(string $lang = 'en'): string
    {
        $template = $this->template ?? ContractTemplate::active()->first();
        $body = $lang === 'es' ? $template?->body_es : $template?->body;

        return $body ? strtr($body, $this->placeholders($lang)) : '';
    }

    public function placeholders(string $lang = 'en'): array
    {
        $es = $lang === 'es';
        $business = Business::first();
        $money = fn ($v) => '$' . number_format((float) $v, 2);
        $time = fn ($v) => $v ? \Carbon\Carbon::parse($v)->format('g:i A') : '';
        $clean = fn ($v) => str_replace(['*', '_', '#', '`', '[', ']', '<', '>'], '', (string) $v);
        // Fechas: "Saturday, May 18, 2027" / "sábado, 18 de mayo de 2027"
        $date = fn ($d, $withDay = false) => $d
            ? ($es
                ? \Carbon\Carbon::parse($d)->locale('es')->translatedFormat(($withDay ? 'l, ' : '') . 'j \d\e F \d\e Y')
                : \Carbon\Carbon::parse($d)->format(($withDay ? 'l, ' : '') . 'F j, Y'))
            : null;

        $values = [
            'contract_code' => $this->code,
            'contract_date' => $date(now()),

            'venue_name' => $business->name ?? config('app.name'),
            'venue_address' => trim(implode(', ', array_filter([
                $business->address ?? null, $business->city ?? null,
                trim(($business->state ?? '') . ' ' . ($business->zip ?? '')),
            ]))),
            'venue_phone' => $business->phone ?? '',
            'venue_email' => $business->email ?? '',

            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'client_address' => trim(implode(', ', array_filter([
                $this->client_address, $this->client_city,
                trim($this->client_state . ' ' . $this->client_zip),
            ]))),

            'event_type' => $es ? (self::EVENT_TYPES_ES[$this->event_type] ?? $this->event_type) : $this->event_type,
            'event_date' => $date($this->event_date, true),
            'start_time' => $time($this->start_time),
            'end_time' => $time($this->end_time),
            'guest_count' => $this->guest_count,
            'room' => $this->room ?: ($es ? 'Salón principal' : 'Main Hall'),
            'services' => $this->services ?: ($es ? 'Según lo descrito en el paquete del evento.' : 'As described in the event package.'),

            'rental_fee' => $money($this->rental_fee),
            'deposit_amount' => $money($this->deposit_amount),
            'balance_due' => $money($this->balanceDue()),
            'balance_due_date' => $date($this->balance_due_date)
                ?? ($es ? 'treinta (30) días antes del Evento' : 'thirty (30) days before the Event'),
            'security_deposit' => $money($this->security_deposit),
            'overtime_rate' => $this->overtime_rate
                ? $money($this->overtime_rate)
                : ($es ? 'la tarifa por hora vigente del Salón' : 'the Venue\'s current hourly rate'),

            'special_terms' => $this->special_terms ?: ($es ? 'Ninguno.' : 'None.'),
        ];

        $map = [];
        foreach ($values as $key => $value) {
            $map['{' . $key . '}'] = $clean($value);
        }

        return $map;
    }
}
