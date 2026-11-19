@php
    use App\Models\Contract;
    $actionLabels = [
        Contract::STATUS_SENT => ['Marcar como enviado', 'btn-primary', 'fa-paper-plane'],
        Contract::STATUS_SIGNED => ['Marcar como firmado', 'btn-info', 'fa-signature'],
        Contract::STATUS_ACTIVE => ['Confirmar (depósito recibido)', 'btn-success', 'fa-check'],
        Contract::STATUS_PAID => ['Marcar pagado completo', 'btn-success', 'fa-dollar-sign'],
        Contract::STATUS_COMPLETED => ['Marcar evento completado', 'btn-secondary', 'fa-flag-checkered'],
        Contract::STATUS_ARCHIVED => ['Archivar', 'btn-dark', 'fa-archive'],
        Contract::STATUS_DRAFT => ['Regresar a borrador', 'btn-outline-secondary', 'fa-undo'],
        Contract::STATUS_EXPIRED => ['Marcar expirado', 'btn-warning', 'fa-hourglass-end'],
        Contract::STATUS_CANCELLED => ['Cancelar contrato', 'btn-outline-danger', 'fa-times'],
    ];
@endphp

{{-- size = tamaño de letra del contrato (1, 2, 3); se recuerda en este navegador y se usa también en el PDF --}}
<div class="contracts-module px-4 sm:px-6 lg:px-8 pb-8" x-data="{
        size: (() => { try { return Number(localStorage.getItem('contractTextSize')) || 1 } catch (e) { return 1 } })(),
        setSize(s) { this.size = s; try { localStorage.setItem('contractTextSize', s) } catch (e) {} }
    }">

    @if (session('info'))
        <div class="alert alert-success">{{ session('info') }}</div>
    @endif

    {{-- Encabezado --}}
    <div class="card">
        <div class="card-body">
            <div class="flex flex-wrap justify-between items-start gap-4">
                <div>
                    <h2 class="text-2xl font-bold">{{ $contract->code }}
                        <span class="ml-2 align-middle inline-flex rounded-full px-3 py-1 text-sm font-medium {{ Contract::badgeClass($contract->status) }}">
                            {{ $contract->statusLabel() }}
                        </span>
                    </h2>
                    <div class="text-gray-600">
                        {{ $contract->client_name }} · {{ $contract->event_type }} ·
                        {{ $contract->event_date->format('l, M j, Y') }}
                        ({{ \Carbon\Carbon::parse($contract->start_time)->format('g:i A') }} -
                        {{ \Carbon\Carbon::parse($contract->end_time)->format('g:i A') }})
                    </div>
                    @if ($contract->event_id)
                        <div class="text-sm text-gray-500">Evento vinculado: {{ $contract->event?->code }}</div>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2">
                    {{-- Cambiar idioma del contrato --}}
                    <div class="btn-group">
                        @foreach (Contract::LANGUAGES as $code => $langName)
                            <button type="button" wire:click="setLang('{{ $code }}')" title="{{ $langName }}"
                                class="btn btn-sm {{ $lang === $code ? 'btn-primary' : 'btn-outline-primary' }}">
                                {{ strtoupper($code) }}
                            </button>
                        @endforeach
                    </div>
                    {{-- El PDF sale en el idioma y tamaño de letra elegidos --}}
                    <a href="{{ route('admin.contracts.pdf', ['contract' => $contract, 'lang' => $lang]) }}"
                        :href="'{{ route('admin.contracts.pdf', ['contract' => $contract, 'lang' => $lang]) }}&size=' + size"
                        target="_blank" class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-file-pdf"></i> PDF {{ strtoupper($lang) }}
                        <span x-show="size > 1" x-text="size === 2 ? 'A+' : 'A++'" class="ml-1"></span>
                    </a>
                    @if ($contract->isEditable())
                        <a href="{{ route('admin.contracts.edit', $contract) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    @endif
                </div>
            </div>

            {{-- Acciones de estado --}}
            @if (count($contract->allowedTransitions()))
                <hr class="my-3">
                <div class="flex flex-wrap gap-2">
                    @foreach ($contract->allowedTransitions() as $status)
                        @php [$label, $class, $icon] = $actionLabels[$status]; @endphp
                        <button type="button" wire:click="askTransition('{{ $status }}')" class="btn btn-sm {{ $class }}">
                            <i class="fas {{ $icon }}"></i> {{ $label }}
                        </button>
                    @endforeach
                </div>
                @if ($contract->status === Contract::STATUS_DRAFT)
                    <p class="text-xs text-gray-500 mt-2">
                        Al marcarlo como enviado o firmado, el texto del contrato se congela y ya no se puede editar.
                    </p>
                @endif
            @endif

            @if ($contract->status === Contract::STATUS_CANCELLED)
                <div class="alert alert-danger mt-3 mb-0">
                    <strong>Motivo de cancelación:</strong> {{ $contract->cancellation_reason }}
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        {{-- Columna izquierda: resumen --}}
        <div class="lg:col-span-1">
            <div class="card">
                <div class="card-header font-bold">Cliente</div>
                <div class="card-body text-sm">
                    <div class="font-bold">{{ $contract->client_name }}</div>
                    <div>{{ $contract->client_email }}</div>
                    <div>{{ $contract->client_phone }}</div>
                    <div>{{ $contract->client_address }}, {{ $contract->client_city }}, {{ $contract->client_state }} {{ $contract->client_zip }}</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header font-bold">Pagos</div>
                <div class="card-body text-sm">
                    <table class="w-full">
                        <tr><td>Total</td><td class="text-right font-bold">${{ number_format($contract->rental_fee, 2) }}</td></tr>
                        <tr><td>Depósito de reserva</td><td class="text-right">${{ number_format($contract->deposit_amount, 2) }}</td></tr>
                        <tr><td>Saldo</td><td class="text-right">${{ number_format($contract->balanceDue(), 2) }}</td></tr>
                        <tr><td>Saldo vence</td><td class="text-right">{{ $contract->balance_due_date?->format('M j, Y') ?? '—' }}</td></tr>
                        <tr><td>Depósito por daños</td><td class="text-right">${{ number_format($contract->security_deposit, 2) }}</td></tr>
                        @if ($contract->overtime_rate)
                            <tr><td>Hora extra</td><td class="text-right">${{ number_format($contract->overtime_rate, 2) }}</td></tr>
                        @endif
                    </table>
                </div>
            </div>

            {{-- Depósito por daños, después del evento --}}
            @if (in_array($contract->status, [Contract::STATUS_COMPLETED, Contract::STATUS_ARCHIVED]) && $contract->security_deposit > 0)
                <div class="card {{ $this->depositPending() ? 'border-warning' : '' }}">
                    <div class="card-header font-bold">Devolución del depósito por daños</div>
                    <div class="card-body text-sm">
                        @if ($contract->status === Contract::STATUS_COMPLETED)
                            <x-label value="Monto a devolver ($)" class="mb-1" />
                            <x-input type="number" step="0.01" min="0" class="w-full" wire:model="refund_amount" />
                            <x-input-error for="refund_amount" />
                            <x-label value="Notas (daños, limpieza, horas extra...)" class="mt-2 mb-1" />
                            <textarea wire:model="refund_notes" rows="3" class="form-control"></textarea>
                            <x-input-error for="refund_notes" />
                            <button type="button" wire:click="saveDeposit" class="btn btn-sm btn-success mt-2">Guardar</button>
                        @else
                            <div>Devuelto: <strong>${{ number_format($contract->security_deposit_refunded, 2) }}</strong></div>
                            @if ($contract->security_deposit_notes)
                                <div class="text-gray-600">{{ $contract->security_deposit_notes }}</div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif

            @if ($contract->internal_notes)
                <div class="card">
                    <div class="card-header font-bold">Notas internas</div>
                    <div class="card-body text-sm whitespace-pre-line">{{ $contract->internal_notes }}</div>
                </div>
            @endif

            <div class="card">
                <div class="card-header font-bold">Historial</div>
                <div class="card-body text-sm">
                    <ul class="space-y-2">
                        @foreach ($logs as $log)
                            <li class="border-l-2 border-gray-300 pl-2">
                                <div>
                                    @if ($log->from_status && $log->from_status !== $log->to_status)
                                        {{ Contract::STATUSES[$log->from_status] ?? $log->from_status }} →
                                    @endif
                                    <strong>{{ Contract::STATUSES[$log->to_status] ?? $log->to_status }}</strong>
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $log->created_at->format('M j, Y g:i A') }} · {{ $log->user->name ?? 'Sistema' }}
                                </div>
                                @if ($log->note)
                                    <div class="text-gray-600">{{ $log->note }}</div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Columna derecha: texto del contrato --}}
        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header font-bold flex flex-wrap justify-between items-center gap-2">
                    <span>Contrato</span>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500 font-normal">
                            {{ $contract->body ? 'Texto congelado' : 'Vista previa (borrador)' }}
                            · Plantilla v{{ $contract->template_version }}
                        </span>
                        <div class="btn-group" role="group" aria-label="Tamaño de letra">
                            <button type="button" @click="setSize(1)" title="Letra normal" aria-label="Letra normal"
                                :class="size === 1 ? 'btn-secondary' : 'btn-outline-secondary'" class="btn btn-sm" style="font-size: .8rem">A</button>
                            <button type="button" @click="setSize(2)" title="Letra grande" aria-label="Letra grande"
                                :class="size === 2 ? 'btn-secondary' : 'btn-outline-secondary'" class="btn btn-sm" style="font-size: 1rem">A+</button>
                            <button type="button" @click="setSize(3)" title="Letra extra grande" aria-label="Letra extra grande"
                                :class="size === 3 ? 'btn-secondary' : 'btn-outline-secondary'" class="btn btn-sm" style="font-size: 1.2rem">A++</button>
                        </div>
                    </div>
                </div>
                <div class="card-body contract-body" :class="'text-size-' + size">
                    @if ($lang === 'es' && ! $contract->hasSpanish())
                        <div class="alert alert-warning">
                            Este contrato no tiene versión en español. Agrégala en
                            <a href="{{ route('admin.contracts.templates') }}">Contract Templates</a> (pestaña Español).
                        </div>
                    @else
                        {!! $contract->contractHtml($lang) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de confirmación de cambio de estado --}}
    <x-dialog-modal wire:model="newStatus">
        <x-slot name="title">
            {{ $newStatus ? ($actionLabels[$newStatus][0] ?? '') : '' }}
        </x-slot>
        <x-slot name="content">
            <p class="mb-2">
                {{ $contract->statusLabel() }} → <strong>{{ $newStatus ? (Contract::STATUSES[$newStatus] ?? '') : '' }}</strong>
            </p>
            <x-label value="{{ $newStatus === Contract::STATUS_CANCELLED ? 'Motivo de la cancelación (obligatorio)' : 'Nota (opcional)' }}" class="mb-1" />
            <textarea wire:model="note" rows="3" class="form-control"></textarea>
            <x-input-error for="note" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cancelTransition" class="mr-4">Cancelar</x-secondary-button>
            <x-danger-button wire:click="transition">Confirmar</x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
