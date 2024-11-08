<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-700">Imagenes SELECIONADAS POR EL CLIENTE de la galleria: <span
                        class="text-green">{{ $gallery->name }}</span></h1>

            </div>

        </div>
        <div class="mt-2 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                    Image
                                    name</th>
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Status
                                </th>

                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">


                            @foreach ($images as $image)
                                <tr wire:key="photos-{{ $image->id }}"> {{-- SUPER IMPORTANTE --}}
                                    <td class="whitespace-nowrap py-1 pl-4 pr-3 text-sm sm:pl-0">
                                        <div class="flex ites-center">

                                            @if ($images->count())
                                                <div class="h-11 w-11 flex-shrink-0">
                                                    <img class="h-11 w-11 rounded-full"
                                                        src="{{ Storage::url($image->url) }}" alt="">
                                                </div>
                                            @else
                                            @endif

                                            <div class="ml-2 mt-2">
                                                <div
                                                    class="{{ $imagen_selecionada == $image->name ? 'text-gray-500 text-md' : '' }}">
                                                    {{ Str::of($image->url)->substr(20) }} </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                        <div class="text-gray-900">{{ $image->status }}</div>
                                    </td>



                                </tr>
                            @endforeach

                            <!-- More people... -->


                        </tbody>
                    </table>
                {{-- Esto pone los links de navegacion de la pagina, en la parte de abajo --}}
                <div class="px-6 py-4">
                    {{ $images->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>



</div>
