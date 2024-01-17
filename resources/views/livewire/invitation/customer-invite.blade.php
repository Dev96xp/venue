<div>
    {{-- SECCTION 1 - Imagen Principal --}}
    <section>
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-64 py-40 opacity-75 relative bg-center bg-no-repeat bg-cover hover:opacity-100"
            style="background-image: url('{{ asset('img/home/pexels-danielle-reese-2632670.jpg') }}')">


            <div class="w-full md:w-3/4 lg:w-3/4">
                <p class="text-black text-6xl md:text-8xl lg:text-8xl py-6" style="font-family: Sche">Violeta Jones</p>
                <p class="text-fuchsia-500 text-2xl md:text-5xl lg:text-5xl font-bold" style="font-family: Montserrat">
                    Invitation
                </p>
            </div>
        </div>
    </section>


    {{-- SECCTION 4 - Contenido Specials of the week --}}
    <section class="my-16">
        <div
            class="mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-8">

            {{-- Articulo #1 Segunga foto y - Pensamiento #1 --}}
            <article>
                <figure>

                    <h1 class="text-gray-600 text-center text-4xl mb-6 mx-12 font-bold"
                        style="font-family:Dancing Script">Dicen que la vida es más bella
                        si podemos cumplir con lo
                        que soñamos.</h1>
                    <a href="#"><img class="rounded-lg lg:h-full w-full object-cover shadow-2xl"
                            src="{{ asset('img/home/pexels-inna-mykytas-13925971.jpg') }}" alt=""></a>
                </figure>
            </article>


            {{-- Articulo #2 - Pensamiento #2--}}
            <article>
                <figure>
                    {{-- Background --}}
                    <div class="w-full mx-auto px-4 py-80 opacity-50 bg-center bg-no-repeat bg-cover hover:opacity-75"
                        style="background-image: url('{{ asset('img/home/pexels-moose-photos-1037994.jpg') }}')">
                        {{-- CENTRA TEXTO DENTRO DEL BACKGROUND --}}

                        <section aria-labelledby="sale-heading"
                            class="h-screen relative mx-auto flex max-w-7xl flex-col items-center px-4 text-center sm:px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:max-w-none">
                                <h2 id="sale-heading"
                                    class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">Mis XV Años</h2>
                                <p class="mx-auto mt-4 max-w-xl text-xl text-gray-600">Most of our products are limited
                                    releases that won't come back. Get your favorite items while they're in stock.</p>
                                <p class="mx-auto mt-4 max-w-sm text-6xl text-gray-600" style="font-family:Sacramento">
                                    Dejo atrás un mundo y
                                    entro a uno nuevo aunque
                                    a veces dudo o temo estoy
                                    llena de esperanzas y sueños.
                                    Tengo la sensación de que
                                    estoy construyendo mi
                                    propio camino siento
                                    alegría y quiero
                                    compartirlo rodeada de
                                    todos los que quiero.</p>
                            </div>
                        </section>
                    </div>
                </figure>
            </article>
        </div>
    </section>



    {{-- Papas y padrinos --}}
    <section aria-labelledby="sale-heading"
        class="mx-auto flex max-w-7xl flex-col items-center px-4 pt-8 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-none">
            {{-- Papas --}}
            <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-6xl">Mis
                papas</h2>
            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">Ángel Barbosa</p>
            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">Marcela Castellanos
            </p>
            {{-- Padrinos --}}
            <h2 id="sale-heading" class="mt-8 text-4xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-6xl">
                Mis
                padrinos</h2>
            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">Jaime López</p>
            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">Catalina Jiménez
            </p>

        </div>
    </section>


    <section
        class="my-16 mx-auto flex max-w-7xl flex-col items-center px-4 pt-8 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-none">
            {{-- Papas --}}
            <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-6xl">Para
                el gran dia faltan !!!</h2>
        </div>
    </section>


    <section class="mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-8 gap-x-6 gap-y-8">
            <div class="col-span-3">
                {{-- open --}}
            </div>

            {{-- Card para la iglesia --}}
            <div class="col-span-2">
                <div class="card mb-16">
                    <div class="card-body">

                        <div
                            class="mb-16 mx-auto flex max-w-7xl flex-col items-center pt-8 text-center sm:px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:max-w-none">
                                {{-- Iglesia --}}
                                <h2 id="sale-heading"
                                    class="text-4xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-6xl"
                                    style="font-family:Great Vibes">
                                    Iglesia !!!</h2>
                            </div>
                        </div>


                        {{-- imagen de la iglesia --}}
                        <img id="picture" class="object-cover object-center mx-4 p-auto rounded-lg shadow-2xl"
                            src="{{ asset('img/home/pexels-tom-fisk-1624307.jpg') }}" alt="">

                    </div>

                    <div aria-labelledby="sale-heading"
                        class="mx-auto flex max-w-7xl flex-col items-center px-4 pt-8 text-center sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl lg:max-w-none">
                            {{-- Papas --}}
                            <p class="mx-auto mt-4 max-w-xl text-5xl text-gray-600 font-bold"
                                style="font-family:Sacramento">Catedral
                                San Ildefonzo</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Hora: 05:00 p.m.
                            </p>
                            {{-- Padrinos --}}
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Great Vibes">Direccion</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">C. 60,
                                Centro, 97000</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Mérida, Yuc
                            </p>

                        </div>
                    </div>
                </div>


                {{-- Card para el salon --}}
                <div class="card">
                    <div class="card-body">

                        <div
                            class="mb-16 mx-auto flex max-w-7xl flex-col items-center pt-16 text-center sm:px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:max-w-none">
                                {{-- Iglesia --}}
                                <h2 id="sale-heading"
                                    class="text-4xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-6xl"
                                    style="font-family:Great Vibes">
                                    Salon !!!</h2>
                            </div>
                        </div>


                        {{-- imagen del salon --}}
                        <img id="picture" class="object-cover object-center mx-4 p-auto rounded-lg shadow-2xl"
                            src="{{ asset('img/home/pexels-ingo-joseph-87378.jpg') }}" alt="">

                    </div>

                    <div aria-labelledby="sale-heading"
                        class="mx-auto flex max-w-7xl flex-col items-center px-4 pt-8 text-center sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl lg:max-w-none">
                            {{-- Lugar y hora --}}
                            <p class="mx-auto mt-4 max-w-xl text-5xl text-gray-600 font-bold"
                                style="font-family:Sacramento">Hacienda
                                San Pedro Palomeque</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Hora: 07:00 p.m.
                            </p>
                            {{-- Direccion --}}
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Great Vibes">
                                Direccion</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Anillo Periferico Sur Km 4,</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Mérida, Yuc
                            </p>

                        </div>
                    </div>
                </div>


            </div>

            <div class="col-span-3">

            </div>

        </div>
    </section>




</div>