<x-app-layout>


    <div class="bg-white">
        <div class="mx-auto max-w-8xl px-4 py-4 sm:px-6 lg:px-8 lg:pb-24">
            <div class="max-w-xl pl-16">
                <h1 class="text-2xl font-bold tracking-tight text-gray-700 sm:text-3xl">My Images - Proofing</h1>
                <h1 class="text-gray-500">XXXX-XXXX-{{ substr($account->acc_id, -4) }} {{ auth()->user()->name }}</h1>

                <p class="mt-2 text-sm text-gray-500">Selecciona las fotografias para revelar, presionando
                    el boton con el signo de interogacion, una vez selecionadas. Las fotografias estaran aqui
                    por un mes, para su selecion </p>
            </div>

            <div class="mt-4 mb-4">

                <div class="grid grid-cols-1 lg:grid-cols-7 gap-4">
                    {{-- Lista de Gallerias por cliente --}}
                    <div class="col-span-2">

                        @livewire('proofing.my-galleries-list', ['user' => $user], key($user->id))

                    </div>
                    {{-- USO: IMAGENES POR GALLERYA PARA EL CLIENTE (ESPECIFICO DE UNA SESION PHOTOGRAPICA) --}}
                    <div class="col-span-5">

                        @if ($gallery)
                            @livewire('proofing.my-proofing-galleries', ['gallery' => $gallery], key($gallery->id))
                        @else
                            <h1>Not proofing gallery images available</h1>
                        @endif

                    </div>



                </div>

            </div>


        </div>
    </div>


    @livewire('footers.footer')


    {{-- MASTER CLASS - Recuerda este linea apunta directamente hacia el archivo por debajo de la carpeta publica --}}
    <script src="{{ asset('js/lightbox-plus-jquery.js') }}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': false, //Permite volver a empezar a ver la galleria
            'alwaysShowNavOnTouchDevices': true
        })
    </script>

    </div>
</x-app-layout>
