<div>

    <div class="grid grid-cols-1 lg:grid-cols-6 gap-2">

        {{-- Images display --}}
        <div class="col-span-2">
            @if ($product->images->count())
                <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                    <h1 class="text-2xl text-center font-semibold mb-2">Images list by product - <span
                            class="text-purple">[ {{ $product->name }} ]</span></h1>

                    <ul class="flex flex-wrap">
                        @foreach ($product->images as $image)
                            {{-- MASTER CLASS
                            Para evita que livewire se confunda con el proceso de las imagenes, se le otorga una llave como se muestra abajo
                            facilitando el control de la imagenes ( wire:key="image-{{$image->id}}" ) --}}

                            <li class="relative" wire:key="image-{{ $image->id }}">
                                <img class="w-24 h-40 mr-2 object-cover" wire:click="select_image({{ $image->id }})"
                                    src="{{ Storage::url($image->url) }}" alt="">
                                {{-- Botoon que borra las imagenes --}}
                                <x-danger-button class="absolute right-2 top-2 w-8"
                                    wire:click="deleteImages({{ $image->id }})" wire.loading.attr="disabled"
                                    wire.target="deleteImages({{ $image->id }})">
                                    x
                                </x-danger-button>
                            </li>
                        @endforeach

                    </ul>
                </section>
            @endif
        </div>

        {{-- Single Image --}}
        <div class="col-span-2">
            <div class="card">

                @if ($product->images->count())
                    {{-- NUEVO - Si no existiera una imagen asignada a este producto, evita que se genere un error --}}
                    <img class="h-100 w-full object-cover" src="{{ Storage::url($image_url_selected) }}" alt="">
                @else
                    <img id="picture" class="w-full h-64 object-cover object-center"
                        src="https://images.pexels.com/photos/6147134/pexels-photo-6147134.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                        alt="">
                @endif

            </div>
        </div>


        {{-- Images list --}}
        <div class="col-span-2">
            @livewire('admin.product.images-product-list', ['product' => $product])
        </div>



    </div>



</div>
