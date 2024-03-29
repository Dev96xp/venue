<x-invitation-layout>
    <div class="container py-8 max-w-7xl mx-auto">

        <section class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex items-center">
            <p class="text-xl">My Orders</p>
        </section>

        <section class="grid lg:grid-cols-5 gap-6 text-white">

            <a href="{{route('sales.orders.index') . "?status=1"}}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">{{ $pendiente}}</p>
                <p class="uppercase text-center">Pendiente</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-business-time"></i>
                </p>
            </a>

            <a href="{{route('sales.orders.index') . "?status=2"}}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">{{ $recibido }}</p>
                <p class="uppercase text-center">Recivido</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{route('sales.orders.index') . "?status=3"}}" class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">{{ $enviado }}</p>
                <p class="uppercase text-center">Enviado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{route('sales.orders.index') . "?status=4"}}" class="bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">{{ $entregado }}</p>
                <p class="uppercase text-center">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{route('sales.orders.index') . "?status=5"}}" class="bg-pink-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">{{ $cancelado }}</p>
                <p class="uppercase text-center">Cancelado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>

        </section>


        @if ($orders->count())
            <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <h1 class="text-2xl mb-4">Pedidos recientes</h1>

                <ul>
                    @foreach ($orders as $order)
                        <li class="">
                            <a class=" flex items-center py-2 px-4 hover:bg-gray-100"
                            href="{{route('sales.orders.show',$order)}}">
                            <span class="w-12 text-center">
                                @switch($order->status)
                                    @case(1)
                                        <i class="fas fa-business-time text-red-500 opacity-50"></i>
                                    @break
                                    @case(2)
                                        <i class="fas fa-credit-card text-gray-500 opacity-50"></i>
                                    @break
                                    @case(3)
                                        <i class="fas fa-truck text-yellow-500 opacity-50"></i>
                                    @break
                                    @case(4)
                                        <i class="fas fa-check-circle text-pink-500 opacity-50"></i>
                                    @break
                                    @case(5)
                                        <i class="fas fa-business-circle text-green-500 opacity-50"></i>
                                    @break

                                    @default

                                @endswitch
                            </span>

                            <span>
                                Order: {{ $order->id }}
                                <br>
                                {{ $order->created_at->format('d/m/Y') }}
                            </span>


                            <div class="ml-auto font-bold">
                                <span class="font-bold">
                                    @switch($order->status)
                                        @case(1)
                                            Pendiente
                                        @break
                                        @case(2)
                                            Recibido
                                        @break
                                        @case(3)
                                            Enviado
                                        @break
                                        @case(4)
                                            Entregado
                                        @break
                                        @case(5)
                                            Cancelado
                                        @break

                                        @default

                                    @endswitch
                                </span>

                                <br>

                                <span class="text-sm">
                                    {{$order->total}} USD
                                </span>
                            </div>

                            <span>
                                <i class="fas fa-angle-right ml-6"></i>
                            </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @else
            <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <span class="font-bold text-lg">
                    No existe registro de ordenes
                </span>
            </div>
        @endif

    </div>
</x-invitation-layout>
