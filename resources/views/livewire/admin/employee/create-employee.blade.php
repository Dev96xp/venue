<div>
    <div>
        <x-danger-button wire:click="$set('open', true)">
            Create employee
        </x-danger-button>
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Create employee
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Name" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="name" />
                    <x-input-error for="name" />
                </div>
                <div class="col-span-1">
                    <x-label value="Email" class="mb-1" />
                    <x-input type="email" class="w-full" wire:model.defer="email" />
                    <x-input-error for="email" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Password" class="mb-1" />
                    <x-input type="password" class="w-full" wire:model.defer="password" />
                    <x-input-error for="password" />
                </div>
                <div class="col-span-1">
                    <x-label value="Role" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model.defer="role" />
                    <x-input-error for="role" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Salary" class="mb-1" />
                    <x-input type="number" step="0.01" class="w-full" wire:model.defer="salary" />
                    <x-input-error for="salary" />
                </div>
                <div class="col-span-1">
                    <x-label value="Salary Period" class="mb-1" />
                    <select wire:model.defer="salary_period" class="form-control w-full">
                        <option value="">-- Select --</option>
                        @foreach (\App\Models\Employee::SALARY_PERIODS as $period)
                            <option value="{{ $period }}">{{ ucfirst($period) }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="salary_period" />
                </div>
                <div class="col-span-1">
                    <x-label value="Status" class="mb-1" />
                    <select wire:model.defer="status" class="form-control w-full">
                        @foreach (\App\Models\Employee::STATUSES as $statusOption)
                            <option value="{{ $statusOption }}">{{ ucfirst($statusOption) }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="status" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="save">
                Create
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
