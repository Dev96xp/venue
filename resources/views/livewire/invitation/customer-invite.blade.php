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

</div>
