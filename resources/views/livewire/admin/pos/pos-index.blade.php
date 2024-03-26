<div>
    {{-- header --}}
    <section class="card">
        <div class="card-header">
            <div class="grid sm:grid-cols-2 lg:grid-cols-6 gap-4">
                <div class="col-span-2">
                    <div>
                        <p class="text-lg text-gray-700 font-semibold">{{ $user->cus_id }} / <span
                                class="text-bold text-blue-700"> {{ $user->name }} </span> /
                            {{ $account_id }}</p>
                    </div>
                    <div>
                        <p class="text-lg text-gray-700 font-semibold">{{ $user->address }}, {{ $user->city }} -
                            {{ $user->phone }}</p>
                    </div>

                </div>
                <div class="col-span-2">
                    <p class="text-lg text-gray-500 font-semibold">Store : {{ $user->store->name }}</p>
                    {{-- SOLO SI EXISTE UNA CUENTA DEFINIDA --}}
                    @isset($user->account)
                        <p class="text-lg text-gray-500 font-semibold">Account ID : {{ $user->account->acc_id }}</p>
                    @else
                        <p class="text-lg text-gray-500 font-semibold">Account ID : CUENTA NO DEFINIDA</p>
                    @endisset
                </div>
                <div class="col-span-2">
                    {{-- vacio --}}
                </div>
            </div>
        </div>

    </section>



    <div class="card">

        <div class="py-2 px-2 grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-5 gap-2">
            {{-- LISTA DE ITEMS PARA ESTA FACTURA --}}
            <div class="col-span-3 mr-6">

                <div x-data="{ open: false }"> {{-- 1) Se declara la variable: open --}}

                    {{-- 2) Se invierte el valor de la variable: open, cada vez q seda un click --}}
                    <h1 x-on:click="open = !open"
                        class="bg-white rounde-lg shadow-lg px-3 py-2 text-lg text-gray-700 font-semibold sm:text-left lg:text-right">
                        Invoice :
                        {{ $transaction_id }}</h1>

                    {{-- Lista de FACTURAS --}}
                    {{-- 3) Segun el valor de la variable open, se muestra o se oculta esta seccion (este div) --}}
                    <div x-show="open">
                        <div class="grid sm:grid-cols-1 lg:grid-cols-4 bg-white rounde-lg shadow-lg px-2 py-4 mb-4">

                    {{-- Lista de TODAS FACTURAS --}}
                            <div class="col-span-2 mr-4">
                                <table class="table table-striped text-sm">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($transactions->count())
                                            @foreach ($transactions as $transaction)
                                                <tr>

                                                    {{-- Transaction id (invoive) --}}
                                                    <td class="py-1 cursor-pointer"
                                                        wire:click="show_items({{ $transaction }})"
                                                        x-on:click="open = false">
                                                        <div>{{ $transaction->id }}</div>
                                                    </td>

                                                    {{-- date --}}
                                                    <td class="py-1 cursor-pointer text-pink text-bold"
                                                        wire:click="show_items({{ $transaction }})"
                                                        x-on:click="open = false">
                                                        <div>
                                                            {{ $transaction->id }} -
                                                            {{ \Carbon\Carbon::parse($transaction->created_at)->toFormattedDateString('l j F') }}
                                                            / {{ $transaction->city }}
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            Not Invoices (No hay facturas)
                                        @endif



                                    </tbody>
                                </table>
                            </div>

                    {{-- AGREGAR UNA FACTURA - Add factura --}}
                            <div class="col-span-2">

                                <div class="col-span-1">
                                    {{-- SOLO SI EXISTE UNA CUENTA DEFINIDA --}}
                                    @isset($user->account)
                                        <a class="btn btn-blue w-40" wire:click="add_invoice({{ $user }})">Add h
                                            Invoice</a>
                                    @else
                                        <a class="btn btn-blue w-40" wire:click="">Add Invoice</a>
                                    @endisset
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                {{-- LISTA DE ITEMS(productos) AGREGADOS a la factura --}}
                <div class="bg-white rounde-lg shadow-lg px-2 py-4 mb-4">

                    <table class="table table-striped text-md"> {{-- Tamano del texto: (text-md) --}}
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Qty</th>
                                <th>Items</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Subtotal</th>
                                <th class="text-right">Pago</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    {{-- Sku --}}
                                    <td class="py-1">
                                        <div class="flex items-center">

                                            {{-- IMAGEN DEl PRODUCTO XP --}}
                                            <div class="flex-shrink-0 h-10 w-10">

                                                {{-- Si existe la variable $item y ademas tiene una imagen relaicionada, que imprima, de lo contrario q lo ignore --}}

                                                @if ($item->images->count())
                                                    <img id="picture"
                                                        class="h-10 w-10 rounded-full object-cover object-center inline-block"
                                                        src="{{ Storage::url($item->images->first()->url) }}"
                                                        alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full object-cover object-center"
                                                        src="https://images.pexels.com/photos/6147134/pexels-photo-6147134.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                                        alt="">
                                                @endif


                                            </div>


                                            <div class="ml-4">
                                                <a
                                                    {{--ojo###  href="{{ route('admin.tuxedos.index', [$user]) }}">{{ $item->sku }}</a> --}}
                                                    href="">{{ $item->sku }}</a>
                                            </div>

                                        </div>

                                    </td>
                                    {{-- Qty --}}
                                    <td class="py-1">
                                        <div>
                                            {{ $item->qty }}
                                        </div>
                                    </td>

                                    {{-- Name del --}}
                                    <td class="py-1">
                                        <div>


                                            @if ($item->requisition)
                                                <div>
                                                    <a class="font-bold"
                                                        href="{{ route('admin.requisitions.index') }}">{{ Str::limit($item->name, 35) }}</a>
                                                    {{-- {{ Str::limit($item->name, 35) }} NEW --}}
                                                </div>
                                                <div class="text-xs text-green-700">
                                                    SPECIAL ORDER
                                                </div>
                                            @else
                                                {{ Str::limit($item->name, 35) }}
                                            @endif



                                            @if ($item->color != 'none' || $item->size || $item->bust || $item->waist)
                                                <p>{{ $item->model }} - {{ $item->color }},
                                                    T-{{ $item->size }},
                                                    ({{ $item->bust }}/{{ $item->waist }})

                                                    @if ($item->requisition)
                                                        * ORDEN ESPECIAL
                                                    @else
                                                    @endif
                                                </p>
                                            @else
                                            @endif

                                        </div>
                                    </td>


                                    {{-- Qty --}}
                                    <td class="py-1">
                                        <div class="text-right">
                                            <p> $ {{ $item->price }}</p>
                                        </div>
                                    </td>

                                    {{-- Qty --}}
                                    <td class="py-1">
                                        <div class="text-right">
                                            <p> $ {{ $item->qty * $item->price }}</p>
                                        </div>
                                    </td>

                                    {{-- Qty --}}
                                    <td class="py-1">
                                        <div class="text-right">
                                            @switch($item->status)
                                                @case(3)
                                                    <p> $ {{ $item->payment }}</p>
                                                @break

                                                @case(4)
                                                    <p class="line-through"> $ {{ $item->payment }}</p>
                                                @break

                                                @default
                                            @endswitch
                                        </div>
                                    </td>


                                    {{-- Status --}}
                                    <td class="py-1">
                                        {{-- <button class="btn btn-danger btn-xs"
                                            wire:click="delete_item({{ $item }})">X</button> --}}
                                        <button class="btn btn-danger btn-xs"
                                            wire:click="hide_item({{ $item }})">X</button>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>

                {{-- LOS PAGOS --}}
                <div class="bg-white rounde-lg shadow-lg px-6 py-4 mt-4">

                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-10 gap-4 mb-4">

                        {{-- TOTALES --}}
                        <div class="col-span-3">

                            <div class="flex items-center">
                                <div class="mr-4">
                                    <p>Subtotal:</p>
                                    {{-- <P>Descount:</P> --}}
                                    <p>Tax: </p>
                                    <p class="text-bold">Total: </p>
                                </div>
                                <div style="text-align: right">
                                    <p> $ {{ $subtotal }} USD</p>
                                    {{-- <P> $ 0.00 USD</P> --}}
                                    <P> $ {{ $subtotal * 0.07 }} USD</P>
                                    <p class="text-bold"> $ {{ $total }} USD</p>
                                </div>
                            </div>

                        </div>

                        <div class="col-span-3">
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <P>Payments: </P>
                                    <p class="text-bold">Balance: </p>
                                </div>
                                <div style="text-align: right">
                                    <p> $ {{ $totalpayments }} </p>
                                    <p class="text-bold"> $ {{ $balance }}</p>
                                </div>
                            </div>
                        </div>


                        {{-- Tipo de pago(visa,cash..etc) --}}
                        <div class="col-span-2" x-data>
                            <h1 class="mb-2 font-bold text-sm">Tipo Pago</h1>
                            {{-- El select esta sincronizado con la propiedad color --}}
                            <select wire:model="payment_id" class="form-control w-full">
                                {{-- Este es el valor por default --}}
                                <option value="" selected disabled>Tipo Pago</option>

                                @foreach ($payments as $payment)
                                    <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        {{-- Monto del pago --}}
                        <div class="col-span-2" x-data>
                            <h1 class="mb-2 font-bold text-sm">Pago</h1>
                            {{-- <input wire:model.defer="pago" type="text"> --}}

                            <x-input wire:model.defer="pago" type="text" class="w-full" />
                            {{-- Revisa por algun error de validacion --}}
                            <x-input-error for="pago" />
                        </div>

                    </div>

                    <div class="grid sm:grid-cols-1 md:grid-cols- lg:grid-cols-6 gap-4">
                        <div class="col-span-1">
                        </div>
                        <div class="col-span-3">

                        </div>


                        {{-- SOLO SI EXISTE UNA CUENTA DEFINIDA --}}
                        @isset($user->account)
                            {{-- Print recive --}}
                            <div class="col-span-1">
                                {{-- Print Invoice - si sirve pero solo imprime sobre hoja de impresora normal,
                                    OJO este reporte se logra imprimir usando un controlador y no un componente de livewire --}}

                                <a class="btn btn-blue w-full" href="{{ route('admin.pos.prninvoice', $transaction_id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Print</a>
                            </div>

                            {{-- Apply payment - Add Payment - HACER PAGO --}}
                            <div class="col-span-1">
                                <a class="btn btn-blue w-full" wire:click="add_payment({{ $user }})">Payment</a>
                            </div>
                        @else
                            STOP...NO EXISTE UNA CUENTA DEFINIDA
                        @endisset



                    </div>
                </div>

            </div>

            {{-- ***  LISTA DE ITEMS(productos) *** --}}
            <div class="col-span-2 mr-6" x-data>

                <div class="bg-white rounde-lg shadow-lg px-4 py-2 mb-4">

                    {{-- Buscador de productos--}}
                    <div class="px-2 py-2 flex items-center gap-6">

                        <input wire:keydown="limpiar_page" wire:model="search" class="form-control flex-1 shadow-sm" placeholder="Producto ...">
                        {{-- <input wire:keydown="limpiar_page" wire:model="search" class="form-input flex-1 shadow-sm" placeholder="Ingrese el nombre de un curso...">  ORIGINAL --}}

                       {{-- ojo### <a class="btn btn-danger ml-2" href="{{ route('admin.products.create') }}">Crear producto</a> --}}


                        {{-- OJO, ojo, ojo  MASTER CLASS - esto haceposible ver el modal para agregar una orden especial? --}}
                        {{-- MODAL PARA CREA ORDEN ESPECIAL --}}
                    {{-- ojo###   @livewire('admin.pos.create-special-order') --}}

                    </div>

                    {{-- Lista de productos para vender --}}
                    <table class="table table-striped text-md"> {{-- Tamano del texto: (text-md) --}}
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Category</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr>

                                    {{-- Sku --}}
                                    <td class="py-1">
                                        <div class="flex items-center">

                                            {{-- IMAGEN DEl PRODUCTO --}}
                                            <div class="flex-shrink-0 h-10 w-10">

                                                {{-- Si existe la variable $course y ademas tiene una imagen relaicionada, que imprima, de lo contrario q lo ignore --}}
                                                {{-- @isset($product->images) --}}


                                                {{-- MASTER CLASS - $product->images->count() - Evita un error cuando no existen imagenes --}}
                                                @if ($product->images->count())
                                                    <img id="picture"
                                                        class="h-10 w-10 rounded-full object-cover object-center inline-block"
                                                        src="{{ Storage::url($product->images->first()->url) }}"
                                                        alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full object-cover object-center"
                                                        src="https://images.pexels.com/photos/6147134/pexels-photo-6147134.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                                        alt="">
                                                @endif


                                            </div>

                                            <div class="ml-4">
                                                {{ $product->sku }}
                                            </div>

                                        </div>

                                    </td>

                                    {{-- Name --}}
                                    <td class="py-1">
                                        <div>
                                            {{ Str::limit($product->name, 20) }}
                                     {{--       <p class="text-xs"> {{ $product->category->name }} /
                                                {{ $product->subcategory->name }}</p>
                                                --}}
                                        </div>
                                    </td>

                                    {{-- Qty --}}
                                    <td class="py-1">
                                        <div class="text-right">
                                            <p> $ {{ $product->price }}</p>
                                        </div>
                                    </td>

                                    {{-- Add Item -- ORIGINAL - --}}
                                    <td class="py-1">
                                        <div class="col-span-1">
                                            <a class="btn btn-blue w-full"
                                                wire:click="add_item({{ $product->id }})">Add</a>
                                        </div>
                                    </td>


                                    {{-- Add Item NEW --}}
                                    {{-- <td class="py-1">
                                        <div class="col-span-1">
                                            <a class="btn btn-blue w-full"
                                                sweetalert2 paso 2/3
                                                wire:click="$emit('add_itemx', [{{ $product->id }}, {{$user->id}}, {{ $transaction_id }}])">Add</a>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                    {{-- card-footer -  Esta es una clase de boostrap --}}
                    <div class="card-footer">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>

        </div>

    </div>


</div>
