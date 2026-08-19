<div>
    <div class="px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-4 items-end">
            <div class="col-span-1">
                <x-label value="Employee" class="mb-1" />
                <select wire:model.live="employee_id" class="form-control w-full">
                    <option value="">Todos</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-1">
                <x-label value="Building" class="mb-1" />
                <select wire:model.live="location" class="form-control w-full">
                    <option value="">Todos</option>
                    @foreach ($locations as $loc)
                        <option value="{{ $loc }}">{{ $loc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-1">
                <x-label value="From" class="mb-1" />
                <x-input type="date" class="w-full" wire:model.live="date_from" />
            </div>

            <div class="col-span-1">
                <x-label value="To" class="mb-1" />
                <x-input type="date" class="w-full" wire:model.live="date_to" />
            </div>
        </div>

        <div class="mb-4">
            <a href="{{ $this->printUrl() }}" target="_blank"
                class="bg-blue-400 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded text-uppercase text-sm">
                Print
            </a>
        </div>

        <x-table-responsive>
            @if ($attendances->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Building</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hours</th>
                            <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($attendances as $attendance)
                            <tr wire:key="attendance-{{ $attendance->id }}">
                                <td class="px-6 py-3 whitespace-nowrap text-sm font-bold text-gray-900">{{ $attendance->employee->name }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $attendance->location }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $attendance->check_in?->format('Y-m-d') }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $attendance->check_in?->format('h:i A') }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">
                                    @if ($attendance->check_out)
                                        {{ $attendance->check_out->format('h:i A') }}
                                    @else
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-amber-100 text-amber-800">
                                            En progreso
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">
                                    @if ($attendance->check_out)
                                        {{ number_format($attendance->check_in->diffInMinutes($attendance->check_out) / 60, 2) }}
                                    @else
                                        &mdash;
                                    @endif
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <span class="text-indigo-600 hover:text-indigo-900 cursor-pointer"
                                        wire:click="editAttendance({{ $attendance->id }})">
                                        Edit
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $attendances->links() }}
                </div>
            @else
                <div class="px-6 py-4">No hay registros de asistencia en este rango</div>
            @endif
        </x-table-responsive>
    </div>

    <x-dialog-modal wire:model="editId">
        <x-slot name="title">
            Corregir salida
        </x-slot>

        <x-slot name="content">
            <x-label value="Check Out" class="mb-1" />
            <x-input type="datetime-local" class="w-full" wire:model.defer="editCheckOut" />
            <x-input-error for="editCheckOut" />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="cancelEdit" class="mr-4">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="saveEdit">
                Guardar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
