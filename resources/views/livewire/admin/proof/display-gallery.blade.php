<div class="w-full">

    <div class="grid grid-cols-1 gap-4 mb-3">
        {{-- Images display --}}
        <div class="col-span-1">
            <div class="container">


                @if ($gallery->images->count())
                    <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                        <h1 class="text-2xl text-center font-semibold mb-2">Images list by Section -
                            <span class="text-purple">[ {{ $gallery->name }} ]</span>
                        </h1>

                        <ul class="flex flex-wrap">
                            @foreach ($gallery->images as $image)
                                <li class="relative mb-2" wire:key="image-{{ $image->id }}">

                                    <img class="w-24 h-40 mr-2 object-cover rounded-md"
                                        wire:click="select_image({{ $image->id }})"
                                        src="{{ Storage::url($image->url) }}" alt="">

                                    {{-- Botoon que borra las imagenes --}}
                                    <x-danger-button class="absolute right-2 top-2 w-8"
                                        wire:click="deleteImages({{ $image->id }})"
                                        wire.loading.attr="disabled"
                                        wire.target="deleteImages({{ $image->id }})">
                                        x
                                    </x-danger-button>
                                </li>
                            @endforeach
                        </ul>


                    </section>
                @endif

            </div>
        </div>

        <div class="col-span-1">
        </div>
    </div>

</div>
