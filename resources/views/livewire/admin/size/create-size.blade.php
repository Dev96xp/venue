<div>
    {{-- NOTA: Este componente de livewire,
    contiene algunos componente de jetstream --}}

    {{-- wire:click="$set('open', true) - Manda decir que se fije el valor igual a : true,
    a la propiedad de llamada: open ,que vive en el componente --}}


    <div class="flex items-center">

        <div class="mr-4">

            {{-- Button --}}
            <x-button wire:click="$set('open', true)" class="mb-1" color='blue'>
                Size
            </x-button>

        </div>

    </div>


    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear/Selecionar Size:
            <div>
                {{ $product->group->name }}
            </div>
        </x-slot>

        <x-slot name="content">




            {{-- Grid con 4 columnas --}}
            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-2 mb-4">

                    <div>
                        <h1 class="mb-2 font-bold">Grupos de tallas</h1>
                        {{-- El select esta sincronizado con la propiedad group_id --}}
                        <select wire:model="group_id" class="form-control w-full">
                            {{-- Este es el valor por default --}}
                            <option value="" selected disabled>Grupo de Tallas</option>

                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('group_id')
                            <strong class="text-xs text-red-600">{{ $message }}</strong>
                        @enderror
                    </div>

                </div>

                {{-- All Sizes List --}}
                <div class="col-span-2 mb-4">

                    <div>
                        <x-label value="Crear new size" />
                        <x-input wire:model.defer="name" type="text" class="w-full" />
                        {{-- Revisa por alhun error de validacion --}}
                        <x-input-error for="name" />
                    </div>
                    <div class="mt-2">
                        <x-danger-button wire:click="save" class="mb-4">
                            Crear Size
                        </x-danger-button>
                    </div>

                    {{-- Si por lo menos hay un registro se muestra la tabla --}}
                    @if ($sizes->count())

                        <div class="table-wrapper h-80 overflow-y-scroll">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Size name
                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($sizes as $size)
                                        <tr>

                                            {{-- Size name --}}
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $size->name }}</div>
                                            </td>

                                            {{-- Add Size --}}

                                            <td>
                                                <x-danger-button wire:click="add_size_xp('{{ $size->id }}')">
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


            {{-- Grid con 4 columnas --}}
            <div class="grid grid-cols-4 gap-4">

                <div class="col-span-4">
                    <x-label value="Lista de Colores" />
                    <x-input wire:model.defer="list" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="list" />
                </div>
                <div class="col-span-4 mb-4">
                    <p class="mb-1">Limpia todas las tallas del grupo selecionado</p>
                    <x-danger-button wire:click="delete_size">
                        Limpiar tallas
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
                    <x-danger-button wire:click="update_product_size()">
                        Update
                    </x-danger-button>
                @break

                @default
            @endswitch
        </x-slot>

    </x-dialog-modal>
</div>
