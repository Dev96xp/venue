<div>

    {{-- Button --}}
    <div>
        <button wire:click="$set('open', true)" type="button"
            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >Edit</button>

    </div>

    <x-dialog-modal wire:model="open" class="py-6">

        <x-slot name='title'>
            Editar Package
        </x-slot>

        <x-slot name='content'>

            {{-- Grid con 3 columnas --}}
            <div class="grid grid-cols-3 gap-4 mb-2">
                <div class="col-span-1">
                    <x-label value="Code" />
                    <x-input wire:model.defer="packageEdit.code" type="text" class="w-full"/>
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="packageEdit.code" />
                </div>

                <div class="col-span-2">
                    <x-label value="Name" />
                    <x-input wire:model.defer="packageEdit.name" type="text" class="w-full"/>
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="packageEdit.name" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-2">
                <div class="col-span-1">
                    <x-label value="Status" />
                    <x-input readonly wire:model.defer="packageEdit.status" type="text" class="w-full"/>
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="packageEdit.status" />
                </div>

                <div class="col-span-2">

                </div>
            </div>

        </x-slot>

        <x-slot name='footer'>
            <div class="flex">

                <div class="mr-10">
                    <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                        Cancel
                    </x-secondary-button>

                    <x-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                        Update
                    </x-danger-button>
                </div>

            </div>
        </x-slot>

    </x-dialog-modal>

    {{-- MASTER CLASS - Para que se ejecute el codigo de javascript de un componente de LIVEWIRE,
        hay que encerrarlo con las directivas de PUSH, @push('script') y que este lo envie a la
        plantilla pricipal, esta lo recibira travez de la directiva @stack('script') y listo  --}}
    @push('script')
        {{-- Nada de codigo de javascript por el momento --}}
    @endpush

</div>
