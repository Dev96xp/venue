<div class="col-span-12 sm:col-span-6 lg:col-span-6">
    {{-- card - HEADER - Venues - Personal --}}
    <div class="flex flex-row bg-white shadow-sm rounded p-3">

        <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
            <i class="fas fa-archway"></i>
        </div>

        <div class="flex flex-col flex-grow ml-4">

            @if ($event->personal()->exists())
                <div class="text-lg text-blue-500">Personal</div>
                <div><span class="text-bold"> {{ $personal->name }}</span></div>
            @else
                <div class="text-lg text-gray-500">Personal</div>
                <div><span class="text-bold"> NO APLICA</span></div>
            @endif

        </div>
    </div>


    {{-- Lista 1 - De los ELEMENTOS(la tabla itemsVenue) QUE COMPONEN EL SALON --}}
    <div class="mt-2 shadow bg-gray-200 top-100 z-40 w-full lef-0 rounded max-h-select svelte-5uyqqj">
        <div>

            @if ($event->personal()->exists())

                @foreach ($personal->items_personals as $item)
                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-blue-100">
                        <div
                            class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-blue-100">

                            <div class="w-4 flex flex-col items-center">
                                <div
                                    class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full">
                                    <img class="rounded-full" alt="A"
                                        src="https://randomuser.me/api/portraits/men/62.jpg">
                                </div>
                            </div>

                            <div class="w-full">
                                <div class="mx-2 -mt-1  ">{{ $item->name }}
                                    <div class="text-xs w-full normal-case font-normal -mt-1 text-gray-500">
                                        {{ $item->description }}</div>
                                </div>
                            </div>

                            <div class="mr-2">

                                @switch($item->status_items_id)
                                    @case(1)
                                        <span>
                                            <buttons class="btn btn-orange ml-2 px-2 py-0 font-normal text-white text-sm"
                                                wire:click="update_status({{ $item }})">{{ $item->status_items->name }}</buttons>
                                        </span>
                                    @break

                                    @case(2)
                                        <span>
                                        <buttons class="btn btn-blue ml-2 px-2 py-0 font-normal text-white text-sm"
                                        wire:click="update_status({{ $item }})">{{ $item->status_items->name }}</buttons>
                                        </span>
                                    @break

                                    @case(3)
                                    <span>
                                        <buttons class="btn btn-green ml-2 px-2 py-0 font-normal text-white text-sm"
                                        wire:click="update_status({{ $item }})">{{ $item->status_items->name }}</buttons>
                                        </span>
                                    @break

                                    @case(4)
                                    <span>
                                        <buttons class="btn btn-red ml-2 px-2 py-0 font-normal text-white text-sm"
                                        wire:click="update_status({{ $item }})">{{ $item->status_items->name }}</buttons>
                                        </span>
                                    @break

                                    @default
                                @endswitch



                            </div>

                            <div class="w-6 mr-1">
                                <button class="btn btn-danger mr-2 py-0 px-2"
                                    wire:click="delete_element({{ $item }})"> - </button>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                {{-- No mostrar nada --}}
            @endif

        </div>
    </div>

    {{-- card - footer --}}
    <div class=" bg-white shadow-sm rounded p-1 mt-1">

        {{-- Variable open = false --}}
        <div x-data="{ open: false }">
            {{-- Cuando se de un click, la variable open = true --}}
            <a x-show="!open" x-on:click="open = true" class="mx-2 cursor-pointer">
                <i class="far fa-plus-square text-sm text-red-500 mr-2"></i>
                <span class="text-sm">Agregar nuevo item</span>
            </a>

            {{-- Por que se agrego card a un articule? --}}
            <article class="card" x-show="open">
                <div class="card-body">
                    <h1 class="text-sm mb-2">Agregar nuevo item</h1>

                    <div class="mb-2">

                        {{-- Se va a mostrar el formulario de Editar --}}
                        <div class="mb-2">
                            <input wire:model="name" class="form-control w-full">
                        </div>
                        <div>
                            <input wire:model="description" class="form-control w-full">
                        </div>

                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end m-0">
                        <button class="btn btn-danger" x-on:click="open = false">Cancelar</button>
                        <button class="btn btn-primary ml-2" wire:click="add_item"
                            x-on:click="open = false">Agregar</button>
                    </div>
                </div>
            </article>
        </div>

    </div>

</div>
