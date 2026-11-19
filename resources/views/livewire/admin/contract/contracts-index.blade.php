<div class="contracts-module">
    <div class="px-4 sm:px-6 lg:px-8">

        {{-- Resumen por estado --}}
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach (\App\Models\Contract::STATUSES as $key => $label)
                <button type="button" wire:click="$set('status', '{{ $status === $key ? '' : $key }}')"
                    class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-medium border
                        {{ \App\Models\Contract::badgeClass($key) }} {{ $status === $key ? 'ring-2 ring-offset-1 ring-gray-500' : 'border-transparent' }}">
                    {{ $label }} <span class="font-bold">{{ $counts[$key] ?? 0 }}</span>
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
            <input wire:model.live.debounce.300ms="search" class="form-control shadow-sm md:col-span-2"
                placeholder="Buscar por código, cliente, email o teléfono...">

            <select wire:model.live="period" class="form-control">
                <option value="upcoming">Eventos próximos</option>
                <option value="past">Eventos pasados</option>
                <option value="all">Todas las fechas</option>
            </select>

            <select wire:model.live="view" class="form-control">
                <option value="current">Contratos vigentes</option>
                <option value="archived">Archivados</option>
                <option value="all">Todos</option>
            </select>
        </div>

        <div class="flex justify-end gap-2 mb-4">
            <a href="{{ route('admin.contracts.templates') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-file-alt"></i> Plantillas
            </a>
            <a href="{{ route('admin.contracts.create') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-plus"></i> Nuevo contrato
            </a>
        </div>

        <x-table-responsive>
            @if ($contracts->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Event</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($contracts as $contract)
                            <tr wire:key="contract-{{ $contract->id }}">
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    <a href="{{ route('admin.contracts.show', $contract) }}" class="font-bold text-indigo-600">
                                        {{ $contract->code }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="font-bold text-gray-900">{{ $contract->client_name }}</div>
                                    <div class="text-gray-500">{{ $contract->client_phone }}</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    {{ $contract->event_type }}
                                    <div class="text-gray-500">{{ $contract->guest_count }} guests</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    {{ $contract->event_date->format('M j, Y') }}
                                    <div class="text-gray-500">
                                        {{ \Carbon\Carbon::parse($contract->start_time)->format('g:i A') }} -
                                        {{ \Carbon\Carbon::parse($contract->end_time)->format('g:i A') }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    ${{ number_format($contract->rental_fee, 2) }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ \App\Models\Contract::badgeClass($contract->status) }}">
                                        {{ $contract->statusLabel() }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.contracts.show', $contract) }}" class="text-indigo-600">Ver</a>
                                        <a href="{{ route('admin.contracts.pdf', $contract) }}" target="_blank" class="text-gray-600">PDF</a>
                                        @if ($contract->isEditable())
                                            <a href="{{ route('admin.contracts.edit', $contract) }}" class="text-blue-600">Editar</a>
                                            <span class="text-red-600 cursor-pointer" wire:click="confirmDelete({{ $contract->id }})">Borrar</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $contracts->links() }}
                </div>
            @else
                <div class="px-6 py-4">No hay contratos con estos filtros.</div>
            @endif
        </x-table-responsive>
    </div>

    <x-confirmation-modal wire:model="deleteId">
        <x-slot name="title">Borrar contrato</x-slot>
        <x-slot name="content">
            ¿Seguro que quieres borrar este borrador? Esta acción no se puede deshacer.
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="cancelDelete" class="mr-4">Cancelar</x-secondary-button>
            <x-danger-button wire:click="delete">Borrar</x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
