<x-app-layout>

    {{-- <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            padding: 0 4px;
        }

        .column {
            flex: 25%;
            max-width: 25%;
            padding: 0 4px;
        }
    </style>

        {{-- METODO 1 - EFECTO MASONRY LAYOUT --}}
    {{-- <div class="columns-4 gap-3 w-[1200px] mx-auto apace-y-3 pb-28">    ORIGINAL --}}
    <div class="mx-3">
        <div class="columns-1 lg:columns-4 gap-3 w-full mx-auto apace-y-3 pb-28">
            @foreach ($sectionxes as $section)
                @foreach ($section->images as $image)
                    <a href="">
                        <div class="bg-gray-200 break-inside-avoid mb-3">
                            <img src="{{ Storage::url($image->url) }}" alt="">
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>

    {{-- METODO 2
    <div class="grid grid-cols-4 gap-4">
        <div class="">
            @foreach ($sectionxes as $section)
                @foreach ($section->images as $image)
                    <div class="row">
                        <div class="column">
                            <div>
                                <img src="{{ Storage::url($image->url) }}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>

    </div> --}}

    {{-- METODO 3 --}}
    {{-- <div class="bg-white">
        <div class="mx-auto max-w-7xl overflow-hidden px-4 py-8 sm:px-6 sm:py-24 lg:px-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-3 lg:grid-cols-4 lg:gap-x-4">

                @foreach ($sectionxes as $section)
                    @foreach ($section->images as $image)
                        <a href="#" class="group text-sm">
                            <div
                                class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                                <img src="{{ Storage::url($image->url) }}"
                                    alt="White fabric pouch with white zipper, black zipper pull, and black elastic loop."
                                    class="h-full w-full object-cover object-center">
                            </div>
                        </a>
                    @endforeach
                @endforeach

            </div>
        </div>
    </div> --}}


</x-app-layout>
