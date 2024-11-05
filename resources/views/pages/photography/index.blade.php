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
                        <div class="carousel-item @if ($loop->first) active @endif max-h-80 lg:max-h-none w-full"> {{-- Determina la altura segun el dispositivo (max-h-80 lg:max-h-none) --}}

                            <img class="bg-cover w-full" src="{{ Storage::url($image->url) }}" alt="{{ $image->id }}">

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


        <!-- Marketing messaging and featurettes
      ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-4">

                    <img class="mx-auto mb-3" src="{{ Storage::url($heading1) }}" alt="Generic placeholder image"
                        width="400" height="200">

                    <h2>Creating Memories</h2>
                    <p>"My goal is to help you create lasting memories that evoke emotions and tell your story for
                        generations."</p>
                    {{-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> --}}
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="mx-auto mb-3" src="{{ Storage::url($heading2) }}" alt="Generic placeholder image"
                        width="400" height="200">
                    <h2>Professional Expertise</h2>
                    <p>"With my experience and passion for photography, you can trust that you'll receive high-quality
                        images that exceed your expectations.".</p>
                    {{-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> --}}
                </div><!-- /.col-lg-4 -->

                <div class="col-lg-4">
                    <img class="mx-auto mb-3" src="{{ Storage::url($heading3) }}" alt="Generic placeholder image"
                        width="400" height="200">
                    <h2>"Elevate Your Brand with Stunning Photography!"</h2>
                    <p>
                        Are you looking to showcase your business in the best light? Whether it’s professional
                        headshots, product photography, or captivating images for your website and marketing materials,
                        I’m here to help you bring your vision to life.

                        With an eye for detail and a passion for storytelling, I create high-quality images that not
                        only highlight the essence of your business but also connect with your audience on a deeper
                        level.

                        If you’re ready to take your business to the next level with exceptional photography, I’d love
                        to chat with you! Contact me today to learn more about my services and how I can help you
                        capture the perfect shot for your brand.

                        Let’s create something amazing together!</p>
                        <p>{{ $business->name }}</p>
                        <p>{{ $business->phone }}</p>
                        <p>{{ $business->email }}</p>
                    {{-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> --}}
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Capturing <span class="text-muted">Moments</span></h2>
                    <p class="lead">"I love freezing beautiful moments in time, creating images that you can treasure
                        for years to come."</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" src="{{ Storage::url($blog1) }}"
                        alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading">Personal<span class="text-muted">Touch</span></h2>
                    <p class="lead">"Every session is tailored to reflect your unique personality and story, ensuring
                        that your photos truly represent you."</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img class="featurette-image img-fluid mx-auto" src="{{ Storage::url($blog2) }}"
                        alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Attention<span class="text-muted">to Detail</span>
                    </h2>
                    <p class="lead">"I pay close attention to the little details, from lighting to composition, to
                        create stunning images that stand out."</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" src="{{ Storage::url($blog3) }}"
                        alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


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
