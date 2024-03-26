<div class="py-8 max-w-7xl mx-auto"> {{-- CENTRADO --}}
    <div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">

        {{-- USO: Pagina donde se proporciona la informacion del cliente
         para confirmar y poner la orden, un paso antes de pagar --}}

        {{-- Columna 1 --}}
        <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3">
            <div class="bg-white rounded-lg shadow p-6">
                <div>
                    <x-label value="Nombre de contacto / Contact name" />
                    <x-input type="text" {{-- defer - Ayuda a NO usar el servidor cada vez que cambio una letra,
                                SE ESPERA  aque presiones el boton, antes de actualizar la propiedad
                                del componente con lo que esccribo en el formulario --}} wire:model.defer="contact"
                        placeholder="Ingrese el nombre de la persona que recibira el producto" class="w-full" />
                    {{-- Detecta los errores --}}
                    <x-input-error for="contact" />
                </div>

                <div class="mt-4">
                    <x-label value="Telefono de contacto [999.111.2222] / Contact phone" />
                    <x-input type="text" wire:model.defer="phone"
                        placeholder="Ingrese un numero de telefono de contacto" class="w-full" />
                    {{-- Detecta los errores --}}
                    <x-input-error for="phone" />
                </div>

                <div class="mt-4 pb-6 grid grid-cols-2 gap-6">
                    {{-- Estado - State --}}
                    <div>
                        <x-label value="State" />

                        {{-- IMPORTANTE:  wire:model - Sincroniza o conectas las propiedades
                                         del componente con los elemento en el formulario --}}

                        <select class="form-control w-full" wire:model="state_id">
                            {{-- Esta es la primera opcion por defecto y deshabilitada --}}
                            <option value="" disabled selected>Selecione un estado</option>
                            {{-- El resto de las opciones en el select --}}
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        {{-- Detecta los errores --}}
                        <x-input-error for="state_id" />
                    </div>


                    {{-- Ciudades - City  NO SE USA MAS --}}
                    <div class="hidden">
                        <x-label value="City" />

                        {{-- IMPORTANTE:  wire:model - Sincroniza o conectas las propiedades
                                        del componente con los elemento en el formulario --}}

                        <select class="form-control w-full" wire:model="city_id">
                            {{-- Esta es la primera opcion por defecto y deshabilitada --}}
                            <option value="" disabled selected>Selecione una ciudad</option>
                            {{-- El resto de las opciones en el select --}}
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        {{-- Detecta los errores --}}
                        <x-input-error for="city_id" />
                    </div>

                    {{-- City --}}
                    <div>
                        <x-label value="Ciudad" />
                        <x-input class="w-full" wire:model="city" type="text" />
                        {{-- Detecta los errores --}}
                        <x-input-error for="city" />
                    </div>

                    {{-- District --}}
                    <div>
                        <x-label value="Distrito, Colonia / District (Optional)" />
                        <x-input class="w-full" wire:model="district" type="text" />
                        {{-- Detecta los errores --}}
                        <x-input-error for="district" />
                    </div>

                    {{-- Distritos - Colonia - Districts  NO SE USA MAS --}}
                    <div class="hidden">
                        <x-label value="Districts" />

                        {{-- IMPORTANTE:  wire:model - Sincroniza o conectas las propiedades
                                                            del componente con los elemento en el formulario --}}

                        <select class="form-control w-full" wire:model="district_id">
                            {{-- Esta es la primera opcion por defecto y deshabilitada --}}
                            <option value="" disabled selected>Selecione un distrito o colonia</option>
                            {{-- El resto de las opciones en el select --}}
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        {{-- Detecta los errores --}}
                        <x-input-error for="district_id" />
                    </div>

                    <div>
                        <x-label value="Direccion" />
                        <x-input class="w-full" wire:model="address" type="text" />
                        {{-- Detecta los errores --}}
                        <x-input-error for="address" />
                    </div>

                    <div>
                        <x-label value="Zip Code" />
                        <x-input class="w-full" wire:model="zip" type="text" />
                        {{-- Detecta los errores --}}
                        <x-input-error for="zip" />
                    </div>

                    <div>
                        <x-label value="Referencia (Optional)" />
                        <x-input class="w-full" wire:model="references" type="text" />
                        {{-- Detecta los errores --}}
                        <x-input-error for="references" />
                    </div>

                </div>

            </div>

            <div>
                {{-- BOTON --}}
                <x-button {{-- a) Quiero que se realice una accion, Mientras se realice
                                       algun proceso

                                    b) Cual seria la accion? , que se cambie el atributo,
                                    para que el boton permanesca desabilitado
                                    c) Y solamente pasaria esto, cuando se ejecute el metodo : create_order
                                    IMPORATNTE NO DEJAR ESPACIO, CUANDO SE USA EL SIGNO IGUAL AQUI --}} wire:loading.attr="disabled" wire:target="create_order"
                    class="mt-6 mb-4" wire:click="create_order">
                    continuar con la compra
                </x-button>

                <hr>
                <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Quibusdam
                    delectus ex ipsam molestiae reprehenderit, voluptas, reiciendis facilis enim odit illo
                    placeat debitis
                    rerum distinctio deleniti adipisci nam earum nulla a. <a href=""
                        class="font-semibold text-blue-500">Politicas y Privacidad</a></p>
            </div>



        </div>


        {{-- Columna 2 --}}
        <div class="order-1 lg:order-2 lg:col-span-1 xl:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <ul>
                    @forelse (Cart::content() as $item)
                        <li class="flex p-2 border border-b border-gray-200">
                            <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                alt="">
                            <article class="flex-1">
                                <h1 class="font-bold">{{ $item->options->sku }} - {{ $item->name }}</h1>
                                <div class="flex">
                                    <p>Cant: {{ $item->qty }}</p>

                                    {{-- SOLO, SI EXISTE UN COLOR LO IMPRIME,SINO LO IGNORA --}}
                                    @isset($item->options['color'])
                                        <p class="mx-2">Color: {{ $item->options['color'] }}</p>
                                    @endisset
                                    {{-- SOLO, SI EXISTE UN COLOR LO IMPRIME,SINO LO IGNORA --}}
                                    @isset($item->options['size'])
                                        <p>Size: {{ $item->options['size'] }}</p>
                                    @endisset

                                </div>
                                <p>USD $ {{ $item->price }}</p>
                            </article>
                        </li>
                    @empty
                        <li class="py-6 px-4">
                            <p class="text-center text-gray-700">
                                No hay ningun item en el carrito
                            </p>
                        </li>
                    @endforelse
                </ul>

                <hr class="mt-4 mb-3">

                {{-- SUBTOTAL --}}
                <div class="text-gray-700">

                    {{-- subtotal of the items --}}
                    <p class="flex justify-between">
                        Subtotal
                        <span class="font-semibold">{{ Cart::subtotal(2, '.', '') }} USD</span>
                    </p>

                    <p class="flex justify-between">
                        Tax
                        <span class="font-semibold">{{ Cart::subtotal(2, '.', '') * 0.07 }} USD</span>
                    </p>

                    {{-- Costo del envio --}}
                    <p class="flex justify-between">
                        Envio
                        <span class="font-semibold">
                            @if ($envio_type == 1 || $shipping_cost == 0)
                                Gratis
                            @else
                                {{ $shipping_cost }} USD
                            @endif
                        </span>
                    </p>

                    {{-- total --}}
                    <hr class="mt-4 mb-3">
                    <p class="flex justify-between">
                        <span class="text-lg">Total</span>
                        @if ($envio_type == 1)
                            {{ Cart::subtotal(2, '.', '') * 1.07 }} USD
                        @else
                            {{ Cart::subtotal(2, '.', '') * 1.07 + $shipping_cost }} USD
                        @endif

                    </p>

                </div>

            </div>
        </div>
    </div>
</div>
