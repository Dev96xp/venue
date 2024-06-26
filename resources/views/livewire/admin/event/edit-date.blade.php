<div>

    {{-- IMPORTANTE EN VES DE USAR UN BOTON, SE CAMBIO A USAR UN LINK SOBRE LA FECHA --}}
    <a class="py-1 cursor-pointer text-sm" wire:click="$set('open', true)">
        <div class="font-roboto">

            {{ \Carbon\Carbon::parse($event->scheduled_at)->toFormattedDateString('l j F') }}
        </div>
    </a>

    <x-dialog-modal wire:model="open" class="py-6">

        <x-slot name='title'>
            Editar date {{ $event->user->name }}
        </x-slot>

        <x-slot name='content'>

            {{-- Grid con 3 columnas --}}
            <div class="grid grid-cols-3 gap-4 mb-2">
                <div class="col-span-1">
                    <x-label value="Paquete ID" />
                    <x-input wire:model.defer="eventEdit.id" type="text" class="w-full" readonly="readonly" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="eventEdit.id" />
                </div>

                <div class="col-span-2">
                    <x-label value="Nombre del cliente" />
                    <x-input wire:model.defer="eventEdit.name" type="text" class="w-full" readonly="readonly" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="eventEdit.name" />
                </div>
            </div>

            {{-- Grid con 3 columnas --}}
            <div class="grid grid-cols-3 gap-4">

                {{-- MASTER CLASS - Agrega un DATE-PICKER al input del formulario --}}

                {{-- a) En la pagina del layout: admin.blade.php se agrego:

                    b) los stilos:
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

                    c) en la parte de abajo los scripts:
                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                    d) luego la funcion creada, apuntando al, el id = #datep, que se encuentra en el Layout(Plantilla principal)  :admin.blade.php
                        <script> flatpickr('#datep') </script>

                    e) por ultimo aqui se agrega el ( id="datep" ) al elemnto para mostrar el datepicker, listo --}}


                {{-- Date Picker Parte 4/4, agregar (id="datep") --}}

                <div class="col-span-1 mb-4">
                    <x-label value="Fecha del Evento / Event Date" />
                    <x-input wire:model.defer="eventEdit.scheduled_at" type="text" class="w-full" id="datep" />
                    <x-input-error for="eventEdit.scheduled_at" />
                </div>

                {{-- <div class="col-span-1">
                    <x-label value="Tipo de Evento" />
                    <x-input wire:model.defer="eventEdit.title" type="text" class="w-full" />
                    <x-input-error for="eventEdit.title" />
                </div> --}}

                {{-- QUINCE', 'BODA', 'EVENTO ESPECIAL', 'CONFERENCIA', 'CONCIERTO' --}}
                <div>
                    <x-label value="Tipo de Evento" />
                    <select wire:model="eventEdit.title" class="form-control">
                        {{-- Este es el valor por default --}}
                        <option value="" selected disabled>Tipo de Evento</option>
                        <option value="QUINCE">QUINCE</option>
                        <option value="BODA">BODA</option>
                        <option value="FASHION SHOW">FASHION SHOW</option>
                        <option value="EVENTO ESPECIAL">EVENTO ESPECIAL</option>
                        <option value="CONFERENCIA">CONFERENCIA</option>
                        <option value="CONCIERTO">CONCIERTO</option>

                        {{-- Valores de la base de datos --}}
                        {{-- @foreach ($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach --}}
                    </select>
                </div>
            </div>



        </x-slot>

        <x-slot name='footer'>
            <div class="flex">
                <div>
                    <x-secondary-button wire:click="hide" wire:loading.attr="disabled" class="disabled:opacity-25 mr-4">
                        Ocultar Paquete
                    </x-secondary-button>
                </div>


                <div class="mr-10">
                    <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                        Cancel
                    </x-secondary-button>

                    <x-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                        Update
                    </x-danger-button>
                </div>

                {{-- Print recive --}}
                <div>
                    {{-- Print Invoice - si sirve pero solo imprime sobre hoja de impresora normal,
                                                    OJO este reporte se logra imprimir usando un controlador y no un componente de livewire --}}

                    <a class="py-1 px-4 btn btn-blue w-full" href=""
                        class="text-indigo-600 hover:text-indigo-900">Print Package</a>
                </div>



            </div>
        </x-slot>

    </x-dialog-modal>

    {{-- MASTER CLASS - Para que se ejecute el codigo de javascript de un componente de LIVEWIRE,
        hay que encerrarlo con las directivas de PUSH, @push('script') y que este lo envie a la
        plantilla pricipal, esta lo recibira travez de la directiva @stack('script') y listo  --}}
    @push('script')
        {{-- Nada de codigo de javascript por el momento --}}
    @endpush

</div>
