<x-app-layout>

    {{-- USO: GALLERIA DE FOTOS PARA LA PAGINA DE FOTOGRAFIA, (ES LA CABECERA DE LA PAGINA DE FOTOGRAFIA) --}}

    <div role="main">

        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
            <ol class="carousel-indicators">
                @if ($galleryOfCarouselPrincipal)
                    {{-- @foreach ($sectionxes as $section) --}}
                    @foreach ($galleryOfCarouselPrincipal as $image)
                        @if ($loop->first)
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        @else
                            <li data-target="#myCarousel" data-slide-to="{{ $image->id }}"></li>
                        @endif
                    @endforeach
                    {{-- @endforeach --}}
                @endif
            </ol>

            <div class="carousel-inner">

                @if ($galleryOfCarouselPrincipal)
                    {{-- @foreach ($sectionxes as $section) --}}
                    @foreach ($galleryOfCarouselPrincipal as $image)
                        <div class="carousel-item @if ($loop->first) active @endif max-h-80 lg:max-h-none"> {{-- Determina la altura segun el dispositivo (max-h-80 lg:max-h-none) --}}

                            <img class="bg-cover" src="{{ Storage::url($image->url) }}" alt="{{ $image->id }}">

                            <div class="container">
                                <div class="carousel-caption text-left">
                                    <h1 class="text-4xl lg:text-6xl mb-1" style="font-family: Sche">{{ $business->name }}</h1>
                                    <p class="mb-2">Deteniendo el arte en el tiempo creando una imagenes autenticas obras de
                                        arte.
                                        La luz permite ver los colores nosotros lo capturamos
                                    </p>
                                    <p><a href="{{ route('register') }}" class="btn btn-lg btn-primary" href="#" role="button">Sign up
                                            today</a></p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- @endforeach  --}}
                @endif

            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <!-- FOOTER -->
        @livewire('footers.footer')
    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="{{ asset('js/holder.min.js') }}"></script>


</x-app-layout>
