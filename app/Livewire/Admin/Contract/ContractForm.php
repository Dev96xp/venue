<?php

namespace App\Livewire\Admin\Contract;

use App\Models\Contract;
use App\Models\ContractTemplate;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ContractForm extends Component
{
    public ?Contract $contract = null;

    // Búsqueda de cliente (cuando se entra sin ?user=)
    public $clientSearch = '';

    public $user_id = null;
    public $event_id = '';
    public $contract_template_id = '';

    public $client_name = '';
    public $client_email = '';
    public $client_phone = '';
    public $client_address = '';
    public $client_city = '';
    public $client_state = '';
    public $client_zip = '';

    public $event_type = 'Wedding';
    public $event_date = '';
    public $start_time = '16:00';
    public $end_time = '23:59';
    public $guest_count = '';
    public $room = '';
    public $services = '';

    public $rental_fee = '';
    public $deposit_amount = '';
    public $security_deposit = '500';
    public $balance_due_date = '';
    public $overtime_rate = '';

    public $special_terms = '';
    public $internal_notes = '';

    // Sin type-hint: Livewire intentaría buscar un modelo con id null al crear
    public function mount($contract = null, $user = null)
    {
        if ($contract instanceof Contract && $contract->exists) {
            $this->contract = $contract;
            $this->fill($contract->only([
                'user_id', 'client_name', 'client_email', 'client_phone', 'client_address',
                'client_city', 'client_state', 'client_zip', 'event_type', 'guest_count', 'room',
                'services', 'rental_fee', 'deposit_amount', 'security_deposit', 'overtime_rate',
                'special_terms', 'internal_notes',
            ]));
            $this->event_id = $contract->event_id ?? '';
            $this->contract_template_id = $contract->contract_template_id ?? '';
            $this->event_date = $contract->event_date?->format('Y-m-d');
            $this->balance_due_date = $contract->balance_due_date?->format('Y-m-d') ?? '';
            $this->start_time = Carbon::parse($contract->start_time)->format('H:i');
            $this->end_time = Carbon::parse($contract->end_time)->format('H:i');

            return;
        }

        $this->contract_template_id = ContractTemplate::active()->value('id') ?? '';

        if ($user instanceof User && $user->exists) {
            $this->selectClient($user->id);
        }
    }

    // Llena el contrato con la información del cliente registrado
    public function selectClient($userId)
    {
        $user = User::findOrFail($userId);

        $this->user_id = $user->id;
        $this->client_name = $user->name;
        $this->client_email = $user->email;
        $this->client_phone = $user->phone === '000-000-0000' ? '' : $user->phone;
        $this->client_address = $user->address ?? '';
        $this->client_city = $user->city ?? '';
        $this->client_state = $user->state ?? '';
        $this->client_zip = $user->zip ?? '';
        $this->clientSearch = '';
        $this->event_id = '';
    }

    public function clearClient()
    {
        $this->reset(['user_id', 'event_id', 'client_name', 'client_email', 'client_phone',
            'client_address', 'client_city', 'client_state', 'client_zip']);
    }

    // Si el cliente ya tiene un evento, tomar la fecha y descripción
    public function updatedEventId($value)
    {
        if (! $value || ! $event = Event::find($value)) {
            return;
        }

        $date = $event->scheduled_at ?: $event->date;
        if ($date) {
            $this->event_date = Carbon::parse($date)->format('Y-m-d');
            $this->suggestBalanceDate();
        }
        if (! $this->room && $event->venue) {
            $this->room = $event->venue->name;
        }
    }

    public function updatedEventDate()
    {
        $this->suggestBalanceDate();
    }

    // Por defecto el saldo vence 30 días antes del evento
    protected function suggestBalanceDate()
    {
        if ($this->event_date) {
            $due = Carbon::parse($this->event_date)->subDays(30);
            $this->balance_due_date = $due->isPast() ? today()->format('Y-m-d') : $due->format('Y-m-d');
        }
    }

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'event_id' => 'nullable|exists:events,id',
            'contract_template_id' => 'required|exists:contract_templates,id',
            'client_name' => 'required|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|max:50',
            'client_address' => 'required|max:255',
            'client_city' => 'required|max:100',
            'client_state' => 'required|max:50',
            'client_zip' => 'nullable|max:20',
            'event_type' => 'required|max:100',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'guest_count' => 'required|integer|min:1',
            'room' => 'nullable|max:255',
            'services' => 'nullable|max:5000',
            'rental_fee' => 'required|numeric|min:0',
            'deposit_amount' => 'required|numeric|min:0|lte:rental_fee',
            'security_deposit' => 'required|numeric|min:0',
            'balance_due_date' => 'nullable|date|before_or_equal:event_date',
            'overtime_rate' => 'nullable|numeric|min:0',
            'special_terms' => 'nullable|max:10000',
            'internal_notes' => 'nullable|max:10000',
        ];
    }

    protected $messages = [
        'user_id.required' => 'Selecciona un cliente registrado.',
        'deposit_amount.lte' => 'El depósito no puede ser mayor que el precio total.',
        'balance_due_date.before_or_equal' => 'El saldo debe vencer antes o el día del evento.',
    ];

    public function save()
    {
        if ($this->contract && ! $this->contract->isEditable()) {
            abort(403, 'Este contrato ya no se puede editar.');
        }

        $data = $this->validate();

        foreach (['event_id', 'balance_due_date', 'overtime_rate'] as $field) {
            $data[$field] = $data[$field] === '' ? null : $data[$field];
        }
        $data['template_version'] = ContractTemplate::find($data['contract_template_id'])->version;

        if ($this->contract) {
            $this->contract->update($data);
            $contract = $this->contract;
        } else {
            $contract = Contract::create($data + [
                'code' => Contract::generateCode(),
                'status' => Contract::STATUS_DRAFT,
                'created_by' => auth()->id(),
            ]);
            $contract->statusLogs()->create([
                'to_status' => Contract::STATUS_DRAFT,
                'user_id' => auth()->id(),
                'note' => 'Contrato creado',
            ]);
        }

        return redirect()->route('admin.contracts.show', $contract)
            ->with('info', 'Contrato guardado correctamente.');
    }

    public function render()
    {
        $clients = strlen($this->clientSearch) >= 2
            ? User::where(function ($q) {
                $q->where('name', 'like', '%' . $this->clientSearch . '%')
                    ->orWhere('email', 'like', '%' . $this->clientSearch . '%')
                    ->orWhere('phone', 'like', '%' . $this->clientSearch . '%');
            })->limit(8)->get()
            : collect();

        $events = $this->user_id
            ? Event::where('user_id', $this->user_id)->orderByDesc('scheduled_at')->get()
            : collect();

        // Aviso de doble reservación en la misma fecha
        $conflicts = $this->event_date
            ? Contract::whereDate('event_date', $this->event_date)
                ->whereIn('status', Contract::BOOKING_STATUSES)
                ->when($this->contract, fn ($q) => $q->where('id', '!=', $this->contract->id))
                ->get()
            : collect();

        $templates = ContractTemplate::orderBy('name')->orderByDesc('version')->get();

        return view('livewire.admin.contract.contract-form', compact('clients', 'events', 'conflicts', 'templates'));
    }
}
