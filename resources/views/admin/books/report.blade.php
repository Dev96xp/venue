<x-admin-layout>

    <div class="container p-2">
        <button class="text-3xl" id="PrintButton" onclick="PrintPage()">THE PALACE HALL</button>

        <h2 class="text-right text-2xl">Report:</h2>

        @switch($radio_select)
            @case(1)
                {{-- $date->format('g:i a l jS F Y');    // 3:45 pm Friday 16th March 2018 --}}
                <h2 class="text-left text-md">Date 1: {{ \Carbon\Carbon::parse($date1)->format('l jS F Y') }}</h2>
            @break

            @case(2)
                {{-- $date->format('g:i a l jS F Y');    // 3:45 pm Friday 16th March 2018 --}}
                <h2 class="text-left text-md">Date 1: {{ \Carbon\Carbon::parse($date1)->format('l jS F Y') }}</h2>
                <h2 class="text-left text-md">Date 2: {{ \Carbon\Carbon::parse($date2)->format('l jS F Y') }}</h2>
            @break

            @default
        @endswitch

        <br>
        {{-- <h2 class="text-left text-md">Date 2: {{ \Carbon\Carbon::parse($date2)->toFormattedDateString('l j F') }}</h2> --}}

        <div class="flex flex-row gap-10">
            <div class="basis-1/4">Store: {{ $store->name }}, {{ $store->phone }}</div>
            <div class="basis-1/4">{{ $store->address }}, {{ $store->city }}</div>
            <div class="basis-1/2"></div>
        </div>

        <div class=" w-full border-black border-t-2 border-b-2 py-4">


            <table class="table table-striped text-sm">
                <thead class="border-black border-b-2 py-4">
                    <tr>
                        <th>Factura</th>
                        <th>Cliente</th>
                        <th>Description</th>
                        <th class="text-right">Payment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td class="font-bold px-4">
                                {{ $sale->transaction->id }}
                            </td>

                            <td class="font-bold px-4">{{ $sale->transaction->account->user->phone }} -
                                {{ $sale->transaction->account->user->name }}</td>
                            <td>
                                @switch($sale->status)
                                    @case(3)
                                        <div class="px-4 text-bold">{{ $sale->name }} / {{ $sale->transaction->city }}</div>
                                    @break

                                    @case(4)
                                        <div class="px-4 line-through">{{ $sale->name }} / {{ $sale->transaction->city }}
                                        </div>
                                    @break

                                    @default
                                @endswitch

                            </td>

                            <td class="font-bold px-4">
                                @switch($sale->status)
                                    @case(3)
                                        <div class="px-4 text-right text-bold">$
                                            {{ number_format($sale->payment, 2, ',', '.') }}</div>
                                    @break

                                    @case(4)
                                        <div class="px-4 text-right line-through">$
                                            {{ number_format($sale->payment, 2, ',', '.') }}</div>
                                    @break

                                    @default
                                @endswitch


                            </td>

                            <td class="font-bold px-4">{{ $sale->created_at }}</td>
                            <td>
                                @switch($sale->status)
                                    @case(3)
                                        <div class="px-4 text-right text-bold"></div>
                                    @break

                                    @case(4)
                                        <div class="px-4 text-right text-bold">Cancelado by </div>
                                    @break

                                    @default
                                @endswitch
                            </td>

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
                <h2 class=" text-right">Subtotal CASH: $</h2>
                <h2 class=" text-right">Subtotal VISA: $</h2>
                <h2 class=" text-right">Subtotal CHECK: $</h2>
                <h2 class=" text-right">Subtotal Credict C: $</h2>
                <h2 class=" text-right">Subtotal Sp. Discount: $</h2>
            </div>

            <div class="col-span-2">
                <h2 class="text-right"> {{ number_format($subtotal_cash, 2, ',', '.') }}</h2>
                <h2 class="text-right"> {{ number_format($subtotal_visa, 2, ',', '.') }}</h2>
                <h2 class="text-right"> {{ number_format($subtotal_check, 2, ',', '.') }}</h2>
                <h2 class="text-right"> {{ number_format($subtotal_credict_card, 2, ',', '.') }}</h2>
                <h2 class="text-right"> {{ number_format($subtotal_special_discount, 2, ',', '.') }}</h2>
            </div>

        </div>

    </div>

    <script type="text/javascript">
        function PrintPage() {
            window.print();
        }
    </script>

</x-admin-layout>
