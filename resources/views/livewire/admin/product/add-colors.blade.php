<div>

    <div class="flex items-center">

        {{-- NO MODAL - BOTON Y LISTA --}}
        <div class="mr-4">

            {{-- Button --}}
            <x-button wire:click="$set('open', true)" class="mb-1">
                Color
            </x-button>
        </div>
    </div>


    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear/Selecionar Color
        </x-slot>

        <x-slot name="content">

            {{-- Grid con 4 columnas --}}
            <div class="grid grid-cols-6 gap-4 mb-6">

                {{-- BUSCAR COLOR --}}
                <div class="col-span-2 mb-1">
                    <div>
                        <x-label value="Buscar color" />
                        <x-input wire:model="search" type="text" class="w-full" />
                        {{-- Revisa por alhun error de validacion --}}
                        <x-input-error for="search" />
                    </div>
                </div>

                {{-- VACIO --}}
                <div class="col-span-2 mb-1">
                    {{-- VACIO --}}
                </div>

                {{-- CREAR NUEVO COLOR --}}
                <div class="col-span-2 mb-1">
                    <div>
                        <x-label value="Crear new color" />
                        <x-input wire:model.defer="name" type="text" class="w-full" />
                        {{-- Revisa por alhun error de validacion --}}
                        <x-input-error for="name" />
                    </div>
                    <div class="mt-2">
                        <x-danger-button wire:click="save">
                            Crear Color
                        </x-danger-button>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-6 gap-2">

                {{-- ALL COLORS LIST --}}
                <div class="col-span-3 mb-2">
                    {{-- Si por lo menos hay un registro se muestra la tabla --}}
                    @if ($colors->count())

                        <div class="table-wrapper h-80 overflow-y-scroll">
                            <table class="min-w-full divide-y divide-gray-200">

                                {{-- <table class="uk-table" style="table-layout: fixed"> --}}
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            All colors
                                        </th>

                                        <th scope="col" class="relative px-3 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($colors as $color)
                                        <tr>

                                            {{-- Color name --}}
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $color->code }} -
                                                    {{ $color->name }}</div>
                                            </td>

                                            {{-- Add Color --}}

                                            <td>
                                                <x-danger-button wire:click="add_color('{{ $color->id }}')">
                                                    Add
                                                </x-danger-button>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        {{-- EN EL CASO DE QUE NO HAYA REGISTROS --}}
                    @else
                        <div class="px-6 py-4">
                            No hay ningun registro coincidente
                        </div>
                    @endif

                </div>

                {{-- Color List BY PRODUCT --}}
                <div class="col-span-3 mb-2">

                    {{-- Si por lo menos hay un registro se muestra la tabla --}}
                    @if ($product->colors->count())

                        <div class="table-wrapper h-80 overflow-y-scroll">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Colors by product
                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($product->colors as $color)
                                        <tr>
                                            {{-- Color name --}}
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $color->name }}</div>
                                            </td>
                                            {{-- DELETE Color --}}
                                            <td>
                                                <x-danger-button class="px-1"
                                                    wire:click="delete_color_list('{{ $color->id }}')">
                                                    x
                                                </x-danger-button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- EN EL CASO DE QUE NO HAYA REGISTROS --}}
                    @else
                        <div class="px-2 py-0">
                            No hay ningun color
                        </div>
                    @endif

                </div>

            </div>

            {{-- Grid con 4 columnas --}}
            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-4">
                    <x-label value="Lista de Colores" />
                    <x-input wire:model.defer="list" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="list" />
                </div>

                <div class="col-span-4 mb-4">
                    <x-danger-button wire:click="delete_color">
                        Limpiar colors
                    </x-danger-button>
                </div>
            </div>


        </x-slot>

        <x-slot name="footer">

            <x-secondary-button wire:click="$set('open', false)">
                Ok
            </x-secondary-button>

            @switch($botton_type)
                @case('nada')
                    {{-- nada --}}
                @break

                @case('edit')
                    <x-danger-button wire:click="update('{{ $tuxedo }}')">
                        Update User
                    </x-danger-button>
                @break

                @default
            @endswitch
        </x-slot>

    </x-dialog-modal>

</div>
