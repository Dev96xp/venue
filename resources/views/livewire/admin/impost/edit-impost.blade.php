<div>
    {{-- Button --}}
    <div>
        <button wire:click="$set('open', true)" type="button"
            class="block rounded-md bg-indigo-600 px-3 py-1 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</button>
    </div>

    <x-dialog-modal wire:model="open" class="py-6">

        <x-slot name='title'>
            Editar Impost
        </x-slot>

        <x-slot name='content'>


            <div class="grid grid-cols-1 gap-4 mb-2">
                <div class="col-span-1">
                    <x-label value="Name" />
                    <x-input wire:model.defer="impostEdit.name" type="text" class="w-full" />
                    {{-- Revisa por alhun error de validacion --}}
                    <x-input-error for="impostEdit.name" />
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-2 mt-4">

                {{-- Lista de todos los taxes --}}
                <div class="col-span-1">
                    {{-- Si por lo menos hay un registro se muestra la tabla --}}
                    @if ($impost->taxes->count())

                        <div class="table-wrapper h-80 overflow-y-scroll">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tax by group(imposts)
                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($impost->taxes as $tax)
                                        <tr>

                                            {{-- Size name --}}
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $tax->name }}</div>
                                            </td>

                                            {{-- Tax --}}
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $tax->tax }}</div>
                                            </td>

                                            {{-- Add Size --}}
                                            <td>
                                                <x-danger-button wire:click="del_tax('{{ $tax->id }}')">
                                                    del
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

                <div class="col-span-1">
                    {{-- Si por lo menos hay un registro se muestra la tabla --}}
                    @if ($taxs->count())

                        <div class="table-wrapper h-80 overflow-y-scroll">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            all taxs
                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($taxs as $tax)
                                        <tr>

                                            {{-- Size name --}}
                                            <td class="px-6 py-2 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $tax->name }}</div>
                                            </td>

                                            {{-- Add Size --}}

                                            <td>
                                                <x-danger-button wire:click="add_tax('{{ $tax->id }}')">
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

        <x-slot name='footer'>
            <div class="flex">

                <div class="mr-10">
                    <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                        Cancel
                    </x-secondary-button>

                    <x-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                        Update
                    </x-danger-button>
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
