<div class="w-full">

    {{-- YA NO SE ESTA USANDO EL COMPONENTE TEMPORALMENTE, ESTA EN EVALUACION --}}



    {{-- INSTALAR DROPZONE
    Parte 1 - Copiar links de css en (https://cdnjs.com/libraries/dropzone) y ponerlo aqui --}}
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
            integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    {{-- Button --}}
    <div>
        <button wire:click="$set('open', true)" type="button"
            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
    </div>


    {{-- Modal --}}
    <x-dialog-modal wire:model="open" maxWidth="7xl">
        <x-slot name="title">
            Upload Images
            {{-- {{ $section->name }} --}}
        </x-slot>

        <x-slot name="content">

            <div class="grid grid-cols-1 gap-4 mb-3">
                {{-- Images display --}}
                <div class="col-span-1">
                    <div class="container">


                        @if ($gallery->images->count())
                            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                                <h1 class="text-2xl text-center font-semibold mb-2">Images list by Section -
                                    <span class="text-purple">[ {{ $gallery->name }} ]</span>
                                </h1>

                                <ul class="flex flex-wrap">
                                    @foreach ($gallery->images as $image)
                                        <li class="relative" wire:key="image-{{ $image->id }}">
                                            <img class="w-24 h-40 mr-2 object-cover"
                                                wire:click="select_image({{ $image->id }})"
                                                src="{{ Storage::url($image->url) }}" alt="">
                                            {{-- Botoon que borra las imagenes --}}
                                            <x-danger-button class="absolute right-2 top-2 w-8"
                                                wire:click="deleteImages({{ $image->id }})"
                                                wire.loading.attr="disabled"
                                                wire.target="deleteImages({{ $image->id }})">
                                                x
                                            </x-danger-button>
                                        </li>
                                    @endforeach
                                </ul>


                            </section>
                        @endif


                        {{-- METODO #2 DROPZONE PARA SUBIR VARIAS IMAGENES AL MISMO TIEMPO --}}

                        {{-- Parte 3 Copiar el formulario que se encargara de mostrar el DROPZONE
                                     y ejecutar las de acciones necesarias para el metodo store, de
                                 (https://docs.dropzone.dev/getting-started/setup/declarative) --}}

                        <form action="{{ route('admin.proof.save_images', $gallery) }}" method="POST" class="dropzone"
                            id="my-awesome-dropzone">
                        </form>


                    </div>
                </div>

                <div class="col-span-1">
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="create_page">
                Create
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>


    {{-- MASTER CLASS - Para que se ejecute el codigo de javascript de un componente de LIVEWIRE,
        hay que encerrarlo con las directivas de PUSH, @push('script') y que este lo envie a la
        plantilla pricipal, esta lo recibira travez de la directiva @stack('script') y listo  --}}
    @push('js')
        {{-- Parte 2 - Copiar links de js en (https://cdnjs.com/libraries/dropzone) y pegar aqui --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

        {{-- Parte 4 - Agregar las configuraciones (options) adicionales para el DROPZONE de
                     (https://docs.dropzone.dev/getting-started/setup/declarative) --}}

        {{-- Parte 5 - Importante que el nombe del id del formulario sea
                   el mismo que el de las cofiguraciones, con el formato apropiado(camelizado)
                   y listo ya se suben las imagenes --}}

        <script>
            // Note that the name "myDropzone" is the camelized
            // id of the form.
            Dropzone.options.myAwesomeDropzone = {
                // Configuration options go here
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro", // 2. Mensaje por default
                acceptedFiles: 'image/*', // 3. Solo acepta imagenes
                paramName: 'file', // The name that will be used to transfer the file
                //maxFilesize: 3, // Maximo tamaño de la imagen en MEGAS
                //maxFiles: 6, //Maximo de imagenes a procesar al mismo tiempo

                complete: function(file) { // Cuando termina de subir una imagen desaparece
                    this.removeFile(file);
                },

                queuecomplete: function() { // Se emite un evento de livewire
                    //Livewire.emit('refreshSection'); // Manda ejecutar el listener, en el componente: DisplayImages

                    //alert('Hola !!!');

                    // IMPORTANTE: Este dispatch(emit), envia dato al componente,
                    // NO OLVIDES PONER LA ULTIMA COMA
                    // DESPUES DE ENVIAR EL ULTIMO PARAMETRO
                    Livewire.dispatch('refresh-gallery'), {
                        //open_modal: true,
                        //date: info.dateStr,
                    };

                    Livewire.dispatch('render-list-images'), {};
                },
            }
        </script>
    @endpush


</div>
