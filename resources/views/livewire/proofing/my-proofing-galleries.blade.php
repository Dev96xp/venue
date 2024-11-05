{{-- USO: (Proofing) - Muestra la gallery de fotos de el cliente, para realizar proofing --}}

{{-- METODO 1 - EFECTO MASONRY LAYOUT --}}
{{-- <div class="columns-4 gap-3 w-[1200px] mx-auto apace-y-3 pb-28">    ORIGINAL --}}

<div>
    <div class="mb-4 text-gray-500">
        <h1>Imagenes selecionadas: {{ $proofed_images->count() }} of {{ $images->count() }}</h1>
    </div>
    <div class="columns-1 md:columns-3 lg:columns-5 gap-3 w-full mx-auto apace-y-3 pb-28">

        @if ($images->count())
            @foreach ($images as $image)
                <div class="relative">

                    <a href="{{ Storage::url($image->url) }}" data-lightbox="models"
                        data-title="{{ Str::of($image->url)->substr(20) }}">
                        <div class="bg-gray-200 break-inside-avoid mb-3">
                            <img src="{{ Storage::url($image->url) }}" alt="">
                        </div>
                    </a>
                    <div class="absolute bottom-2 left-2 text-gray-50">
                        {{ Str::of($image->url)->substr(20) }}
                    </div>

                    @switch($image->status)
                        @case(1)
                            <span>
                                <buttons
                                    class="btn btn-orange ml-2 px-2 py-0 absolute bottom-2 right-2 font-normal text-white text-sm"
                                    wire:click="update_proof_status({{ $image->id }})">
                                    ?</buttons>
                            </span>
                        @break

                        @case(2)
                            <span>
                                <buttons
                                    class="btn btn-fuchsia ml-2 px-2 py-0 absolute bottom-2 right-2 font-normal text-white text-sm"
                                    wire:click="update_proof_status({{ $image->id }})">
                                    Selected</buttons>
                            </span>
                        @break

                        @default
                    @endswitch

                </div>
            @endforeach
        @else
            <h1>Not images available</h1>
        @endif


        {{-- Esto pone los links de navegacion de la pagina, en la parte de abajo --}}
        {{-- <div class="px-6 py-4">
            {{ $images->links() }}
        </div> --}}
    </div>
</div>
