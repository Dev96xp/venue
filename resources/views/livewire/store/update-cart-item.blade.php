<div class="flex items-center" x-data>
    {{-- a) Por defecto deshabilitado
    b) Que se habilite o deshabilite segun una condicion dada (qty <= 1) --}}
    <x-secondary-button disabled x-bind:disabled="$wire.qty <= 1" wire:loading.attr="disabled" wire:target="decrement"
        wire:click="decrement">
        -
    </x-secondary-button>

    <span class="mx-2 text-gray-700">{{ $qty }}</span>

    <x-secondary-button {{-- x-bind:disabled="$wire.qty >= $wire.quantity"  ORIGINAL --}} x-bind:disabled="$wire.qty >= 10" {{--  *** OJO *** PUSE UN TOPE MAXIMO DE DE 10 PIEZAS PARA ORDENAR, SE PUEDE CAMBIAR --}}
        wire:loading.attr="disabled" wire:target="increment" wire:click="increment">
        +
    </x-secondary-button>
</div>
