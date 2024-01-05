{{-- USO: PAGINA PRINCIPAL - HOME NO 1 --}}

<x-app-layout>


    {{-- SECCTION 1 - Portada --}}
    <section>

        {{-- Moño --}}
        {{-- <img style="width:50%" class="z-10 absolute bottom-0 left-0" src="{{ asset('img/home/AdobeStock_292882187.png') }}" alt=""> --}}

        {{-- Background  IMAGEN PRINCIPAL --}}


        {{-- py- Determina la altura de la imagen --}}

        {{-- MASTER CLASS - PARALLAX EFFECT - (bg-fixed bg-center bg-no-repeat bg-cover)
                                         min-h-screen - OCUPA TODA LA ALTURA DE PANTALLA
                                         opacity-75 - Detremina la opacity Inicial
                                         hover:opacity-100 - Elimina el opacity --}}
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-64 py-40 opacity-75 relative bg-fixed bg-center bg-no-repeat bg-cover hover:opacity-100"
            style="background-image: url('{{ asset('img/home/pexels-matheus-bertelli-17023014.jpg') }}'); background-position:center">


            <div class="w-full text-6xl md:w-3/4 md:text-8xl lg:w-3/4 lg:text-8xl">
                <h1 class="text-black py-6" style="font-family: Sche">THE PALACE HALL</h1>
                <h1 class="text-white font-bold" style="font-family: Montserrat">
                    Experiance and aptitude of our team
                </h1>
                <p class="text-gray-300 font-bold text-3xl mt-2 mb-4" style="font-family: Montserrat">
                    Perfect for hosting Weddings, Receptions, Corporate Events, Private Celebrations, Pool Parties and
                    More!
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

    {{-- VIDEO --}}
    {{-- <section>
        <video id="my-video" class="video-js" controls preload="auto" width="auto" height="600" data-setup="{}" autoplay="off">
            <source src="/img/video/morilee.mp4" type='video/mp4'>
        </video>
        <div class="media">
            <div class="media-body">
                <iframe width="560" height="315" src="/img/video/morilee.mp4" frameborder="0" allowfullscreen>
                </iframe>
            </div>
        </div>
    </section> --}


    {{-- SECCTION 2 - Contenido --}}
    <section class="mt-6">
        <h1 class="text-gray-800 text-center text-4xl mb-6 font-bold"
            style="my-6 font-family: proxima-nova, sans-serif;font-weight: 800;font-style: normal">AT YOUR SERVICE</h1>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
            {{-- ARTICULO 1 --}}
            <article>
                <figure>
                    <a href="#"><img class="rounded-xl lg:h-40 w-full object-cover opacity-75"
                            src="{{ asset('img/home/pexels-matheus-bertelli-17023020.jpg') }}" alt=""></a>

                    <header class="mt-2">
                        <a href="#">
                            <h1 class="text-center text-xl text-gray-700">Weddings</h1>
                        </a>
                    </header>

                    <a href="#" class="mt-2">
                        <p>From an intimate ceremony to a lavish formal gala, you can make your special day what you
                            have
                            always dreamed. Our main dining room can be arranged to suit your wishes</p>
                    </a>

                </figure>
            </article>

            {{-- ARTICULO 2 --}}
            <article>
                <figure>
                    <img class="rounded-xl h-40 w-full object-cover opacity-75"
                        src="{{ asset('img/home/pexels-matheus-bertelli-17023014.jpg') }}" alt="">
                    <header class="mt-2">
                        <a href="#">
                            <h1 class="text-center text-xl text-gray-700">Events</h1>
                        </a>
                    </header>
                    <a href="#" class="mt-2">
                        <p>If you book your event at this location, you can expect to see lots of natural light, on a
                            beuatifull cozy large space for until 500 people
                            Moreover, the Venue is
                            located on the mall with free parking and can be accessed via public transport</p>
                    </a>

                </figure>
            </article>

            {{-- ARTICULO 3 --}}
            <article>
                <figure>
                    <img class="rounded-xl h-40 w-full object-cover opacity-75"
                        src="{{ asset('img/home/pexels-rene-asmussen-2504968.jpg') }}" alt="">
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Quinceañeras</h1>
                    </header>
                    <p>If you’re looking for a Quinceañera venue that offers something for everyone, then Infinity Park
                        Event Center is your perfect fit,  you’ll be able to
                        accommodate as many or as few guests as desired. No matter what the occasion, we are confident
                        that your Quinceañera will be the most memorable event of your life!</p>
                </figure>
            </article>

            {{-- ARTICULO 4 --}}
            <article>
                <figure>
                    <img class="rounded-xl h-40 w-full object-cover opacity-75"
                        src="{{ asset('img/home/pexels-sergio-millan-4609951.jpg') }}" alt="">
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700">Professional and Bueatifull</h1>
                    </header>
                    <p>Their portfolio spans weddings of all kind, from intimate seaside gatherings to the most extravagant
                         country club takeovers, each specifically designed to speak to the essence of each couple’s unique preferences and tastes.</p>
                </figure>
            </article>


        </div>
    </section>


    {{-- SECCTION 6 - Banda de productos --}}
    <section class="my-24 mx-auto px-4 sm:px-6 lg:px-64">
        <h1 class="text-center text-3xl text-gray-600">Events Type</h1>
        <p class="text-center text-gray-500 text-xl mb-6"> </p>

        <div class="text-center">
            <h2>Wedding Receptions</h2>
            <h2>Corporate Events</h2>
            <h2>Holiday Parties</h2>
            <h2>Anniversaries</h2>
            <h2>Graduations</h2>
            <h2>Birthdays</h2>
            <h2>Reunions</h2>
            <h2>Showers</h2>
        </div>

        {{-- Product Card --}}
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
            {{-- @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach --}}
        </div>
    </section>


    {{-- SECCTION  --}}
    <section class="mt-24 bg-gray-400 mx-auto px-4 sm:px-6 lg:px-64 py-12">
        <div class="text-2xl">
            <p>THE PALACE HALL</p>
            <P>3001 South 144th Street, Omaha, NE 68144</P>
            <p>Phone Number:</p>
            <p>(308)-746-4108</p>
            <p>(402)-884-9950</p>
        </div>
        <div class="flex justify-center my-4">
            <a href="#" class="bg-pink-400 hover:bg-pink-300 text-white font-bold py-2 px-4 rounded">
                Images
            </a>
        </div>

    </section>





    {{-- SECCTION 5 --}}
    {{-- MASTER CLASS - PARALLAX EFFECT - (bg-fixed bg-center bg-no-repeat bg-cover)
                                         min-h-screen - OCUPA TODA LA ALTURA DE PANTALLA
                                         opacity-75 - Detremina la opacity Inicial
                                         hover:opacity-100 - Elimina el opacity --}}
    <section class="mt-16 opacity-75 bg-fixed bg-center bg-no-repeat bg-cover hover:opacity-100"
        style="background-image: url('{{ asset('img/home/pexels-matheus-bertelli-17023005.jpg') }}');background-size: 100%;background-repeat:no-repeat;background-position:center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-48">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white text-bold text-6xl py-6 justify-center font-Playfair Display SC">Working with Best
                    Wedding planners</h1>
                <h1 class="text-white text-bold text-4xl">
                    Means
                </h1>
                <p class="text-white font-bold text-lg mt-2 mb-4 backdrop-brightness-5">
                    Easy Access to Decorating Experts Ensuring Quality Outputs from Concept to Completion
                </p>

            </div>
        </div>
    </section>



    {{-- SECCTION 3 - Banda  OCULTADA --}}
    <section class="mt-24 bg-gray-700 py-12" style="display:none">
        <h1 class="text-center text-white text-3xl">Buscar organizar tu evento ?</h1>
        <p class="text-center text-white">Dirigete al catalago de vestidos y seleciona tu favorito</p>

        <article>
            <figure>
                <img class="m-auto w-36 h-36" src="{{ asset('img/home/shield_05.png') }}" alt="">
                <header class="mt-2 W-FULL">
                    <a href="#">
                        <h1 class="text-center text-xl text-gray-700">Estilos</h1>
                    </a>

                </header>
            </figure>
        </article>
        <h1 class="text-center text-white text-3xl">THE PALACE COLLECTION</h1>

        <div class="flex justify-center my-4">
            <a href="#" class="bg-pink-500 hover:bg-pink-300 text-white font-bold py-2 px-4 rounded">
                Catalagos de Vestidos
            </a>
        </div>

    </section>

    {{-- SECCTION 4 - Banda OCULTADA Contenido Specials of the week --}}
    <section class="my-16" style="display:none">
        <h1 class="text-gray-600 text-center text-3xl mb-6 font-bold" style="font-family:Montserrat">SPECIALS OF THE
            MONTH</h1>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">
            <article>
                <figure>
                    <a href="#"><img class="rounded-lg lg:h-60 w-full object-cover"
                            src="{{ asset('img/home/web_coupon_001.jpg') }}" alt=""></a>

                    <header class="mt-4">
                        <a href="#">
                            <h1 class="text-center text-xl text-gray-700 font-bold">$500 OFF on Privated Collection</h1>
                        </a>
                    </header>

                    <a href="#">
                        <p>Obten un coupon de 500dll en la compra de un vestido de la collection privada, incluyendo la
                            collection Dubai.
                            La collection estara disponible al publico,
                            este evento seran todos los dias del mes de febrero en Oakview Mall.
                            Solamente se puede
                            aplicar un solo coupon a la vez, por producto.
                        </p>
                    </a>

                </figure>
            </article>

            <article>
                <figure>
                    <img class="rounded-lg h-60 w-full object-cover" src="{{ asset('img/home/web_specials_002.jpg') }}"
                        alt="">
                    <header class="mt-4">
                        <a href="#">
                            <h1 class="text-center text-xl text-gray-700 font-bold">$300.00 OFF Any quinceañera dress
                            </h1>
                        </a>
                    </header>
                    <a href="#">
                        <p> Coupon $300dll, cualquier vestido de quinceañera, que no sea de la collection privada, el
                            espcial
                            tendra lugar en todas las tiendas, todo el mes de febrero
                            solo presenta este
                            anuncio a la tienda, para hacerlo valido. Solamente se puede aplicar un solo coupon a la
                            vez, por producto.
                        </p>
                    </a>

                </figure>
            </article>

            <article>
                <figure>
                    <img class="rounded-lg h-60 w-full object-cover"
                        src="{{ asset('img/home/web_coupon_damas_003.jpg') }}" alt="">
                    <header class="mt-2">
                        <h1 class="text-center text-xl text-gray-700 font-bold">$50.00 OFF Any damas dress, for 5 o
                            more
                        </h1>
                    </header>
                    <p>Pudes obtener un coupon de $50.00 de descuento en cualquier vestido de damas, cuando pones una
                        orden
                        de un grupo igual o mayor a 5 piezas, Valido: todo el mes de febrero, en cualquiera
                        de nuestras sucursales, solo presenta este
                        anuncio a la tienda, para hacerlo valido. Solamente se puede aplicar un solo coupon a la vez,
                        por producto.
                    </p>
                </figure>
            </article>


        </div>
    </section>



    {{-- SECCTION 8 - Footer --}}
    <section class="my-4">
        <hr>
        <p class=" text-sm max-w-7xl mx-auto px-4">The Palace Hall is a Trademark with Copyright 2024 The Palace Hall.
            DESIGN
            by Nucleus-Technologies Copyright 2024<a class="text-blue-500 font-bold" href="">Termins and
                conditions</a>
        </p>
    </section>

</x-app-layout>
