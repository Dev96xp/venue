<x-admin-layout>

    <div class="container p-2">
        <button class="text-3xl" id="PrintButton" onclick="PrintPage()">THE PALACE HALL</button>

        <h2 class="text-right text-2xl">Invoice: {{ Str::limit($transaction_id, 12) }}</h2>

        <h2 class="text-left text-md">Client:</h2>
        <h2 class="text-left">{{ $user->name }} - {{ $user->phone }}
        </h2>
        <div class="flex flex-row gap-10">
            <div class="basis-1/4">{{ $user->address }},
                {{ $user->city }}</div>
            <div class="basis-1/4">Store: {{ $user->store->name }}, {{ $user->store->phone }}</div>
            <div class="basis-1/2"></div>
        </div>

        <div class=" w-full border-black border-t-2 border-b-2 py-4">
            <table class="table-fixed text-sm"> {{-- Tamano del texto: (text-md) --}}
                <thead class="border-black border-b-2 py-4">
                    <tr>
                        <th>Model</th>
                        <th>Qty</th>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Payment</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="px-4">{{ $item->sku }}</td>
                            <td class="px-4">{{ $item->qty }}</td>
                            <td class="px-4">{{ $item->name }}</td>
                            <td class="px-4 text-right">{{ number_format($item->price, 2, ',', '.') }}</td>
                            <td class="px-4 text-right">{{ number_format($item->qty * $item->price, 2, ',', '.') }}
                            </td>
                            <td class="px-4 text-right">{{ number_format($item->payment, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

        <br>

        <div class="grid grid-cols-10 gap-4 mb-40">
            <div class="col-span-6">
            </div>
            <div class="col-span-2">
                <h2 class=" text-right">Subtotal: $</h2>
                <h2 class=" text-right">Tax: $</h2>
                <h2 class=" text-right">Total: $</h2>
                <h2 class=" text-right">Payments: $</h2>
                <h2 class=" text-right">Balance: $</h2>
            </div>

            <div class="col-span-2">
                <h2 class="text-right"> {{ number_format($subtotal, 2, ',', '.') }}</h2>
                <h2 class="text-right"> {{ number_format($subtotal * 0.07, 2, ',', '.') }}</h2>
                <h2 class="text-right"> {{ number_format($subtotal * 0.07 + $subtotal, 2, ',', '.') }}</h2>
                <h2 class="text-right"> -{{ number_format($totalpayments, 2, ',', '.') }}</h2>
                <h2 class="text-right"> {{ number_format($balance, 2, ',', '.') }}</h2>
            </div>
            {{-- <div class="col-span-2">
            </div> --}}
        </div>


        <div class="text-sm">
            <p>IMPORTANT</p>
            <p>All sales are final, all the special orders can't be canceled, there is not refounds, please make sure
                that all of your items are in perfect condition before picking them up from the store,
                once the items leave the store return are not accepted, Thanks for shopping with Us !.
            </p>
            <p>Todas las ventas son finales, todas las ordenes speciales NO se puede regresar o cancelar, no hay
                reembolso,
                por favor de revisar la mercancia antes de salir de la tienda, aseguerese que todo esta en buenas
                condiciones, una vez salida la mercanciade
                la tienda NO se aceptan devoluciones, Gracias por comprar con nosotros !.
            </p>
        </div>

        {{-- SECCTION 8 - Footer --}}
        <section class="my-4">
            <hr>
            <p class=" text-sm max-w-7xl mx-auto px-4">THE PALACE is a Trademark with Copyright 2022 THE PALACE Inc.
                DESIGN
                by Nucleus-Technologies Copyright 2021<a class="text-blue-500 font-bold" href="">Terminnos y
                    condiciones</a>
            </p>
        </section>

    </div>

    <script type="text/javascript">
        function PrintPage() {
            window.print();
        }
    </script>

</x-admin-layout>
