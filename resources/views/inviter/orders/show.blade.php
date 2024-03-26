<x-invitation-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex items-center">
            <p class="text-xl">My Order</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">

            <div class="relative">
                <div
                    class="{{ $order->status >= 1 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Pendiente</p>
                </div>
            </div>

            <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>


            <div class="relative">
                <div
                    class="{{ $order->status >= 2 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Recivido</p>
                </div>
            </div>

            <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>


            <div class="relative">
                <div
                    class="{{ $order->status >= 3 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Enviado</p>
                </div>
            </div>

            <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>


            <div class="relative">
                <div
                    class="{{ $order->status >= 4 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Entregado</p>
                </div>
            </div>
            <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>

            <div class="relative">
                <div
                    class="{{ $order->status >= 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-2 mt-0.5">
                    <p>Cancelado</p>
                </div>
            </div>

        </div>


        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex items-center">
            <p class="text-gray-700 uppercase"><span>Numero de orden:</span> <span class="font-bold" > {{ $order->id }}</span></p>

            {{-- Este boton, solo se mostrara si el status es igual a 1
                indicando que se trata de una orden pendiente de pagar --}}
            @if ($order->status == 1)
                {{-- <x-button-enlace class="ml-auto" href="{{ route('sales.orders.payment', $order) }}">
                    Ir a pagar
                </x-button-enlace> --}}

                <div class="text-center">
                    <a href="{{ route('sales.orders.payment', $order) }}"><span class="font-bold text-lg text-pink-500">Ir a pagar</span></a>
                </div>
            @endif

        </div>


        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p class="text-lg font-semibold uppercase">Envio</p>
                    @if ($order->envio_type == 1)
                        <p class="text-sm">Store Address to pick up:</p>
                        <p class="font-bold">{{ $order->store->name}}</p>
                        <p class="font-bold">{{ $order->store->address}}</p>
                    @else
                        <p class="text-sm">Shipping Address</p>
                        <p class="font-bold">{{ $order->address }}</p>
                        <p>{{ $order->city}}, {{ $order->state->name }} [{{ $order->state->code }}] - {{ $order->district }}
                        <p>{{ $order->zip}}</p>
                        </p>
                    @endif
                </div>


                <div>
                    <p class="text-lg font-semibold uppercase">Datos de Contacto /Contact Name</p>
                    <p class="text-sm">Contact Name: <span class="text-sm font-bold">{{ $order->contact }}</span></p>
                    <p class="text-sm">Contact Phone: <span class="text-sm font-bold">{{ $order->phone }}</span> </p>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-4">Resumen</p>

            {{-- table-auto w-full - Genera distribucion automatica de los campos de la tabla en el espacio --}}
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                        alt="">
                                    <article>
                                        <h1 class="font-bold">{{ $item->options->sku }} - {{ $item->name }}</h1>
                                        <div class="flex text-sm">


                                            {{-- Pregunta si esto: ( $item->options->color ), ha sido definido --}}
                                            @isset($item->options->color)
                                                Color: {{ __($item->options->color) }}
                                            @endisset

                                            @isset($item->options->size)
                                                - {{ __($item->options->size) }}
                                            @endisset

                                        </div>

                                        <div>
                                            @isset($item->options->date)
                                                Event Date: - {{ __($item->options->date) }}
                                            @endisset
                                        </div>

                                        <div class="flex text-sm">
                                            @isset($item->options->bust)
                                                Bust: - {{ __($item->options->bust) }}
                                            @endisset
                                            @isset($item->options->waist)
                                                Waist: - {{ __($item->options->waist) }}
                                            @endisset
                                            @isset($item->options->hip)
                                                Hip: - {{ __($item->options->hip) }}
                                            @endisset

                                        </div>
                                        <div>
                                            <br>
                                            <span>
                                                Aprox. Arrival date:
                                                {{-- {{ \Carbon\Carbon::parse($item->options->pickup_date)->format('l j F') }} --}}
                                            </span>
                                        </div>
                                    </article>
                                </div>
                            </td>
                            <td class="text-center">
                                {{ $item->price }} USD
                            </td>
                            <td class="text-center">
                                {{ $item->qty }}
                            </td>
                            <td class="text-center">
                                {{ $item->price * $item->qty }} USD
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</x-invitation-layout>
