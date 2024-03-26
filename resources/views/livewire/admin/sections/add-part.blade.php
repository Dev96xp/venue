<div>
    {{-- Button --}}
    <div class="flex items-center gap-6">
        <h1 class="flex-1"></h1>

        <x-danger-button wire:click="$set('open', true)" class="mb-2 mt-2">
            Add new part
        </x-danger-button>
    </div>


    {{-- Modal --}}
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Add new part to :
            {{ $section->name }}
        </x-slot>

        <x-slot name="content">

            {{-- defer - Evita que se renderice la vista cada vez que cambie al valor de la propiedad (wire:model.defer="content")  --}}
            <div class="mb-4">
                <x-label value="Name de la parte" />
                <x-input type="text" class="w-full" wire:model.defer="name" />
                {{ $name }}
            </div>


            {{-- defer - Evita que se renderice la vista cada vez que cambie al valor de la propiedad (wire:model.defer="content")  --}}
            <div class="mb-4">
                <x-label value="Description" />
                <textarea wire:model.defer="description" class="form-control" rows="6"></textarea>
            </div>
            {{ $description }}
        </x-slot>



        <x-slot name="footer">
            <x-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="save">
                Add part
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>

</div>
