<div>

    <div class="mt-2 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:mx-2">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                Gallery
                                name</th>
                            </th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Code
                            </th>

                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">

                        @foreach ($user->galleries as $gallery)
                            <tr wire:key="galleria-{{ $gallery->id }}"> {{-- SUPER IMPORTANTE --}}
                                <td class="whitespace-nowrap py-1 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="flex ites-center" wire:click="select_gallery({{ $gallery }})">
                                        <div class="h-11 w-11 flex-shrink-0">
                                            <img class="h-11 w-11 rounded-full"
                                                src="https://cdn.pixabay.com/photo/2018/03/31/08/23/girl-3277529_1280.jpg"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-bold {{ $selecionado == $gallery->name ? 'text-blue-500 text-md' : '' }}"">
                                                {{ $gallery->name }} </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                    <div class="text-gray-900 font-bold">{{ $gallery->code }}</div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
