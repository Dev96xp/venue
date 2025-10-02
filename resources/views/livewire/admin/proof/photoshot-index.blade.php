<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">

        <div class="py-1 px-1 grid grid-cols-1 lg:grid-cols-4 gap-2">

            {{-- Selecionar TIENDA --}}
            <div class="col-span-2">

                {{-- El select esta sincronizado con la propiedad color --}}
                <select wire:model.live="store_id" class="form-control w-full">
                    {{-- Este es el valor por default --}}
                    <option value="" selected disabled>Store</option>

                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="col-span-2">
                <input wire:keydown="limpiar_page" wire:model="search" placeholder="Escriba un nombre..."
                    class="form-control w-full">
            </div>

        </div>

        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            @livewire('admin.proof.create-photoshot')
        </div>


    </div>
    <div class="mt-4 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Cliente
                                name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Photoshot
                                day
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">

                        @foreach ($photoshots as $photoshot)
                            <tr wire:key="photo-{{ $photoshot->id }}"> {{-- SUPER IMPORTANTE --}}

                                {{-- Hace diferencia entre meses pares e impares --}}
                                {{-- MES PAR --}}
                                @if (\Carbon\Carbon::parse($photoshot->scheduled_at)->month % 2 == 1)
                                    <td class="whitespace-nowrap py-1 pl-4 pr-3 text-sm sm:pl-0">
                                        <div class="flex items-center"
                                            wire:click="select_photoshot({{ $photoshot }})">

                                            {{-- Image --}}
                                            <div class="h-11 w-11 flex-shrink-0">
                                                <img class="h-11 w-11 rounded-full"
                                                    src="https://cdn.pixabay.com/photo/2018/03/31/08/23/girl-3277529_1280.jpg"
                                                    alt="">
                                            </div>

                                            {{-- Name --}}
                                            <div class="ml-4">
                                                <div
                                                    class="font-bold {{ $selecionado == $photoshot->name ? 'text-blue-500 text-md' : '' }}">
                                                    {{ $photoshot->name }} </div>
                                                <div class="text-gray-900">{{ $photoshot->addres }}</div>
                                                <div class="text-blue-500">{{ $photoshot->phone }} -
                                                    {{ $photoshot->city }}, {{ $photoshot->zip }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Date --}}
                                    <td class="font-bold whitespace-nowrap px-3 py-1 text-sm text-gray-500 bg-blue-100">
                                        {{ \Carbon\Carbon::parse($photoshot->scheduled_at)->toFormattedDateString('l j F') }}
                                    </td>
                                @else
                                    <td class="whitespace-nowrap py-1 pl-4 pr-3 text-sm sm:pl-0">
                                        <div class="flex items-center"
                                            wire:click="select_photoshot({{ $photoshot }})">

                                            {{-- Image --}}
                                            <div class="h-11 w-11 flex-shrink-0">
                                                <img class="h-11 w-11 rounded-full"
                                                    src="https://cdn.pixabay.com/photo/2018/03/31/08/23/girl-3277529_1280.jpg"
                                                    alt="">
                                            </div>

                                            {{-- Name --}}
                                            <div class="ml-4">
                                                <div
                                                    class="font-bold {{ $selecionado == $photoshot->name ? 'text-blue-500 text-md' : '' }}">
                                                    {{ $photoshot->name }} </div>
                                                <div class="text-gray-900">{{ $photoshot->addres }}</div>
                                                <div class="text-blue-500">{{ $photoshot->phone }} -
                                                    {{ $photoshot->city }}, {{ $photoshot->zip }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Date --}}
                                    <td class="font-bold whitespace-nowrap px-3 py-1 text-sm text-gray-500 bg-white">
                                        {{ \Carbon\Carbon::parse($photoshot->scheduled_at)->toFormattedDateString('l j F') }}
                                    </td>
                                @endif

                            </tr>
                        @endforeach


                        <!-- More people... -->


                    </tbody>
                </table>
                {{-- Esto pone los links de navegacion de la pagina, en la parte de abajo --}}
                <div class="px-6 py-4">
                    {{ $photoshots->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
