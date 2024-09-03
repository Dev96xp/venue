<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">

        <div class="relative">
            <div
                class="{{ $order->status >= 1 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>
            <div class="absolute -left-1.5 mt-0.5">
                <p class="text-sm">Pendiente</p>
            </div>
        </div>

        <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>


        <div class="relative">
            <div
                class="{{ $order->status >= 2 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <div class="absolute -left-1.5 mt-0.5">
                <p class="text-sm">Recivido</p>
            </div>
        </div>

        <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>


        <div class="relative">
            <div
                class="{{ $order->status >= 3 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <div class="absolute -left-1.5 mt-0.5">
                <p class="text-sm">Enviado</p>
            </div>
        </div>

        <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>


        <div class="relative">
            <div
                class="{{ $order->status >= 4 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <div class="absolute -left-1.5 mt-0.5">
                <p class="text-sm">Entregado</p>
            </div>
        </div>
        <div class="h-1 flex-1 bg-blue-400 mx-2"> </div>

        <div class="relative">
            <div
                class="{{ $order->status >= 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12  flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>
            <div class="absolute -left-2 mt-0.5">
                <p class="text-sm">Cancelado</p>
            </div>
        </div>

    </div>



    <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
        <h1 class="text-right text-lg">the company</h1>
        <p class="text-gray-700 uppercase"><span>Numero de orden:</span> <span
                class="font-bold">{{ $order->id }}</span></p>

        <form wire:submit.prevent='update'>
            <div class="flex space-x-3 mt-2">
                <x-label>
                    <input wire:model='status' type="radio" name="status" value="2" class="mr-2">
                    RECIVIDO
                </x-label>
                <x-label>
                    <input wire:model='status' type="radio" name="status" value="3" class="mr-2">
                    ENVIADO
                </x-label>
                <x-label>
                    <input wire:model='status' type="radio" name="status" value="4" class="mr-2">
                    ENTREGADO
                </x-label>
                <x-label>
                    <input wire:model='status' type="radio" name="status" value="5" class="mr-2">
                    CANCELADO
                </x-label>

            </div>
            <div class="flex mt-2">
                <x-button class="ml-auto">
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>


    {{-- TRACKING NUMBER --}}
    <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
        <p class="text-gray-700 uppercase mb-2"><span>Shipping</span></p>

        <form wire:submit.prevent='update_tracking'>

            <div class="grid grid-cols-4 gap-4 mt-2">

                <div class="col-span-2">

                    <div>
                        <h1 class="mb-2 font-bold">Shipping Companies</h1>
                        {{-- El select esta sincronizado con la propiedad group_id --}}
                        <select wire:model="shipping_company_id" class="form-control w-full">
                            {{-- Este es el valor por default --}}
                            <option value="" selected disabled>Select Company</option>

                            @foreach ($shipping_companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error('shipping_company_id')
                            <strong class="text-xs text-red-600">{{ $message }}</strong>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="grid grid-cols-4 gap-4 mt-2">

                <div class="col-span-2 my-3">
                    <x-label value="Tracking Number 1" />
                    <x-input wire:model.defer="tracking1" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="tracking1" />
                </div>

                <div class="col-span-2 my-3">
                    <x-label value="Tracking Number 2" />
                    <x-input wire:model.defer="tracking2" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="tracking2" />
                </div>
            </div>


            <div class="flex mt-2">
                <x-button class="ml-auto">
                    Save
                </x-button>
            </div>

        </form>
    </div>

    {{-- ADDRESS --}}
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="text-lg font-semibold uppercase">Envio</p>
                @if ($order->envio_type == 1)
                    <p class="text-sm">Store Address to pick up:</p>
                    <p class="font-bold">{{ $order->store->name }}</p>
                    <p class="text-sm">{{ $order->store->address }}</p>
                @else
                    <p class="text-sm">Shipping Address</p>
                    <p class="font-bold">{{ $order->address }}</p>
                    <p>{{ $order->city }}, {{ $order->state->name }} [{{ $order->state->code }}] -
                        {{ $order->district }}
                    </p>
                    <p>{{ $order->zip }}</p>
                @endif
            </div>

            <div>
                <p class="text-lg font-semibold uppercase">Contact</p>
                <p class="text-sm">Contact Name: <span class="text-sm font-bold">{{ $order->contact }}</span>
                </p>
                <p class="text-sm">Contact Phone: <span class="text-sm font-bold">{{ $order->phone }}</span>
                </p>
            </div>

        </div>
        <div class="grid grid-cols-1 gap-6 text-gray-700">

            {{-- METODO 3 N --}}
            <div class="flex">
                <a class="btn btn-dark btn-xs ml-auto uppercase" href="{{ route('admin.order.print', $order) }}">Print
                    Label N</a>
            </div>

            {{-- HAY QUE ELIMIAR ESTOS METODOS --}}

            {{-- METODO 2 LW --}}
            {{-- @livewire('admin.order.print-label') --}}


            {{-- METODO 1 --}}
            {{-- <form wire:submit.prevent='print_label'>
                <div class="flex mt-2">
                    <x-button class="ml-auto">
                        Print Label
                    </x-button>
                </div>
            </form> --}}

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
                                    <h1 class="font-bold">{{ $item->options->sku }} - {{ $item->name }}
                                    </h1>
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
                                            <p> Waist: <span class="font-bold">{{ __($item->options->waist) }}</span></p>
                                        @endisset
                                        @isset($item->options->hip)
                                            <p> Hip: <span class="font-bold">
                                                    {{ __($item->options->hip) }}</span>
                                            </p>
                                        @endisset

                                    </div>
                                    <div>
                                        <br>
                                        <span>
                                            Aprox. Arrival date:
                                            <span class="font-bold">
                                                {{ \Carbon\Carbon::parse($item->options->pickup_date)->format('l j F') }}</span>
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
            {{-- TOTALES --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 text-gray-700">
                <div class="col-span-1"></div>
                <div class="col-span-1"></div>
                <div class="col-span-1">
                    <div class="flex justify-between items-center">
                        <div class="w-32 text-right">
                            Subtotal:
                        </div>
                        <div class="flex-initial w-8 text-right">
                            $
                        </div>
                        <div class="flex-initial w-32 text-right">
                            {{ $order->total - $order->tax - $order->shipping_cost }} USD
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="w-32 text-right">
                            Tax:
                        </div>
                        <div class="flex-initial w-8 text-right">
                            $
                        </div>
                        <div class="flex-initial w-32 text-right">
                            {{ $order->tax }} USD
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="w-32 text-right">
                            Shipping cost:
                        </div>
                        <div class="flex-initial w-8 text-right">
                            $
                        </div>
                        <div class="flex-initial w-32 text-right">
                            {{ $order->shipping_cost }} USD
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="w-32 text-right">
                            Total:
                        </div>
                        <div class="flex-initial w-8 text-right">
                            $
                        </div>
                        <div class="flex-initial w-32 text-right">
                            {{ $order->total }} USD
                        </div>
                    </div>
                </div>

            </div>
    </div>

</div>
