<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->


{{-- USO: Muestra una lista de productos en pantalla para su venta POR PRIMERA VEZ --}}

<div class="bg-white">
    <div class="mx-auto max-w-7xl overflow-hidden px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">

            @if ($products->count())
                @foreach ($products as $product)
                    {{-- Apunta una ruta controlada por un componente de livewire directamente, para
                    mostrar mas detalle sobre especifico producto --}}
                    <a href="{{ route('product-overview', $product) }}" class="group text-sm">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                            <img src="{{ Storage::url($product->images->first()->url) }}"
                                alt="White fabric pouch with white zipper, black zipper pull, and black elastic loop."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <h3 class="mt-4 font-medium text-gray-900">{{ $product->name }}</h3>
                        <p class="italic text-gray-500">White and Black</p>
                        <p class="mt-2 font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>

                        <button
                            class="w-full mt-2 items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200"
                            wire:click="addItem('{{ $product->id }}')" {{-- Miestra se este realizando un proceso, quiero cambiar el atributo a: desahibilitado --}}
                            wire:loading.attr="disabled" {{-- Pero que esto SOLO ocurra cuando se este realizando el metodo: addItem --}} wire:target="addItem">
                            Add to bag
                        </button>

                    </a>
                @endforeach
                <!-- More products... -->
            @else
            @endif

        </div>
    </div>
</div>
