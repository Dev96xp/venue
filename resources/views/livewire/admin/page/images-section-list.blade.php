<div class="px-4 sm:px-6 lg:px-8">

    <div class="flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            {{-- nada --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">

                        @foreach ($sectionx->images as $image)

                            <tr wire:key="imagen-{{ $image->id }}"> {{-- SUPER IMPORTANTE --}}
                                <td class="whitespace-nowrap py-1 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="flex items-center" wire:click="select_page({{ $image }})">
                                        <div class="h-11 w-11 flex-shrink-0">
                                            <img class="h-11 w-11 rounded-full"
                                                src="{{ Storage::url($image->url) }}"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-bold">{{ $image->location }} </div>
                                            <div class="text-purple-500">{{ $image->imageable_type }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-3 py-1 text-sm text-gray-500">
                                    @livewire('admin.page.edit-image', ['image' => $image], key($image->id))
                                </td>

                            </tr>
                        @endforeach


                        <!-- More people... -->


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
