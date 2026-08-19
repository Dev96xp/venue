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
            @if (count($rows))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hours</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($rows as $row)
                            <tr wire:key="payroll-{{ $row['employee']->id }}">
                                <td class="px-6 py-3 whitespace-nowrap text-sm font-bold text-gray-900">{{ $row['employee']->name }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $row['employee']->salary_period ?? '—' }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">{{ $row['hours'] }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700">${{ number_format($row['amount'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right font-bold">Total</td>
                            <td class="px-6 py-3 font-bold">${{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <div class="px-6 py-4">No hay empleados con asistencia en este rango</div>
            @endif
        </x-table-responsive>
    </div>
</div>
