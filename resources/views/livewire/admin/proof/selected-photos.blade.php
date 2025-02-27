<div>
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Imagenes selecionadas por el cliente<</h1>

    </div>
    {{-- Un simple grid de tres columnas --}}
    <div class="grid grid-cols-3">

        @foreach ($images as $image)
            <div class="ml-2 mt-2">
                <div class="{{ $imagen_selecionada == $image->name ? 'text-gray-500 text-sm' : '' }}">
                    {{ Str::of($image->url)->substr(20) }} </div>
            </div>
        @endforeach

    </div>
</div>
