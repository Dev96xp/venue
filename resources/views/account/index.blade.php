<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:pb-24">
            <div class="max-w-xl">
                <h1 class="text-2xl font-bold tracking-tight text-gray-700 sm:text-3xl">My Account - Order history</h1>
                <h1 class="text-gray-500">XXXX-XXXX-{{ substr($account->acc_id, -4) }} {{ auth()->user()->name }}</h1>

                <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, manage returns, and download
                    invoices.</p>
            </div>

            <div class="mt-16">
                <h2 class="sr-only">Recent orders</h2>

                <div class="space-y-20">
                    <div>
                        <h3 class="sr-only">Order placed on <time datetime="2021-01-22">January 22, 2021</time></h3>
                        @foreach ($account->transactions as $transaction)
                            <div
                                class="rounded-lg mt-10 bg-gray-200 px-4 py-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 sm:px-6 lg:space-x-8">
                                <dl
                                    class="flex-auto space-y-6 divide-y divide-gray-200 text-sm text-gray-600 sm:grid sm:grid-cols-4 sm:gap-x-6 sm:space-y-0 sm:divide-y-0 lg:w-1/2 lg:flex-none lg:gap-x-8">

                                    <div class="flex justify-between sm:block">
                                        <dt class="font-medium text-gray-900">Date placed</dt>
                                        <dd class="sm:mt-1">
                                            <time
                                                datetime="2021-01-22">{{ \Carbon\Carbon::parse($transaction->created_at)->toFormattedDateString('l j F') }}</time>
                                        </dd>
                                    </div>

                                    <div class="flex justify-between pt-0 font-medium text-gray-900 sm:block sm:pt-0">
                                        <dt>Total amount</dt>
                                        <dd class="sm:mt-1">
                                            @php
                                                $total = 0;
                                                $payments = 0;
                                            @endphp
                                            @foreach ($transaction->items as $item)
                                                @php
                                                    if ($item->status == 3) {
                                                        $total = $total + $item->price;
                                                        $payments = $payments + $item->payment;
                                                    }
                                                @endphp
                                            @endforeach
                                            $ {{ number_format($total, 2) }}
                                        </dd>
                                    </div>

                                    <div class="flex justify-between pt-0 sm:block sm:pt-0">
                                        <dt class="font-medium text-gray-900">Payments</dt>
                                        <dd class="sm:mt-1 font-bold text-purple-500">$
                                            {{ number_format($payments, 2) }}</dd>
                                    </div>

                                    <div class="flex justify-between pt-0 sm:block sm:pt-0">
                                        <dt class="font-medium text-gray-900">Order number</dt>
                                        <dd class="sm:mt-1 font-bold text-purple-500">{{ $transaction->id }}</dd>
                                    </div>





                                </dl>
                                <a href="#"
                                    class="mt-6 flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto">
                                    View Invoice
                                    <span class="sr-only">for order WU88191111</span>
                                </a>
                            </div>

                            <table class="mt-4 w-full text-gray-500 sm:mt-6">
                                <caption class="sr-only">
                                    Products
                                </caption>

                                <thead class="sr-only text-left text-sm text-gray-500 sm:not-sr-only">
                                    <tr>
                                        <th scope="col" class="py-3 pr-8 font-normal sm:w-2/5 lg:w-1/3">Product</th>
                                        <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal sm:table-cell">
                                            Price
                                        </th>
                                        <th scope="col" class="hidden py-3 pr-8 font-normal sm:table-cell">Status
                                        </th>
                                        <th scope="col" class="w-0 py-3 text-right font-normal">Info</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 border-b border-gray-200 text-sm sm:border-t">

                                    @foreach ($transaction->items as $item)
                                        @if ($item->status == 3)
                                            <tr>
                                                <td class="py-4 pr-8">
                                                    <div class="flex items-center">
                                                        @if ($item->images->count())
                                                            <img src="{{ Storage::url($item->images->first()->url) }}"
                                                                alt="Details"
                                                                class="mr-6 h-16 w-16 rounded object-cover object-center">
                                                        @else
                                                            <img src="{{ asset('img/home/DSC_3035.jpg') }}"
                                                                alt="Details"
                                                                class="mr-6 h-16 w-16 rounded object-cover object-center">
                                                        @endif
                                                        <div>
                                                            <div class="font-medium text-gray-900">{{ $item->name }}

                                                            </div>
                                                            @if ($item->price != 0)
                                                                <div class="mt-1 sm:hidden">$
                                                                    {{ number_format($item->price, 2) }}</div>
                                                            @endif

                                                            @if ($item->payment != 0)
                                                                <div class="mt-1 sm:hidden">$
                                                                    {{ number_format($item->payment, 2) }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>



                                                <td
                                                    class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                                    $ {{ number_format($item->price, 2) }} </td>
                                                <td
                                                    class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">
                                                    $ {{ number_format($item->payment, 2) }} </td>
                                                <td class="hidden py-4 pr-8 sm:table-cell">Delivered Jan 25, 2021</td>
                                                <td class="whitespace-nowrap py-6 text-right font-medium">
                                                    <a href="#" class="text-indigo-600">View<span
                                                            class="hidden lg:inline"> Product</span><span
                                                            class="sr-only">,
                                                            Machined Pen and Pencil Set</span></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach


                                    <!-- More products... -->
                                </tbody>
                            </table>
                        @endforeach
                    </div>


                    <!-- More orders... -->
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
