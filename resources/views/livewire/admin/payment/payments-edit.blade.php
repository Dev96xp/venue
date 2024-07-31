<div>

    <div class="flex items-center">

        <div class="mr-2">

            {{-- ESTOS 2 BOTONES ESTAN HUBICADOS EN LA LISTA --}}
            <div class="flex">
                <div>
                    {{-- @can('Ids edit') --}}
                        <x-button wire:click="$set('open', true)">
                            Edit
                        </x-button>
                    {{-- @endcan --}}
                </div>
                <div>
                    {{-- SI TRABAJA PERO LO VOY A MANTENER DESHABILITADO --}}
                    {{-- Metodo contenido en: (EditPermission) livewire component --}}
                    @can('Ids delete')
                        {{-- <x-danger-button wire:click="delete({{ $idex->id }})">
                            x
                        </x-danger-button> --}}
                    @endcan
                </div>
            </div>
        </div>

    </div>


    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            EDIT PAYMENTS
        </x-slot>

        <x-slot name="content">

            {{-- Grid con 3 columnas --}}
            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-2 mb-4">
                    <x-label value="ID" />
                    <x-input wire:model="paymentEdit.id" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="paymentEdit.id" />
                </div>

                <div class="col-span-2 mb-4">
                    <x-label value="CODE" />
                    <x-input wire:model="paymentEdit.code" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="paymentEdit.code" />
                </div>

            </div>

            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-2 mb-4">
                    <x-label value="Name" />
                    <x-input wire:model="paymentEdit.name" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="paymentEdit.name" />
                </div>

                <div class="col-span-2 mb-4">
                    <x-label value="Type" />
                    <x-input wire:model="paymentEdit.signo" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="paymentEdit.signo" />
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            @switch($botton_type)
                @case('nada')
                    {{-- nada --}}
                @break

                @case('create')
                    <x-danger-button wire:click="save">
                        Create Payment
                    </x-danger-button>
                @break

                @case('edit')
                    <x-danger-button wire:click="update">
                        Update Payment
                    </x-danger-button>
                @break

                @default
            @endswitch
        </x-slot>

    </x-dialog-modal>
</div>
