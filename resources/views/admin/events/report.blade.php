<x-admin-layout>

    <div class="container p-2">
        <button class="text-3xl" id="PrintButton" onclick="PrintPage()">THE PALACE HALL</button>

        <h2 class="text-right text-2xl">Evento: {{ Str::limit($event->id, 12) }} /
            <span class="font-bold">{{ \Carbon\Carbon::parse($event->scheduled_at)->toFormattedDateString('l j F') }}</span>
        </h2>

        <h2 class="text-left"><span class="font-bold text-xl">{{ $event->user->name }}</span> - {{ $event->user->phone }}
        </h2>
        <div class="flex flex-row gap-10">
            <div class="basis-1/4">{{ $event->user->address }},
                {{ $event->user->city }}</div>
            <div class="basis-1/4">Location: {{ $user->store->name }}, {{ $user->store->phone }}</div>
            <div class="basis-1/2"></div>
        </div>

        {{-- Salon --}}
        <h2 class="text-left text-xl font-bold">Salon: {{ $event->venue->name }}</h2>
        <div class=" w-full border-black border-t-2 border-b-2 py-4">
            <table class="table-fixed text-sm"> {{-- Tamano del texto: (text-md) --}}
                <thead class="border-black border-b-2 py-4">
                    <tr>
                        <th>Items</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venue->items_venues as $item)
                        <tr>
                            <td class="px-4">{{ $item->name }}</td>
                            <td class="px-4">{{ $item->description }}</td>
                            <td class="px-4">{{ $item->status_items_venue->name }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

        {{-- Drink --}}
        <h2 class="text-left text-xl font-bold">Bebida: {{ $event->drink->name }}</h2>
        <div class=" w-full border-black border-t-2 border-b-2 py-4">
            <table class="table-fixed text-sm">
                <thead class="border-black border-b-2 py-4">
                    <tr>
                        <th>Items</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drink->items_drinks as $item)
                        <tr>
                            <td class="px-4">{{ $item->name }}</td>
                            <td class="px-4">{{ $item->description }}</td>
                            <td class="px-4">{{ $item->status_items->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Personal --}}
        <h2 class="text-left text-xl font-bold">Personal: {{ $event->personal->name }}</h2>
        <div class=" w-full border-black border-t-2 border-b-2 py-4">
            <table class="table-fixed text-sm">
                <thead class="border-black border-b-2 py-4">
                    <tr>
                        <th>Items</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personal->items_personals as $item)
                        <tr>
                            <td class="px-4">{{ $item->name }}</td>
                            <td class="px-4">{{ $item->description }}</td>
                            <td class="px-4">{{ $item->status_items->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Decoration --}}
        <h2 class="text-left text-xl font-bold">Decoration: {{ $event->decoration->name }}</h2>
        <div class=" w-full border-black border-t-2 border-b-2 py-4">
            <table class="table-fixed text-sm">
                <thead class="border-black border-b-2 py-4">
                    <tr>
                        <th>Items</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($decoration->items_decorations as $item)
                        <tr>
                            <td class="px-4">{{ $item->name }}</td>
                            <td class="px-4">{{ $item->description }}</td>
                            <td class="px-4">{{ $item->status_items->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Limpieza - Cleaning --}}
        <h2 class="text-left text-xl font-bold">Limpieza: {{ $event->cleaning->name }}</h2>
        <div class=" w-full border-black border-t-2 border-b-2 py-4">
            <table class="table-fixed text-sm">
                <thead class="border-black border-b-2 py-4">
                    <tr>
                        <th>Items</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cleaning->items_cleanings as $item)
                        <tr>
                            <td class="px-4">{{ $item->name }}</td>
                            <td class="px-4">{{ $item->description }}</td>
                            <td class="px-4">{{ $item->status_items->name }}</td>
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
