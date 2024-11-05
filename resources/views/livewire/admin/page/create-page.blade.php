<div>
    {{-- Button --}}
    <div>
        {{-- <x-danger-button wire:click="$set('open', true)">
            Create page
        </x-danger-button> --}}
        <button wire:click="$set('open', true)" type="button"
            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >Create page</button>

    </div>


    {{-- Modal --}}
    <x-dialog-modal wire:model="open" maxWidth="2xl">
        <x-slot name="title">
            Create page
            {{-- {{ $section->name }} --}}
        </x-slot>

        <x-slot name="content">

            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Page Name" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model="name"
                        id="" />
                    <x-input-error for="name" />
                </div>

                <div class="col-span-1">
                    <x-label value="Route" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model="route"
                        id="" />
                    <x-input-error for="route" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Description" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model="description"
                        id="" />
                    <x-input-error for="description" />
                </div>

                <div class="col-span-1">
                    <x-label value="Status" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model="status"
                        id="" />
                    <x-input-error for="status" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3">
                <div class="col-span-1">
                    <x-label value="Active" class="mb-1" />
                    <x-input type="text" class="w-full" wire:model="active"
                        id="" />
                    <x-input-error for="active" />
                </div>

                <div class="col-span-1">

                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="create_page">
                Create
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>


    {{-- MASTER CLASS - Para que se ejecute el codigo de javascript de un componente de LIVEWIRE,
        hay que encerrarlo con las directivas de PUSH, @push('script') y que este lo envie a la
        plantilla pricipal, esta lo recibira travez de la directiva @stack('script') y listo  --}}
    @push('script')
        {{-- Nada de codigo de javascript por el momento --}}
    @endpush

</div>
