<div class="flex justify-between w-full mb-2">

    {{-- ES LA VISTA ARRIBA DEL CALENDARIO(SCHEDULE) --}}

    <div class="flex gap-6 w-1/2">
        <div>
            <h2 class="text-2xl ml-4">{{ $this->startsAt->format('M Y') }}</h2>
        </div>

        <div class="w-1/2">
            {{-- El select esta sincronizado con la propiedad store_id --}}
            <select wire:model.live="store_id" class="form-control w-1/2">
                {{-- Este es el valor por default --}}
                <option value="" selected disabled>Store</option>
                {{-- Valores de la base de datos --}}
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex gap-2">
        <div>
            <x-button wire:click="goToPreviousMonth()">back</x-button>
        </div>
        <div>
            <x-button wire:click="goToNextMonth()">next</x-button>
        </div>
    </div>
</div>
