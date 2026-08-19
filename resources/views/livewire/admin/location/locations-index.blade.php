<div>
    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center sm:justify-between mb-4">
            <div class="w-full sm:max-w-xs">
                <input wire:model.live.debounce.300ms="search" class="form-control shadow-sm"
                    placeholder="Buscar por nombre...">
            </div>

            <div class="mt-4 sm:mt-0">
                @livewire('admin.location.create-location')
            </div>
        </div>

        <x-table-responsive>
            @if ($locations->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coordinates</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Radius (ft)</th>
                            <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($locations as $location)
                            <tr wire:key="location-{{ $location->id }}">
                                <td class="px-6 py-3 whitespace-nowrap text-sm font-bold text-gray-900">{{ $location->name }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">
                                    @if ($location->hasCoordinates())
                                        {{ $location->latitude }}, {{ $location->longitude }}
                                    @else
                                        <span class="text-gray-400">Sin geocerca</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $location->radius_feet }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        @livewire('admin.location.edit-location', ['location' => $location], key('edit-location-'.$location->id))
                                        <span class="text-red-600 hover:text-red-900 cursor-pointer"
                                            wire:click="confirmDelete({{ $location->id }})">
                                            Delete
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $locations->links() }}
                </div>
            @else
                <div class="px-6 py-4">No hay ningún edificio registrado</div>
            @endif
        </x-table-responsive>
    </div>

    <x-confirmation-modal wire:model="deleteId">
        <x-slot name="title">
            Eliminar edificio
        </x-slot>

        <x-slot name="content">
            ¿Estás seguro de eliminar este edificio? Esta acción no se puede deshacer.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cancelDelete" class="mr-4">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="delete">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
