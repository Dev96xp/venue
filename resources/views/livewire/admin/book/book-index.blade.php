<div>

    <div class="card">

        {{-- card-header - boostrap --}}
        <div class="card-header">
            <div class="py-2 px-2 grid grid-cols-7 gap-6">

                <div class="col-span-1">
                    {{-- El select esta sincronizado con la propiedad color --}}
                    <select wire:model="store_id" class="form-control w-full">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Store</option>

                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- MASTER CLASS - Agrega un DATE-PICKER al input del formulario --}}
                {{-- a) En la pagina del layout: admin.blade.php se agrego:

                b) los stilos:
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

                c) en la parte de abajo los scripts CDN:
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                d) luego la funcion creada, apuntando al, el id = #datepicker, en la parte de abajo de esta pagina
                    <script> flatpickr('#datepicker') </script>

                e) por ultimo aqui se agrega el ( id="datepicker" ) al elemnto para mostrar el datepicker, listo --}}

                <div>
                    <!-- This is an example component -->
                    <div class="max-w-lg mx-auto">

                        <fieldset class="">
                            <div class="flex items-center">
                                <input id="country-option-1" type="radio" name="countries" value="Today"
                                    wire:click="$set('radio_select', '1')"
                                    class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                    aria-labelledby="country-option-1" aria-describedby="country-option-1"
                                    checked="">
                                <label for="country-option-1" class="text-sm font-medium text-gray-900 ml-2 block">
                                    Today
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input id="country-option-2" type="radio" name="countries" value="Dos fechas"
                                    wire:click="$set('radio_select', '2')"
                                    class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                    aria-labelledby="country-option-2" aria-describedby="country-option-2">
                                <label for="country-option-2" class="text-sm font-medium text-gray-900 ml-2 block">
                                    Entre dos fechas
                                </label>
                            </div>
                        </fieldset>

                    </div>
                </div>

                <div class="col-span-1">
                    <x-input wire:model="date1" type="text" class="w-full" id="datep"
                        placeholder="Date 1..." />
                    <x-input-error for="date1" />
                </div>

                <div class="col-span-1">
                    <x-input wire:model="date2" type="text" class="w-full" id="datep"
                        placeholder="Date 2..." />
                    <x-input-error for="date2" />
                </div>

                {{-- PRINT --}}
                <a class="btn btn-secondary btn-sm float-right"
                    href="{{ route('admin.corte.prnreport', [$store_id, $date1, $date2, $radio_select]) }}">Print</a>

            </div>
        </div>
    </div>

    {{-- Si existe algun usario en: $users, muestra la tabla --}}
    @if ($sales->count())

        <div class="card-body">
            <table class="table table-striped text-sm">
                <thead>
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
                            <td class="font-bold">
                                {{ $sale->transaction->id }}
                            </td>
                            <td>{{ $sale->transaction->account->user->phone }} -
                                {{ $sale->transaction->account->user->name }}</td>
                            <td>
                                @switch($sale->status)
                                    @case(3)
                                        <div class="text-bold ">{{ $sale->name }} / {{ $sale->transaction->city }}</div>
                                    @break

                                    @case(4)
                                        <div class="line-through"> {{ $sale->name }} /
                                            {{ $sale->transaction->city }}</div>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                @switch($sale->status)
                                    @case(3)
                                        <div class="text-right text-bold">$ {{ number_format($sale->payment, 2, ',', '.') }}
                                        </div>
                                    @break

                                    @case(4)
                                        <div class="text-right line-through">$
                                            {{ number_format($sale->payment, 2, ',', '.') }}</div>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>{{ $sale->created_at }}</td>
                            <td>
                                @switch($sale->status)
                                    @case(3)
                                        <div class="text-bold">
                                        </div>
                                    @break

                                    @case(4)
                                        <div class="text-bold">Cancelado</div>
                                    @break

                                    @default
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="card-body"><strong>No hay registros</strong></div>
    @endif

    <div class="grid grid-cols-6 gap-4">

        <div class="col-span-1">
            <div class="ml-10">
                Subtotal CASH :
            </div>
            <div class="ml-10">
                Subtotal VISA :
            </div>
            <div class="ml-10">
                Subtotal CHECK :
            </div>
            <div class="ml-10">
                Subtotal Credict Card :
            </div>
            <div class="ml-10">
                Subtotal Special Decounts :
            </div>
        </div>

        <div class="col-span-1">
            <div class="ml-10 text-right">
                $ {{ number_format($subtotal_cash, 2, ',', '.') }}
            </div>
            <div class="ml-10 text-right">
                $ {{ number_format($subtotal_visa, 2, ',', '.') }}
            </div>
            <div class="ml-10 text-right">
                $ {{ number_format($subtotal_check, 2, ',', '.') }}
            </div>
            <div class="ml-10 text-right">
                $ {{ number_format($subtotal_credict_card, 2, ',', '.') }}
            </div>
            <div class="ml-10 text-right">
                $ {{ number_format($subtotal_special_discount, 2, ',', '.') }}
            </div>
        </div>

    </div>

    {{-- Datepicker --}}
    <script>
        flatpickr('#datep')
    </script>

</div>
