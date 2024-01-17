<div>
        {{-- SECCTION 1 - Imagen Principal --}}
        <section>

            {{-- Moño --}}
            {{-- <img style="width:50%" class="z-10 absolute bottom-0 left-0" src="{{ asset('img/home/AdobeStock_292882187.png') }}" alt=""> --}}

            {{-- Background  IMAGEN PRINCIPAL --}}


            {{-- py- Determina la altura de la imagen --}}

            {{-- MASTER CLASS - PARALLAX EFFECT - (bg-fixed bg-center bg-no-repeat bg-cover, EN ESTE CASO ELIMINE FIXED, PARA QUE TRABAJARA BIEN EN MOBIL)
                                             min-h-screen - OCUPA TODA LA ALTURA DE PANTALLA
                                             opacity-75 - Detremina la opacity Inicial
                                             hover:opacity-100 - Elimina el opacity --}}
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-64 py-40 opacity-75 relative bg-center bg-no-repeat bg-cover hover:opacity-100"
                style="background-image: url('{{ asset('img/home/pexels-danielle-reese-2632670.jpg') }}')">


                <div class="w-full md:w-3/4 lg:w-3/4">
                    {{-- APLICANDO UNA CONDICIONAL PARA CLASES --}}
                    <p class="text-black text-6xl md:text-8xl lg:text-8xl py-6" style="font-family: Sche">Violeta Jones</p>
                    <p class="text-white text-2xl md:text-5xl lg:text-5xl font-bold" style="font-family: Montserrat">
                        Invitation
                    </p>


                    {{-- OCULTE EL BUSCADOR TEMPORALMENTE --}}
                    {{-- @livewire('search') --}}


                    {{-- COVER --}}
                    <div class="absolute right-10 bottom-2">
                        <p class="text-white font-bold" style="font-family: Montserrat"></p>
                    </div>
                </div>
            </div>

        </section>


    {{-- SECCTION 4 - Contenido Specials of the week --}}
    <section class="my-16">
        <h1 class="text-gray-600 text-center text-3xl mb-6 font-bold" style="font-family:Montserrat">MY PLATINUM</h1>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">
            <article>
                <figure>
                    <a href="#"><img class="rounded-lg lg:h-60 w-full object-cover"
                            src="{{ asset('img/home/shopping.jpg') }}" alt=""></a>

                    <header class="mt-4">
                        <a href="#">
                            <h1 class="text-center text-xl text-gray-700 font-bold">$500 OFF on Privated Collection</h1>
                        </a>
                    </header>

                    <a href="#">
                        <p>Obten un coupon de 500dll en la compra de un vestido de la collection privada, incluyendo la
                            collection Dubai.
                            La collection estara disponible al publico,
                            este evento seran todos los dias LA ULTIMA SEMANA DE CADA MES en cualquiera de nuestras
                            tiendas.
                            Solamente se puede
                            aplicar un solo coupon a la vez, por producto.
                        </p>
                    </a>

                </figure>
            </article>

            <article>
                <figure>
                    <div class="relative">
                        <img class="rounded-lg h-60 w-full object-cover" src="{{ asset('img/home/mycard.jpg') }}"
                            alt="">

                        <div class="absolute right-10 top-4 text-xl text-gray-500 font-bold">
                            My Palace Platinum
                        </div>

                        <div class="absolute left-10 bottom-14 text-xl text-gray-400 font-bold">
                            4256 4567 3652 7894
                        </div>

                        <div class="absolute left-10 bottom-8 text-xl text-gray-600 font-bold">
                            Exp 04/25
                        </div>
                        <div class="w-24 h-24 absolute right-6 bottom-6 z-40">
                            <img src="{{ asset('img/home/2020-1002.png') }}" alt="">
                        </div>

                    </div>


                    <header class="mt-4">
                        <a href="#">
                            <h1 class="text-center text-xl text-gray-700 font-bold">My Platinum
                            </h1>
                        </a>
                    </header>

                    <a href="#">
                        <p> Activa tu tarjeta Platinum es muy facil, en cada compra obten puntos que podras canjear por productos
                        </p>
                    </a>

                </figure>
            </article>

            <article>
                <figure>
                    <img class="rounded-lg h-60 w-full object-cover"
                        src="{{ asset('img/home/web_cloth_01004.jpg') }}" alt="">
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700 font-bold">My points
                        </h1>
                    </header>
                    <p>Pudes obtener un coupon de $50.00 de descuento en cualquier vestido de damas, cuando pones una
                        orden
                        de un grupo igual o mayor a 5 piezas, Valido: todos los dias de LA ULTIMA SEMANA DE CADA MES, en
                        cualquiera
                        de nuestras sucursales, solo presenta este
                        anuncio a la tienda, para hacerlo valido. Solamente se puede aplicar un solo coupon a la vez,
                        por producto.
                    </p>
                </figure>
            </article>


        </div>
    </section>
</div>
