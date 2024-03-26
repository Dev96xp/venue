<div>
    {{-- Button --}}
    <x-danger-button wire:click="$set('openx', true)">
        Edir part
    </x-danger-button>

    {{-- Modal --}}
    <x-dialog-modal wire:model="openx">
        <x-slot name="title">
            Edit :
            {{ $part->name }}
        </x-slot>

        <x-slot name="content">

            {{-- defer - Evita que se renderice la vista cada vez que cambie al valor de la propiedad (wire:model.defer="content")  --}}
            <div class="mb-4">
                <x-label value="Name de la parte" />
                <x-input wire:model="partsEdit.name" type="text" class="w-full"/>
                <x-input-error for="partsEdit.name"/>

            </div>

            <div class="mb-4">
                <x-label value="Description" />
                <textarea wire:model="partsEdit.description" class="form-control" rows="6"></textarea>
                <x-input-error for="partsEdit.description"/>
            </div>

        </x-slot>



        <x-slot name="footer">
            <x-secondary-button class="mr-4" wire:click="$set('openx', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="update">
                Update part
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>
</div>
