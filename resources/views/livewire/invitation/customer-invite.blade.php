<div>
    {{-- SECCTION 1 - Imagen Principal --}}
    <section>

        {{-- Si existe la variable $section1 y ademas tiene una imagen relaicionada, que imprima, de lo contrario q lo ignore --}}
        @isset($section1->images)
            {{-- MASTER CLASS - $product->images->count() - Evita un error cuando no existen imagenes --}}
            @if ($section1->images->count())

                {{-- MUESTRA UNA LA PRIMERA IMAGENDE ESTA SECTION --}}
                <div class="w-full mx-auto px-4 sm:px-6 lg:px-64 py-40 opacity-75 relative bg-center bg-no-repeat bg-cover hover:opacity-100"
                    style="background-image: url('{{ Storage::url($section1->images->first()->url) }}')">
                    <div class="w-full md:w-3/4 lg:w-3/4">
                        <p class="text-black text-6xl md:text-8xl lg:text-8xl py-6" style="font-family: Sche">Violeta Jones
                        </p>
                        <p class="text-fuchsia-500 text-2xl md:text-5xl lg:text-5xl font-bold"
                            style="font-family: Montserrat">
                            Invitation
                        </p>
                    </div>
                </div>

            @else
                <div class="w-full mx-auto px-4 sm:px-6 lg:px-64 py-40 opacity-75 relative bg-center bg-no-repeat bg-cover hover:opacity-100"
                    style="background-image: url(https://images.pexels.com/photos/185933/pexels-photo-185933.jpeg)">
                    <div class="w-full md:w-3/4 lg:w-3/4">
                        <p class="text-fuchsia-500 text-2xl md:text-5xl lg:text-5xl font-bold"
                            style="font-family: Montserrat">
                            No image
                        </p>
                    </div>
                </div>
            @endif
        @else
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-64 py-40 opacity-75 relative bg-center bg-no-repeat bg-cover hover:opacity-100"
                style="background-image: url(https://images.pexels.com/photos/185933/pexels-photo-185933.jpeg)">
                <div class="w-full md:w-3/4 lg:w-3/4">
                    <p class="text-fuchsia-500 text-2xl md:text-5xl lg:text-5xl font-bold" style="font-family: Montserrat">
                        No image
                    </p>
                </div>
            </div>
        @endisset

    </section>


    {{-- SECCTION 2 Pensamiento #1 y Segunga foto --}}
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
                            src="{{ Storage::url($section2->images->first()->url) }}" alt=""></a>
                </figure>
            </article>


            {{-- Articulo #2 - Pensamiento #2 --}}
            <article>

                <div style="background: url('{{ Storage::url($section3->images->first()->url) }}')"
                    class="w-full bg-center bg-no-repeat bg-cover bg-opacity-50">

                    <!-- Overlay Background + Center Control -->
                    <div class="w-full bg-opacity-50 bg-black flex items-center justify-center"
                        style="background:rgba(0,0,0,0.3);">

                        <div class="py-20 mx-2 text-center">
                            <h1 class="my-12 text-gray-100 font-extrabold text-4xl xs:text-5xl md:text-6xl">
                                <span class="text-white">Mis Quince Años</span>
                            </h1>
                            <h2 class="my-12 text-gray-200 font-extrabold text-7xl xs:text-4xl md:text-5xl leading-tight"
                                style="font-family:Tangerine">
                                Violeta Jones
                            </h2>
                            <p class="mx-auto mt-4 max-w-sm text-6xl text-gray-200" style="font-family:Sacramento">
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
                    </div>
                </div>

            </article>
        </div>
    </section>


    {{-- Papas y padrinos --}}
    <section aria-labelledby="sale-heading"
        class="mx-auto flex max-w-7xl flex-col items-center px-4 pt-8 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-none">
            {{-- Papas --}}
            <h2 id="sale-heading" class="text-4xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-5xl">Mis
                papas</h2>
            <p class="mx-auto mt-4 max-w-xl text-5xl text-gray-600" style="font-family:Sacramento">Ángel Barbosa</p>
            <p class="mx-auto mt-4 max-w-xl text-5xl text-gray-600" style="font-family:Sacramento">Marcela Castellanos
            </p>
            {{-- Padrinos --}}
            <h2 id="sale-heading" class="mt-8 text-4xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-5xl">
                Mis
                padrinos</h2>
            <p class="mx-auto mt-4 max-w-xl text-5xl text-gray-600" style="font-family:Sacramento">Jaime López</p>
            <p class="mx-auto mt-4 max-w-xl text-5xl text-gray-600" style="font-family:Sacramento">Catalina Jiménez
            </p>

        </div>
    </section>


    <section class="my-16 mx-auto flex max-w-7xl flex-col items-center px-4 pt-8 text-center sm:px-6 lg:px-8">
        {{-- Foto de background --}}
        <div style="background: url('{{ asset('img/home/pexels-karolina-grabowska-4041285.jpg') }}')"
            class="py-8 w-full bg-center bg-no-repeat bg-cover">

            {{-- Para el gran dia faltan --}}
            <div class="mx-auto">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-5xl">Para
                    el gran dia faltan !!!</h2>
            </div>

            {{-- Timer --}}
            <div class="flex-1 flex flex-col items-start justify-center">
                <div class="mt-8 flex flex-col items-center ml-2">
                    <p class="text-gray-300 uppercase text-sm">Puedo decir otra cosa !</p>
                    <div class="flex items-center justify-center space-x-4 mt-4" x-data="timer(new Date().setDate(new Date().getDate() + 1))"
                        x-init="init();">
                        <div class="flex flex-col items-center px-4">
                            <span x-text="time().days" class="text-4xl lg:text-5xl text-gray-600">00</span>
                            <span class="text-gray-400 mt-2">Days</span>
                        </div>
                        <span class="w-[1px] h-24 bg-gray-400"></span>
                        <div class="flex flex-col items-center px-4">
                            <span x-text="time().hours" class="text-4xl lg:text-5xl text-gray-600">23</span>
                            <span class="text-gray-400 mt-2">Hours</span>
                        </div>
                        <span class="w-[1px] h-24 bg-gray-400"></span>
                        <div class="flex flex-col items-center px-4">
                            <span x-text="time().minutes" class="text-4xl lg:text-5xl text-gray-600">59</span>
                            <span class="text-gray-400 mt-2">Minutes</span>
                        </div>
                        <span class="w-[1px] h-24 bg-gray-400"></span>
                        <div class="flex flex-col items-center px-4">
                            <span x-text="time().seconds" class="text-4xl lg:text-5xl text-gray-600">28</span>
                            <span class="text-gray-400 mt-2">Seconds</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- iglesia y salon --}}
    <section class="mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-8 gap-x-6 gap-y-8">
            <div class="col-span-3">
                {{-- open --}}
            </div>

            {{-- Card para la iglesia --}}
            <div class="col-span-2">

                {{-- Foto de background --}}
                {{-- < style="background: url('{{ asset('img/home/pexels-karolina-grabowska-4041285.jpg') }}')"
                    class="w-full bg-center bg-no-repeat bg-cover bg-opacity-20"> --}}

                <div class="card mb-16">
                    <div class="card-body">




                        <div class="mb-8 mx-auto flex max-w-7xl flex-col items-center pt-8 text-center sm:px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:max-w-none">
                                {{-- Iglesia --}}
                                <h2 id="sale-heading"
                                    class="text-5xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-6xl"
                                    style="font-family:Great Vibes">
                                    Iglesia !!!</h2>
                            </div>
                        </div>


                        {{-- imagen de la iglesia --}}
                        <img id="picture"
                            class="opacity-50 object-cover object-center mx-4 p-auto rounded-lg shadow-2xl"
                            src="{{ asset('img/home/pexels-tom-fisk-1624307.jpg') }}" alt="">

                    </div>

                    {{-- Lugar y hora de la iglesia --}}
                    <div aria-labelledby="sale-heading"
                        class="mx-auto flex max-w-7xl flex-col items-center px-4 pt-8 text-center sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl lg:max-w-none">
                            {{-- Lugar y hora de la iglesia --}}
                            <p class="mx-auto mt-4 max-w-xl text-5xl text-gray-600 font-bold"
                                style="font-family:Sacramento">Catedral
                                San Ildefonzo</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Hora: 05:00 p.m.
                            </p>
                            {{-- Direccion --}}
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600 font-bold"
                                style="font-family:Great Vibes">
                                Direccion</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                C.
                                60,
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
                            class="mb-8 mx-auto flex max-w-7xl flex-col items-center pt-16 text-center sm:px-6 lg:px-8">
                            <div class="mx-auto max-w-2xl lg:max-w-none">
                                {{-- Iglesia --}}
                                <h2 id="sale-heading"
                                    class="text-5xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-6xl"
                                    style="font-family:Great Vibes">
                                    Salon !!!</h2>
                            </div>
                        </div>


                        {{-- imagen del salon --}}
                        <img id="picture"
                            class="opacity-50 object-cover object-center mx-4 p-auto rounded-lg shadow-2xl"
                            src="{{ asset('img/home/pexels-ingo-joseph-87378.jpg') }}" alt="">

                    </div>


                    {{-- Lugar y hora del salon --}}
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
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600 font-bold"
                                style="font-family:Great Vibes">
                                Direccion</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Anillo Periferico Sur Km 4,</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">
                                Mérida, Yuc
                            </p>

                        </div>
                    </div>
                </div>

                {{-- TIMELINE = INTINERARIO --}}

                <!-- component -->
                <div class="p-4 max-w-md mx-auto pt-20 flow-root">
                    <ul role="list" class="-mb-8">
                        {{-- PARTE 1 --}}
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-300"
                                    aria-hidden="true"></span>
                                <div class="relative flex space-x-3">

                                    <div class="mr-2">
                                        <span
                                            class="h-12 w-12 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path
                                                    d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-lg text-gray-500">Desayuno con la familia <a href="#"
                                                    class="font-medium text-gray-900">en casa</a></p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-lg text-gray-500">
                                            <time datetime="2020-09-20">8:30am</time>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        {{-- PARTE 2 --}}
                        <li>
                            <div class="relative pb-4">
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"
                                    aria-hidden="true"></span>
                                <div class="relative flex space-x-3">

                                    <div class="mr-2">
                                        <span
                                            class="h-12 w-12 rounded-full  flex items-center justify-center ring-8 ring-gray-200">
                                            <img class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true"
                                                src="https://t3.ftcdn.net/jpg/04/14/78/90/360_F_414789044_6xD0f4z9YcHfQimfnighWoUCIqgEJ66G.jpg" />

                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-lg text-gray-500">Preparativos <a href="#"
                                                    class="font-medium text-gray-900">maquillaje y peinado</a></p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-lg text-gray-500">
                                            <time datetime="2020-09-22">9:30am</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- PARTE 3 --}}
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"
                                    aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                            class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white">
                                            <img class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true"
                                                src="https://c8.alamy.com/comp/2RC5DTJ/taking-off-plane-logo-2RC5DTJ.jpg"
                                                clip-rule="evenodd" />

                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-500">on plane ready to fly <a href="#"
                                                    class="font-medium text-gray-900"> to london</a></p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                            <time datetime="2020-09-28">Sep 28</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- PARTE 4 --}}
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"
                                    aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                            class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white">
                                            <img class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true"
                                                src="https://res.cloudinary.com/teepublic/image/private/s--AwgOGWhQ--/t_Resized%20Artwork/c_fit,g_north_west,h_954,w_954/co_ffffff,e_outline:48/co_ffffff,e_outline:inner_fill:48/co_ffffff,e_outline:48/co_ffffff,e_outline:inner_fill:48/co_bbbbbb,e_outline:3:1000/c_mpad,g_center,h_1260,w_1260/b_rgb:eeeeee/c_limit,f_auto,h_630,q_auto:good:420,w_630/v1615488250/production/designs/20135311_0.jpg" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-500">with driver <a href="#"
                                                    class="font-medium text-gray-900">on the way to you</a></p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                            <time datetime="2020-09-30">Sep 30</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- PARTE 5 --}}
                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                            class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-500">wait outside the door <a href="#"
                                                    class="font-medium text-gray-900">the driver is close</a></p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                            <time datetime="2020-10-04">Oct 4</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>



                <!-- component -->
                <div class="min-h-screen bg-blue-500 py-6 flex flex-col justify-center sm:py-12">
                    <div class="py-3 sm:max-w-xl sm:mx-auto w-full px-2 sm:px-0">

                        <div class="relative text-gray-700 antialiased text-sm font-semibold">

                            <!-- Vertical bar running through middle -->
                            <div
                                class="hidden sm:block w-1 bg-blue-300 absolute h-full left-1/2 transform -translate-x-1/2">
                            </div>

                            <!-- Left section, set by justify-start and sm:pr-8 -->
                            <div class="mt-6 sm:mt-0 sm:mb-12">
                                <div class="flex flex-col sm:flex-row items-center">
                                    <div class="flex justify-start w-full mx-auto items-center">
                                        <div class="w-full sm:w-1/2 sm:pr-8">
                                            <div class="p-4 bg-white rounded shadow">
                                                Now this is a story all about how,
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="rounded-full bg-blue-500 border-white border-4 w-8 h-8 absolute left-1/2 -translate-y-4 sm:translate-y-0 transform -translate-x-1/2 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Right section, set by justify-end and sm:pl-8 -->
                            <div class="mt-6 sm:mt-0 sm:mb-12">
                                <div class="flex flex-col sm:flex-row items-center">
                                    <div class="flex justify-end w-full mx-auto items-center">
                                        <div class="w-full sm:w-1/2 sm:pl-8">
                                            <div class="p-4 bg-white rounded shadow">
                                                My life got flipped turned upside down,
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="rounded-full bg-blue-500 border-white border-4 w-8 h-8 absolute left-1/2 -translate-y-4 sm:translate-y-0 transform -translate-x-1/2 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Left section, set by justify-start and sm:pr-8 -->
                            <div class="mt-6 sm:mt-0 sm:mb-12">
                                <div class="flex flex-col sm:flex-row items-center">
                                    <div class="flex justify-start w-full mx-auto items-center">
                                        <div class="w-full sm:w-1/2 sm:pr-8">
                                            <div class="p-4 bg-white rounded shadow">
                                                And I'd like to take a minute, just sit right there,
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="rounded-full bg-blue-500 border-white border-4 w-8 h-8 absolute left-1/2 -translate-y-4 sm:translate-y-0 transform -translate-x-1/2 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Right section, set by justify-end and sm:pl-8 -->
                            <div class="mt-6 sm:mt-0">
                                <div class="flex flex-col sm:flex-row items-center">
                                    <div class="flex justify-end w-full mx-auto items-center">
                                        <div class="w-full sm:w-1/2 sm:pl-8">
                                            <div class="p-4 bg-white rounded shadow">
                                                I'll tell you how I became the Prince of a town called Bel Air.
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="rounded-full bg-blue-500 border-white border-4 w-8 h-8 absolute left-1/2 -translate-y-4 sm:translate-y-0 transform -translate-x-1/2 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
            </div>

            <div class="col-span-3">
                {{-- open --}}
            </div>

        </div>
    </section>


    <script>
        function timer(expiry) {
            var dias_restantes = 5; //Yo agregue esto para pruebas
            return {

                expiry: expiry,

                remaining: null,
                init() {
                    this.setRemaining()
                    setInterval(() => {
                        this.setRemaining();
                    }, 1000);
                },
                setRemaining() {
                    const diff = this.expiry - new Date().getTime();
                    this.remaining = parseInt(diff / 1000);
                },
                days() {
                    return {
                        value: this.remaining * dias_restantes / 86400,
                        remaining: this.remaining % 86400
                    };
                },
                hours() {
                    return {
                        value: this.days().remaining / 3600,
                        remaining: this.days().remaining % 3600
                    };
                },
                minutes() {
                    return {
                        value: this.hours().remaining / 60,
                        remaining: this.hours().remaining % 60
                    };
                },
                seconds() {
                    return {
                        value: this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time() {
                    return {
                        days: this.format(this.days().value),
                        hours: this.format(this.hours().value),
                        minutes: this.format(this.minutes().value),
                        seconds: this.format(this.seconds().value),
                    }
                },
            }
        }
    </script>

</div>
