<div class="font-sans bg-gray-100">

    <!-- pagina: INVITATIONS PRICING - LA LISTA DE LOS PAQUETES DE INVITACIONES
                 USO: VENTA DE INVITACIONES 1/4 -->
    <div>
        <div class="w-full mx-auto px-5 py-10 text-gray-600">

            <div class="text-center max-w-xl mx-auto mb-20">
                <h1 class="text-pink-400 text-5xl md:text-6xl font-bold mb-5">Seleciona tu paquete</h1>
                <h3 class="text-xl font-medium mb-10">Existen varios paquetes de invitaciones, segun tus necesidades,
                    seleciona
                    un paquete de invitacion que mas te guste y una vez pagado, proporcina la informacion necesaria y
                    nosotros crearemos tu invitacion y listo a enviarla con quien mas quieras, vamos a comensar la
                    fiesta !!!.</h3>
            </div>

            <div class="max-w-7xl mx-auto md:flex">
                <!-- # 1 - Basic Card este ya parece mas o menos bueno-->
                <div
                    class="w-full md:mr-12 mb-6 md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mx-auto md:mb-0 shadow-gray-600 relative md:z-50 md:flex md:flex-col p-8 text-center rounded-2xl pr-16 shadow-xl">
                    <h1 class="text-black font-semibold text-3xl">Esmeralda</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-pink-500 align-top">$ </span>
                        <span class="text-3xl font-semibold">129.99</span>
                        <span class="text-pink-500 font-medium">/ todo incluido</span>
                    </p>
                    <hr class="mt-4 border-1">

                    <div class="pt-8">
                        <p class="mb-3 font-semibold text-gray-500 text-left">
                            <span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> 4 meses <span class="text-black">visible</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">invitacion</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">Mensaje de
                                    presentacion</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">Seccion Padres y
                                    Padrinos</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">Cuenta regresiva</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Ceremonia <span class="text-black">...</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Reception <span class="text-black">...</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Codigo de <span class="text-black">vestimenta</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Mesa de <span class="text-black">regalos</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Fotos en invitation <span class="text-black">(1-3)</span></span>
                        </p>



                        {{-- BOTON DE CARRITO DE COMPRARS - para agregar un producto al carrito de comparas --}}

                        <div class="flex-1">
                            <x-button {{-- x-bind:disabled="!$wire.quantity" --}} color="blue" class="w-full" {{-- wire:click="delete_part('{{ $part->id }}')" --}}
                                wire:click="addItem('1')" {{-- Miestra se este realizando un proceso, quiero cambiar el atributo a: desahibilitado --}} wire:loading.attr="disabled"
                                {{-- Pero que esto SOLO ocurra cuando se este realizando el metodo: addItem --}} wire:target="addItem">
                                Agregar al carrito de compras
                            </x-button>

                        </div>

                        <div class="absolute top-4 right-4">
                            <p class="bg-pink-700 text-white font-semibold px-4 py-1 rounded-full uppercase text-xs">
                                Basic</p>
                        </div>

                    </div>
                </div>

                <!-- # 2 - StartUp Card -->
                <div
                    class="w-full mb-6 md:w-1/3 md:max-w-none bg-gray-900 px-8 md:px-10 py-8 md:py-10 mx-auto md:-mx-3 md:mb-0 rounded-2xl shadow-gray-600 md:relative md:z-50 md:flex md:flex-col p-8 text-center text-white border-4 shadow-xl border-white transform md:scale-110">
                    <h1 class="text-white font-semibold text-2xl">Diamond</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">$ </span>
                        <span class="text-3xl font-semibold">169.99</span>
                        <span class="text-gray-400 font-medium">/ todo incluido</span>
                    </p>
                    <hr class="mt-4 border-1 border-gray-600">
                    <div class="pt-8">

                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                All features in <span class="text-white">Diamond</span>
                            </span>
                        </p>

                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Flexible <span class="text-white">call scheduling</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-white">15 TB</span> cloud storage
                            </span>
                        </p>

                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-white">Fotos en invitacion </span> (1-3)
                            </span>
                        </p>

                        {{-- BOTON DE CARRITO DE COMPRARS - para agregar un producto al carrito de comparas --}}

                        <div class="flex-1">
                            <x-button {{-- x-bind:disabled="!$wire.quantity" --}} color="blue" class="w-full" {{-- wire:click="delete_part('{{ $part->id }}')" --}}
                                wire:click="addItem('2')" {{-- Miestra se este realizando un proceso, quiero cambiar el atributo a: desahibilitado --}} wire:loading.attr="disabled"
                                {{-- Pero que esto SOLO ocurra cuando se este realizando el metodo: addItem --}} wire:target="addItem">
                                Agregar al carrito de compras
                            </x-button>

                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <p class="bg-pink-700 font-semibold px-4 py-1 rounded-full uppercase text-xs">Popular</p>
                    </div>
                </div>

                <!-- # 3 - Enterprise Card -->
                <div
                    class="w-full md:ml-12 md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-2xl shadow-xl shadow-gray-600 md:flex md:flex-col p-8 text-center pl-16">
                    <h1 class="text-black font-semibold text-3xl">Gema</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-pink-500 align-top">$ </span>
                        <span class="text-3xl font-semibold">199.99</span>
                        <span class="text-pink-500 font-medium">/ todo incluido</span>
                    </p>
                    <hr class="mt-4 border-1">
                    <div class="pt-8">
                        <p class="mb-3 font-semibold text-gray-500 text-left">
                            <span class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> 4 meses <span class="text-black">visible</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">invitacion</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">Mensaje de
                                    presentacion</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">Seccion Padres y
                                    Padrinos</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Diseño de <span class="text-black">Cuenta regresiva</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Ceremonia <span class="text-black">...</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Reception <span class="text-black">...</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Codigo de <span class="text-black">vestimenta</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Mesa de <span class="text-black">regalos</span></span>
                        </p>

                        <p class="mb-3 font-semibold text-gray-500 text-left"><span
                                class="material-icons align-middle">
                                Incluido</span>
                            <span class="pl-2"> Fotos en invitation <span class="text-black">(1-3)</span></span>
                        </p>

                        {{-- BOTON DE CARRITO DE COMPRARS - para agregar un producto al carrito de comparas --}}

                        <div class="flex-1">
                            <x-button {{-- x-bind:disabled="!$wire.quantity" --}} color="blue" class="w-full" {{-- wire:click="delete_part('{{ $part->id }}')" --}}
                                wire:click="addItem('3')" {{-- Miestra se este realizando un proceso, quiero cambiar el atributo a: desahibilitado --}} wire:loading.attr="disabled"
                                {{-- Pero que esto SOLO ocurra cuando se este realizando el metodo: addItem --}} wire:target="addItem">
                                Agregar al carrito de compras
                            </x-button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</div>
