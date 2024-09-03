<div>
    <x-dropdown width="96" align="right">
        <x-slot name="trigger">
            {{-- Para agregarle el numerito de color rojo, se encierra en la siguente span --}}
            {{-- Este SPAN agrega el numero de articulos comprados al logo de carrito --}}
            <span class="relative inline-block cursor-pointer">
                {{-- A este componente se le esta enviando el color y tamaño, paa que cambie --}}
                {{-- El carrito --}}
                <x-cart color="white" size=30/>

                @if (Cart::count())
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{Cart::count()}}</span>

                @else
                <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                @endif


                {{-- Este SPAN agrega el numero de articulos comprados al logo de carrito --}}
                {{-- <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">99</span> --}}

            </span>
        </x-slot>

        <x-slot name="content">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold">{{$item->options->sku}} - {{$item->name}}</h1>

                            <div class="flex">
                                <p>Cant: {{$item->qty}}</p>

                                {{-- SOLO, SI EXISTE UN COLOR LO IMPRIME,SINO LO IGNORA --}}
                                @isset($item->options['color'])
                                    <p class="mx-2">Color: {{$item->options['color']}}</p>
                                @endisset

                                {{-- SOLO, SI EXISTE UN SIZE LO IMPRIME,SINO LO IGNORA --}}
                                @isset($item->options['size'])
                                    <p>Size: {{$item->options['size']}}</p>
                                @endisset

                            </div>


                            <p>USD $ {{$item->price}}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No hay ningun item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            {{-- Subtotal --}}
            @if (Cart::count())
                <div class="py-2 px-3">
                    <p class="text-lg text-gray-700 mt-2 mb-3"><span class="font-bold">Total:</span> USD $ {{Cart::subtotal()}}</p>

                    {{-- Botton para ir al carrito de compras
                    <x-button-enlace href="{{route('shopping-cart')}}" color="blue" class="w-full">
                        Ir al Carrito de Compras
                    </x-button-enlace> --}}

                    <div class="text-center">
                        <a href="{{ route('shopping-cart') }}"><span class="font-bold text-lg text-pink-500">Ir al Carrito de
                                Compras</span></a>
                    </div>

                </div>
            @endif
        </x-slot>

    </x-dropdown>
</div>
