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


    {{-- SECCTION 2  --}}
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


            {{-- Articulo #2 - Pensamiento #2 --}}
            <article>

                <div style="background: url('{{ asset('img/home/pexels-karolina-grabowska-4041285.jpg') }}')"
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

    </section>


    {{-- iglesia y salon--}}
    <section class="mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-8 gap-x-6 gap-y-8">
            <div class="col-span-3">
                {{-- open --}}
            </div>

            {{-- Card para la iglesia --}}
            <div class="col-span-2">
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
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600 font-bold"
                                style="font-family:Great Vibes">
                                Direccion</p>
                            <p class="mx-auto mt-4 max-w-xl text-4xl text-gray-600" style="font-family:Sacramento">C.
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


            </div>

            <div class="col-span-3">
                {{-- open --}}
            </div>

        </div>
    </section>


    <script>
        function timer(expiry) {
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
                        value: this.remaining / 86400,
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
