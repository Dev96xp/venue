<div>
    {{-- NOTA: Este componente de livewire,
    contiene algunos componente de jetstream --}}

    {{-- wire:click="$set('open', true) - Manda decir que se fije el valor igual a : true,
    a la propiedad de llamada: open ,que vive en el componente --}}


    <div class="flex items-center">

        {{-- NO MODAL - BOTON Y LISTA --}}
        <div class="mr-4">

            <button wire:click="$set('open', true)"
                class="bg-blue-400 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded text-uppercase text-sm">
                Add element
            </button>

        </div>

    </div>


    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Add Element
        </x-slot>

        <x-slot name="content">

            {{-- Grid con 4 columnas --}}
            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-1 mb-4">

                </div>


                {{-- Colors List --}}
                <div class="col-span-3 mb-4">
                    {{-- Si por lo menos hay un registro se muestra la tabla --}}
                    @if ($elements->count())

                        <div class="table-wrapper h-80 overflow-y-scroll">
                            <table class="min-w-full divide-y divide-gray-200">

                                {{-- <table class="uk-table" style="table-layout: fixed"> --}}
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Color name
                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($elements as $element)
                                        <tr>
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $element->id }}
                                            </td>

                                            {{-- Color name --}}
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $element->code }} -
                                                    {{ $element->name }}</div>
                                            </td>

                                            {{-- Add Color --}}

                                            <td>
                                                <x-danger-button wire:click="add_element('{{ $element->id }}')">
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
