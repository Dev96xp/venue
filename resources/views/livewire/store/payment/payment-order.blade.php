<div class="py-8 max-w-7xl mx-auto"> {{-- CENTRADO --}}

    {{-- USO: VENTA DE INVITACIONES 4/4 --}}
    {{-- USO: PAGINA DONDE SE EJECUTA EL PAGO --}}

    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-5 gap-6 container py-8">

        <div class="order-2 lg:order-1 xl:col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase"><span>Numero de orden / Order Number:</span> {{ $order->id }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg font-semibold uppercase">Envio</p>
                        @if ($order->envio_type == 1)
                            <p class="text-sm">Store Address to pick up:</p>
                            <p class="text-sm font-bold">{{ $order->store->name }}</p>
                            <p class="text-sm font-bold">{{ $order->store->address }}</p>
                        @else
                            <p class="text-sm">Shipping Address</p>
                            <p class="font-bold">{{ $order->address }}</p>
                            <p>{{ $order->city }}, {{ $order->state->name }} [{{ $order->state->code }}] -
                                {{ $order->district }}</p>
                            <p>{{ $order->zip }}</p>
                        @endif
                    </div>

                    <div>
                        <p class="text-lg font-semibold uppercase">Datos de Contacto /Contact Name</p>
                        <p class="text-sm">Contact Name: <span class="text-sm font-bold">{{ $order->contact }}</span>
                        </p>
                        <p class="text-sm">Contact Phone: <span class="text-sm font-bold">{{ $order->phone }}</span>
                        </p>
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
                                    <div class="flex mb-4">
                                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                            alt="">
                                        <article>
                                            <h1 class="font-bold">{{ $item->options->sku }} - {{ $item->name }}</h1>
                                            <div class="flex">


                                                {{-- Pregunta si esto: ( $item->options->color ), ha sido definido --}}
                                                @isset($item->options->color)
                                                    Color: <p class="font-bold"> {{ __($item->options->color) }}</p>
                                                @endisset

                                                @isset($item->options->size)
                                                    <p class="font-bold"> - {{ __($item->options->size) }}</p>
                                                @endisset

                                            </div>

                                            <div>
                                                @isset($item->options->date)
                                                    <p> Event Date: <span class="font-bold">
                                                            {{ \Carbon\Carbon::parse($item->options->date)->format('l j F') }}</span>
                                                    </p>
                                                @endisset
                                            </div>

                                            <div>
                                                @isset($item->options->bust)
                                                    <p> Bust: <span class="font-bold">{{ __($item->options->bust) }}</span>
                                                    </p>
                                                @endisset
                                                @isset($item->options->waist)
                                                    <p> Waist: <span
                                                            class="font-bold">{{ __($item->options->waist) }}</span></p>
                                                @endisset
                                                @isset($item->options->hip)
                                                    <p> Hip: <span class="font-bold"> {{ __($item->options->hip) }}</span>
                                                    </p>
                                                @endisset

                                            </div>
                                            <div>
                                                <br>
                                                <span>
                                                    Aprox. Arrival date:
                                                    {{-- <span class="font-bold"> {{ \Carbon\Carbon::parse($item->options->pickup_date)->format('l j F') }}</span> --}}
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


        <div class="order-1 lg:order-2 xl:col-span-2">

            <div class="bg-white rounded-lg shadow-lg px-6 pt-6">
                <div class="flex justify-between items-center mb-6">
                    <img class="h-8" src="{{ asset('img/cards.jpg') }}" alt="">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: $ {{ $order->total - $order->shipping_cost }} USD
                        </p>
                        <p class="text-sm font-semibold">
                            Envio: $ {{ $order->shipping_cost }} USD
                        </p>
                        <p class="text-lg font-semibold uppercase">
                            Pago: $ {{ $order->total }} USD
                        </p>

                    </div>
                </div>

                {{-- PAYPAL PASO #2  Add button --}}
                <!-- Set up a container element for the button -->
                <div id="paypal-button-container"></div>

            </div>
        </div>
    </div>




    {{-- MASTER CLASS - Para que se ejecute el codigo de javascript de un componente de LIVEWIRE,
        hay que encerrarlo con las directivas de PUSH, @push('script') y que este lo envie a la
        plantilla pricipal, esta lo recibira travez de la directiva @stack('script') y listo  --}}

    @push('script')
        {{-- PAYPAL PASO #1  Add link
            1. Usamos el metodo config para hacer que lea el archivo services y obtenga el client_id --}}

        {{-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script> ORIGINAL --}}
        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}"></script>


        {{-- PAYPAL PASO #3  Add Script --}}
        <script>
            paypal.Buttons({

                // Sets up the transaction when a payment button is clicked
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {

                                // -- PAYPAL PASO #4  Add the Amounto to charge, esta almacenado en la variable $order --//

                                // value: '77.44' // ORIGINAL - Can reference variables or functions. Example: `value: document.getElementById('...').value`
                                value: "{{ $order->total }}" // NEW - Can reference variables or functions. Example: `value: document.getElementById('...').value`
                            }
                        }]
                    });
                },

                // -- PAYPAL PASO #5 - Finalize the transaction after payer approval,
                //    despues de la aprovacion ejecutas un dispatch, para el componente de livewire
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        // ORIGINAL - Successful capture! For dev/demo purposes:(para pruebas)
                        // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        // var transaction = orderData.purchase_units[0].payments.captures[0];
                        // alert('Transaction ' + transaction.status + ': ' + transaction.id +
                        //     '\n\nSee console for all available details');

                        // NUEVO 2024
                        Livewire.dispatch('pay-order');

                        // Listo la parte de Paypal, aqui termina

                    });
                },
            }).render('#paypal-button-container'); // Esto hace referencia al button
        </script>
    @endpush
</div>
