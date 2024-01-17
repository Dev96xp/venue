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

                {{-- COVER --}}
                <div class="absolute right-10 bottom-2">
                    <p class="text-white font-bold" style="font-family: Montserrat"></p>
                </div>
            </div>
        </div>

    </section>


    {{-- SECCTION 4 - Contenido Specials of the week --}}
    <section class="my-16">

        <div
            class="mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-8">

            {{-- Articulo #1 --}}
            <article>
                <figure>

                    <h1 class="text-gray-600 text-center text-4xl mb-6 mx-12 font-bold"
                        style="font-family:Dancing Script">Dicen que la vida es más bella
                        si podemos cumplir con lo
                        que soñamos.</h1>
                    <a href="#"><img class="rounded-lg lg:h-full w-full object-cover shadow-2xl"
                            src="{{ asset('img/home/pexels-inna-mykytas-13925971.jpg') }}" alt=""></a>

                    <header class="mt-4">
                        <a href="#">
                            <h1 class="text-center text-xl text-gray-700 font-bold">$500 OFF on Privated Collection</h1>
                        </a>
                    </header>

                </figure>
            </article>


            {{-- Articulo #2 --}}
            <article>
                <figure>
                    <div class="w-full mx-auto px-4 py-80 opacity-25 bg-center bg-no-repeat bg-cover hover:opacity-50"
                        style="background-image: url('{{ asset('img/home/pexels-moose-photos-1037994.jpg') }}')">
                        {{-- CENTRA TEXTO DENTRO DEL BACKGROUND --}}

                        <section aria-labelledby="sale-heading" class="h-screen relative mx-auto flex max-w-7xl flex-col items-center px-4 pt-32 text-center sm:px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:max-w-none">
                              <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">Get 25% off during our one-time sale</h2>
                              <p class="mx-auto mt-4 max-w-xl text-xl text-gray-600">Most of our products are limited releases that won't come back. Get your favorite items while they're in stock.</p>
                              <a href="#" class="mt-6 inline-block w-full rounded-md border border-transparent bg-gray-900 px-8 py-3 font-medium text-white hover:bg-cyan-800 sm:w-auto">Get access to our one-time sale</a>
                            </div>
                          </section>
                    </div>



                </figure>
            </article>
        </div>
    </section>
</div>
