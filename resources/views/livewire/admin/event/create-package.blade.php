<div>
    {{-- NOTA: Este componente de livewire,
    contiene algunos componente de jetstream --}}

    {{-- wire:click="$set('open', true) - Manda decir que se fije el valor igual a : true,
    a la propiedad de llamada: open ,que vive en el componente --}}


    <div class="flex items-center">

        <div class="mr-4">
            <button wire:click="$set('open', true)"
                class="bg-blue-400 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded text-uppercase text-sm">
                Create package
            </button>


        </div>

    </div>


    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            CREATE A PACKAGE
        </x-slot>

        <x-slot name="content">

            {{-- Grid con 3 columnas --}}
            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-2 mb-4">
                    <x-label value="Code" />
                    <x-input wire:model.defer="code" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="code" />
                </div>

                <div class="col-span-2 mb-4">
                    <x-label value="Name" />
                    <x-input wire:model.defer="name" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="name" />
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            @switch($botton_type)
                @case('nada')
                    {{-- nada --}}
                @break

                @case('create')
                    <x-danger-button wire:click="save">
                        Create Package
                    </x-danger-button>
                @break

                @case('edit')
                    {{-- nada --}}
                @break

                @default
            @endswitch
        </x-slot>

    </x-dialog-modal>
</div>
