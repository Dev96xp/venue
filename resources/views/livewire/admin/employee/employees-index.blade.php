<div>
    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center sm:justify-between mb-4">
            <div class="w-full sm:max-w-xs">
                <input wire:model.live.debounce.300ms="search" class="form-control shadow-sm"
                    placeholder="Buscar por nombre, email o código...">
            </div>

            <div class="mt-4 sm:mt-0">
                @livewire('admin.employee.create-employee')
            </div>
        </div>

        <x-table-responsive>
            @if ($employees->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($employees as $employee)
                            <tr wire:key="employee-{{ $employee->id }}">
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">
                                    <span x-data="{ code: '{{ $employee->employee_code }}' }">
                                        <span x-text="code"></span>
                                        <button type="button" title="Copiar"
                                            @click="navigator.clipboard.writeText(code)"
                                            class="ml-1 text-gray-400 hover:text-gray-700">
                                            &#128203;
                                        </button>
                                    </span>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm font-bold text-gray-900">{{ $employee->name }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $employee->email }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $employee->role }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">
                                    @if ($employee->salary)
                                        ${{ number_format($employee->salary, 2) }} / {{ $employee->salary_period }}
                                    @endif
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm">
                                    @php
                                        $badgeClass = match ($employee->status) {
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-gray-100 text-gray-800',
                                            'vacation' => 'bg-blue-100 text-blue-800',
                                            'suspended' => 'bg-amber-100 text-amber-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $badgeClass }}">
                                        {{ ucfirst($employee->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        @livewire('admin.employee.edit-employee', ['employee' => $employee], key('edit-employee-'.$employee->id))
                                        <span class="text-red-600 hover:text-red-900 cursor-pointer"
                                            wire:click="confirmDelete({{ $employee->id }})">
                                            Delete
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $employees->links() }}
                </div>
            @else
                <div class="px-6 py-4">No hay ningún empleado registrado</div>
            @endif
        </x-table-responsive>
    </div>

    <x-confirmation-modal wire:model="deleteId">
        <x-slot name="title">
            Eliminar empleado
        </x-slot>

        <x-slot name="content">
            ¿Estás seguro de eliminar este empleado? Esta acción no se puede deshacer.
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
