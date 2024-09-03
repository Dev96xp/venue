<div class="container py-8 max-w-7xl mx-auto">

    {{-- USO: VENTA DE INVITACIONES 2/4 --}}

    <x-table-responsive>
        <div class="px-6 py-4 bg-white">
            <h1 class="text-lg font-semibold text-gray-700">CARRO DE COMPRA</h1>
        </div>
        {{-- Solo si exuiste algo, en el carrito de compras se mostrara lo que  sigue --}}
        @if (Cart::count())

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cantidad
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>

                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    {{-- Cart::content() - Contiene toda lo informacion de los productos agregados al carrito y
                                        cada uno con sus caracteristicas selecionadas y adicionales --}}
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">

                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover object-center"
                                            src="{{ $item->options->image }}" alt="">
                                    </div>

                                    <div class="ml-4">

                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->options->sku}} - {{ $item->name }}
                                        </div>

                                        <div class="text-sm text-gray-500">

                                            {{-- Hemos almacenado algo en el campo color? --}}
                                            @if ($item->options->color)
                                                <span>
                                                    Color: {{ $item->options->color }}
                                                </span>
                                            @endif

                                            {{-- Hemos almacenado algo en el campo size? --}}
                                            @if ($item->options->size)
                                                <span class="mx-1">-</span>
                                                <span>
                                                    {{ $item->options->size }}
                                                </span>
                                            @endif
                                        </div>

                                        <div>
                                            <span>
                                                Event date: {{ \Carbon\Carbon::parse($item->options->date)->format('l j F') }}
                                            </span>
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            <span class="mr-4">
                                                Waist: {{ $item->options->waist }}
                                            </span>
                                            <span class="mr-4">
                                                Bust: {{ $item->options->bust }}
                                            </span>
                                            <span>
                                                Hip: {{ $item->options->hip }}
                                            </span>

                                        </div>
                                        <div>
                                            {{-- INTENTE ESTE FORMATO 1: ->toFormattedDateString()
                                            INTENTE ESTE OTRO FORMATO 2: {{ Date::now()->addDay($product->subcategory->features()->find(20)->pivot->days)->locale('en')->format('l j F') }} --}}
                                            {{-- INTENTE ESTE FORMATO 3: ->format('d/m/Y')
                                                 INTENTE ESTE FORMATO 4: {{ \Carbon\Carbon::parse($user->from_date)->format('d/m/Y')}}   , SI TRABAJO
                                                 INTENTE ESTE FORMATO 5: {{ \Carbon\Carbon::parse($user->from_date)->format('l j F')}}   , SI TRABAJO --}}

                                            <span>
                                                Aprox. Arrival date:  {{ \Carbon\Carbon::parse($item->options->pickup_date)->format('l j F') }}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </td>


                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="text-sm text-gray-500">
                                    {{-- Precio --}}
                                    <span>USD ${{ $item->price }}</span>

                                    {{-- Borrar el producto --}}
                                    <a class="ml-6 cursor-pointer hover:text-red-600" {{-- OJO - Se envia entre comillas simples,
                                            por que lo q se esta enviando en realizad es una cadena --}}
                                        wire:click="delete( '{{ $item->rowId }}' )" {{-- Miestras se realiza la accion que la case cambie a --}}
                                        wire:loading.class="text-red-600 opacity-25" {{-- Siempre y cuando se este realizando en metodo: delete --}}
                                        wire:target="delete( '{{ $item->rowId }}' )">
                                        <i class="fas fa-trash"></i>

                                    </a>
                                </div>
                            </td>


                            {{-- Botones de Cantidad --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">

                                    {{--  livewire - Actualiza el Shopping Cart, cuando se cambia la cantidad  --}}

                                    @livewire('store.update-cart-item', ['rowId' => $item->rowId],
                                    key($item->rowId))

                                </div>

                            </td>


                            {{-- Cantidad --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="text-sm text-gray-500">
                                    USD $ {{ $item->price * $item->qty }}
                                </div>
                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>


            <div class="px-6 py-4">
                <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" wire:click="destroy">
                    <i class="fa fas-trash"></i>
                    Borrar carrito de compras
                </a>
            </div>

        @else
            <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 mt-4">TU CARRO DE COMPRAS ESTA VACIO</p>

                {{-- href="/" - Apunta hcia el inicio --}}
                <x-button-enlace href="storefront" class="mt-4 px-16">
                    Ir al inicio
                </x-button-enlace>
            </div>
        @endif
    </x-table-responsive>







    {{-- Total --}}
    @if (Cart::count())
        <div class="bg-white rounde-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total:</span>
                        USD $ {{ Cart::subtotal() }}

                    </p>
                </div>
                <div>
                    {{-- <x-button-enlace href="{{ route('sales.orders.create') }}">
                        continuar
                    </x-button-enlace> --}}

                    <div class="text-center">
                        <a href="{{ route('sales.orders.create') }}"><span class="font-bold text-lg text-pink-500">Continuar con la compra</span></a>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
