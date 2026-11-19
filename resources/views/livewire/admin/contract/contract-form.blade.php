<div class="contracts-module px-4 sm:px-6 lg:px-8 pb-8">
    <form wire:submit="save">

        {{-- 1. CLIENTE --}}
        <div class="card">
            <div class="card-header font-bold">1. Cliente</div>
            <div class="card-body">
                @if (! $user_id)
                    <x-label value="Buscar cliente registrado (nombre, email o teléfono)" class="mb-1" />
                    <input wire:model.live.debounce.300ms="clientSearch" class="form-control" placeholder="Escribe al menos 2 letras...">
                    <x-input-error for="user_id" />

                    @if ($clients->count())
                        <div class="border rounded mt-2 divide-y">
                            @foreach ($clients as $client)
                                <button type="button" wire:click="selectClient({{ $client->id }})"
                                    class="block w-full text-left px-3 py-2 hover:bg-gray-100">
                                    <span class="font-bold">{{ $client->name }}</span>
                                    <span class="text-gray-500 text-sm">— {{ $client->email }} · {{ $client->phone }}</span>
                                </button>
                            @endforeach
                        </div>
                    @elseif (strlen($clientSearch) >= 2)
                        <p class="text-sm text-gray-500 mt-2">
                            No se encontró el cliente. Regístralo primero en
                            <a href="{{ route('admin.users.index') }}" class="text-indigo-600">Users</a>.
                        </p>
                    @endif
                @else
                    <div class="flex justify-between items-center mb-3 p-2 bg-gray-50 rounded">
                        <div>
                            Cliente seleccionado: <span class="font-bold">{{ $client_name }}</span>
                            <span class="text-xs text-gray-500">(los datos se copiaron del registro; puedes corregirlos aquí)</span>
                        </div>
                        @if (! $contract)
                            <button type="button" wire:click="clearClient" class="text-sm text-red-600">Cambiar cliente</button>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                        <div>
                            <x-label value="Full legal name" class="mb-1" />
                            <x-input type="text" class="w-full" wire:model="client_name" />
                            <x-input-error for="client_name" />
                        </div>
                        <div>
                            <x-label value="Email" class="mb-1" />
                            <x-input type="email" class="w-full" wire:model="client_email" />
                            <x-input-error for="client_email" />
                        </div>
                        <div>
                            <x-label value="Phone" class="mb-1" />
                            <x-input type="text" class="w-full" wire:model="client_phone" />
                            <x-input-error for="client_phone" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                        <div class="md:col-span-3">
                            <x-label value="Address" class="mb-1" />
                            <x-input type="text" class="w-full" wire:model="client_address" />
                            <x-input-error for="client_address" />
                        </div>
                        <div class="md:col-span-1">
                            <x-label value="City" class="mb-1" />
                            <x-input type="text" class="w-full" wire:model="client_city" />
                            <x-input-error for="client_city" />
                        </div>
                        <div class="md:col-span-1">
                            <x-label value="State" class="mb-1" />
                            <x-input type="text" class="w-full" wire:model="client_state" />
                            <x-input-error for="client_state" />
                        </div>
                        <div class="md:col-span-1">
                            <x-label value="Zip" class="mb-1" />
                            <x-input type="text" class="w-full" wire:model="client_zip" />
                            <x-input-error for="client_zip" />
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- 2. EVENTO --}}
        <div class="card">
            <div class="card-header font-bold">2. Evento</div>
            <div class="card-body">
                @if ($events->count())
                    <div class="mb-3">
                        <x-label value="Vincular con un evento existente del cliente (opcional)" class="mb-1" />
                        <select wire:model.live="event_id" class="form-control">
                            <option value="">-- Sin evento vinculado --</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">
                                    {{ $event->code }} — {{ $event->title ?: $event->name }}
                                    ({{ \Carbon\Carbon::parse($event->scheduled_at ?: $event->date)->format('M j, Y') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-3">
                    <div>
                        <x-label value="Event type" class="mb-1" />
                        <select wire:model="event_type" class="form-control">
                            @foreach (\App\Models\Contract::EVENT_TYPES as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="event_type" />
                    </div>
                    <div>
                        <x-label value="Event date" class="mb-1" />
                        <x-input type="date" class="w-full" wire:model.live="event_date" />
                        <x-input-error for="event_date" />
                    </div>
                    <div>
                        <x-label value="Start time" class="mb-1" />
                        <x-input type="time" class="w-full" wire:model="start_time" />
                        <x-input-error for="start_time" />
                    </div>
                    <div>
                        <x-label value="End time" class="mb-1" />
                        <x-input type="time" class="w-full" wire:model="end_time" />
                        <x-input-error for="end_time" />
                    </div>
                    <div>
                        <x-label value="Guests (max)" class="mb-1" />
                        <x-input type="number" min="1" class="w-full" wire:model="guest_count" />
                        <x-input-error for="guest_count" />
                    </div>
                </div>

                @if ($conflicts->count())
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        Ya hay {{ $conflicts->count() }} contrato(s) reservando esta fecha:
                        @foreach ($conflicts as $c)
                            <a href="{{ route('admin.contracts.show', $c) }}" target="_blank" class="font-bold">{{ $c->code }}</a>
                            ({{ $c->client_name }}, {{ $c->room ?: 'sin salón' }}, {{ $c->statusLabel() }}){{ ! $loop->last ? ',' : '' }}
                        @endforeach
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label value="Room / area rented" class="mb-1" />
                        <x-input type="text" class="w-full" wire:model="room" placeholder="Main Hall" />
                        <x-input-error for="room" />
                    </div>
                    <div>
                        <x-label value="Included services" class="mb-1" />
                        <textarea wire:model="services" rows="2" class="form-control"
                            placeholder="Tables, chairs, linens, setup, cleanup, sound system..."></textarea>
                        <x-input-error for="services" />
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. PAGOS --}}
        <div class="card">
            <div class="card-header font-bold">3. Precio y pagos</div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <x-label value="Total rental fee ($)" class="mb-1" />
                        <x-input type="number" step="0.01" min="0" class="w-full" wire:model.live.debounce.500ms="rental_fee" />
                        <x-input-error for="rental_fee" />
                    </div>
                    <div>
                        <x-label value="Reservation deposit ($)" class="mb-1" />
                        <x-input type="number" step="0.01" min="0" class="w-full" wire:model.live.debounce.500ms="deposit_amount" />
                        <span class="text-xs text-gray-500">No reembolsable</span>
                        <x-input-error for="deposit_amount" />
                    </div>
                    <div>
                        <x-label value="Balance due date" class="mb-1" />
                        <x-input type="date" class="w-full" wire:model="balance_due_date" />
                        <x-input-error for="balance_due_date" />
                    </div>
                    <div>
                        <x-label value="Security deposit ($)" class="mb-1" />
                        <x-input type="number" step="0.01" min="0" class="w-full" wire:model="security_deposit" />
                        <span class="text-xs text-gray-500">Reembolsable (daños)</span>
                        <x-input-error for="security_deposit" />
                    </div>
                    <div>
                        <x-label value="Overtime per hour ($)" class="mb-1" />
                        <x-input type="number" step="0.01" min="0" class="w-full" wire:model="overtime_rate" />
                        <x-input-error for="overtime_rate" />
                    </div>
                </div>

                @if (is_numeric($rental_fee) && is_numeric($deposit_amount))
                    <p class="mt-3 text-sm">
                        Saldo pendiente: <span class="font-bold">${{ number_format(max(0, $rental_fee - $deposit_amount), 2) }}</span>
                    </p>
                @endif
            </div>
        </div>

        {{-- 4. TÉRMINOS --}}
        <div class="card">
            <div class="card-header font-bold">4. Plantilla y términos especiales</div>
            <div class="card-body">
                <div class="mb-3">
                    <x-label value="Contract template" class="mb-1" />
                    <select wire:model="contract_template_id" class="form-control">
                        <option value="">-- Selecciona --</option>
                        @foreach ($templates as $template)
                            @if ($template->is_active || $template->id == $contract_template_id)
                                <option value="{{ $template->id }}">{{ $template->name }} (v{{ $template->version }})</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error for="contract_template_id" />
                </div>

                <div class="mb-3">
                    <x-label value="Special terms (aparecen en el contrato)" class="mb-1" />
                    <textarea wire:model="special_terms" rows="4" class="form-control"
                        placeholder="Ej: Client may access the venue at 10:00 AM for decoration. Catering by XYZ Catering."></textarea>
                    <x-input-error for="special_terms" />
                </div>

                <div>
                    <x-label value="Internal notes (NO aparecen en el contrato)" class="mb-1" />
                    <textarea wire:model="internal_notes" rows="2" class="form-control"></textarea>
                    <x-input-error for="internal_notes" />
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ $contract ? route('admin.contracts.show', $contract) : route('admin.contracts.index') }}"
                class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-danger" wire:loading.attr="disabled">
                <i class="fas fa-save"></i> Guardar borrador
            </button>
        </div>
    </form>
</div>
