<div>

    <!-- COMPONENT MODAL PART 1/3 style-->
    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }


        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>


    <div class="grid grid-cols-12 gap-2">
        {{-- Columna 1 --}}
        <div class="col-span-3">

            <div class="card">

                <div> {{-- PARA IMPRIMIR ETIQUETAS CON DYMO --}}
                    <input type="hidden" id="lbCase" name="tcase" wire:model="lbCase">
                    <input type="hidden" id="lb_pkId" name="pk_id" wire:model="lb_pkId">
                    <input type="hidden" id="lb_pkClient" name="pk_client" wire:model="lb_pkClient">
                    <input type="hidden" id="lb_pkPhone" name="pk_phone" wire:model="lb_pkPhone">
                    <input type="hidden" id="lb_pkStore" name="pk_store" wire:model="lb_pkStore">
                    <input type="hidden" id="lb_pkPackage" name="pk_package" wire:model="lb_pkPackage">
                    <input type="hidden" id="lb_pkDate" name="pk_date" wire:model="lb_pkDate">

                    {{-- <label for="">{{ $lbCode }} - {{ $lbName }} - {{ $lbPhone }}</label> --}}
                </div>

                {{-- SELECT STORES --}}
                <div class="p-2 flex gap-2 text-xs">
                    {{-- El select esta sincronizado con la propiedad store_id --}}
                    <select wire:model="store_id" class="form-control w-1/2">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Store</option>
                        {{-- Valores de la base de datos --}}
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>

                    {{-- Print label, IMPORTANTE: Para poder imprimir esta etiqueta,
                        se necesita enviar la variables ocultas, de arriba --}}
                    <div>
                        <button id="printButton"
                            class="bg-blue-400 hover:bg-blue-300 text-white font-bold py-2 px-3 rounded text-uppercase text-sm">
                            <i class="fa-solid fa-tag"></i></i>
                        </button>
                    </div>

                    {{-- Print package, esta dentro de packages y el archivo se llama: inform.blade.php --}}
                    @isset($schedule->user)
                        <div class="mt-2">
                            <a class="bg-blue-400 hover:bg-blue-300 text-white font-bold py-2 px-3 rounded text-uppercase text-sm"
                                href="{{ route('admin.pos.prnpackage', $schedule_id) }}"
                                class="text-indigo-600 hover:text-indigo-900"><i class="fa-solid fa-print"></i></a>
                        </div>
                    @endisset



                </div>
                <div class="px-2 pb-2 flex gap-2 text-xs">

                    {{-- BUSCADOR POR CLIENTES --}}
                    <div class="w-1/2">
                        <input wire:keydown="limpiar_page" wire:model="search" class="form-control shadow-sm"
                            placeholder="Buscar por nombre...">
                    </div>

                </div>

            </div>

            {{-- LISTA DE PAQUETES --}}
            <div class="table-wrapper overflow-y-scroll h-screen">
                <div>
                    {{-- Calendario --}}
                    {{-- <table class="table text-sm">   ORIGINAL --}}
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                {{-- <th>code</th> --}}
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($schedules as $schedule)
                                <tr>
                                    {{-- Hace diferencia entre meses pares e impares --}}


                                    {{-- MES PAR --}}
                                    @if (\Carbon\Carbon::parse($schedule->date)->month % 2 == 1)
                                        {{-- ID --}}

                                        <td class="px-2 py-0 cursor-pointer bg-blue-100"
                                            wire:click="show_items({{ $schedule }})">
                                            <div class="font-roboto">{{ $schedule->id }}</div>
                                        </td>

                                        {{-- Name ORIGINAL --}}
                                        {{-- <td class="px-0 py-0 cursor-pointer bg-blue-100"
                                            wire:click="show_items({{ $schedule }})">
                                            <div class="font-roboto">{{ $schedule->phone }} -
                                                {{ Str::limit($schedule->name, 16) }}
                                            </div>
                                            <input class="py-1 text-sm font-roboto border-0 border-gray-100" type="text" value="{{ $schedule->phone }} - {{ Str::limit($schedule->name, 16) }}">
                                        </td> --}}



                                        {{-- Name --}}
                                        <td class="px-0 py-0 cursor-pointer bg-blue-100"
                                            wire:click="show_items({{ $schedule }})">
                                            <div
                                                class="font-roboto {{ $registro == $schedule->name ? 'text-blue-500 text-md' : '' }}">
                                                {{ $schedule->phone }} -
                                                {{ Str::limit($schedule->name, 16) }}

                                                {{-- Simbolo de New --}}
                                                @if ($schedule->created_at >= \Carbon\Carbon::today()->subDays(1) && $schedule->created_at <= \Carbon\Carbon::today()->addDays(10))
                                                    <span
                                                        class="px-1 inline-flex leading-3 font-roboto rounded-full bg-green-100 text-green-800">
                                                        New
                                                    </span>
                                                @else
                                                @endif

                                            </div>
                                        </td>



                                        {{-- Date --}}
                                        <td class="px-1 py-1 text-md font-medium bg-blue-100">
                                            {{--xxx @livewire('admin.packages.edit-date', ['schedule' => $schedule], key($schedule->id)) --}}
                                        </td>


                                        {{-- MES IMPAR --}}
                                    @else
                                        {{-- ID --}}
                                        <td class="px-2 py-1 cursor-pointer bg-white"
                                            wire:click="show_items({{ $schedule }})">
                                            <div class="font-roboto">{{ $schedule->id }}</div>
                                        </td>

                                        {{-- Name ORIGINAL --}}
                                        {{-- <td class="px-0 py-1 cursor-pointer bg-white"
                                            wire:click="show_items({{ $schedule }})">
                                            <div class="font-roboto">{{ $schedule->phone }} -
                                                {{ Str::limit($schedule->name, 16) }}</div>
                                        </td> --}}

                                        {{-- Name --}}
                                        <td class="px-0 py-0 cursor-pointer bg-white"
                                            wire:click="show_items({{ $schedule }})">
                                            <div
                                                class="font-roboto {{ $registro == $schedule->name ? 'text-blue-500 text-md' : '' }}">
                                                {{ $schedule->phone }} -
                                                {{ Str::limit($schedule->name, 16) }}

                                                {{-- Simbolo de New --}}
                                                @if ($schedule->created_at >= \Carbon\Carbon::today()->subDays(1) && $schedule->created_at <= \Carbon\Carbon::today()->addDays(10))
                                                    <span
                                                        class="px-1 inline-flex leading-3 font-roboto rounded-full bg-green-100 text-green-800">
                                                        New
                                                    </span>
                                                @else
                                                @endif


                                            </div>
                                        </td>

                                        {{-- Date --}}
                                        <td class="px-1 py-1 text-xs font-medium bg-white">
                                            {{-- @livewire('admin.packages.edit-date', ['schedule' => $schedule], key($schedule->id)) --}}
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                    {{-- <div class="card-footer">
                        {{ $schedules->links() }}
                    </div> --}}

                </div>
            </div>


        </div>

        {{-- Columna 2 --}}
        <div class="col-span-7 bg-cover h-1/4"
            style="background-image: url('{{ asset('img/home/AdobeStock_425636423_nada.jpeg') }}') ;background-position:center"
            {{-- DECLARACION DE VARIABLE,  x-data="{open: false}" --}} {{-- x-data="{ filter_type: @entangle('filter_type') }" --}} x-data="{ product_type: @entangle('product_type') }">

            {{-- IMPRIMIR LABEL --}}
            <div class="flex gap-2 mt-2">
                <div>
                    <button id="analytics"
                        class="bg-gray-600 hover:bg-gray-400 text-white font-bold py-2 px-3 rounded text-uppercase text-sm">
                        Analytics
                    </button>
                </div>


                <div>

                    <button id="open2"
                        class="bg-gray-600 hover:bg-gray-400 text-white font-bold py-2 px-3 rounded text-uppercase text-sm">
                        <span class="text-md"><i class="fa-solid fa-user"></i></span>
                    </button>

                </div>
                <div>
                    <button id="open2"
                        class="bg-gray-600 hover:bg-gray-400 text-white font-bold py-2 px-3 rounded text-uppercase text-sm">
                        <span class="text-md"><i class="fa-solid fa-user"></i></span>
                    </button>
                </div>
                <div>
                    <button id="open2"
                        class="bg-gray-600 hover:bg-gray-400 text-white font-bold py-2 px-3 rounded text-uppercase text-sm">
                        <span class="text-md"><i class="fa-solid fa-gift"></i></span>
                    </button>
                </div>

            </div>

        </div>




    </div>

</div>
