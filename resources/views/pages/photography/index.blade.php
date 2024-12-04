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
                        <div
                            class="carousel-item @if ($loop->first) active @endif max-h-80 lg:max-h-none w-full">
                            {{-- Determina la altura segun el dispositivo (max-h-80 lg:max-h-none) --}}

                            <img class="bg-cover w-full" src="{{ Storage::url($image->url) }}"
                                alt="{{ $image->id }}">

                            <div class="container">
                                <div class="carousel-caption text-left">
                                    <h1 class="text-4xl lg:text-6xl mb-1 font-extrabold"
                                        style="font-family: Montserrat">
                                        {{ $business->name }}</h1>
                                    <p class="mb-2">Deteniendo el arte en el tiempo, creando videos como autenticas
                                        obras de
                                        arte.
                                        La luz permite ver los colores nosotros lo capturamos
                                    </p>

                                    @auth
                                    @else
                                        <p><a href="{{ route('register') }}" class="btn btn-lg btn-gray" href="#"
                                                role="button">Sign up
                                                today</a></p>
                                    @endauth

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

                    <h2 class="text-xl font-bold">Conservando nuestros recuerdos</h2>

                    <p>"Tenemos paquetes de video y fotografia con todo incluido, se puede seleccionar el que mas se
                        adapte a tu presupuesto. Tambien existen paquetes de fotografia o solo video, todas la
                        impresiones se realizan en materiales de la mas alta calidad."</p>
                    <p> Llamanos por cualquier pregunta respecto a nuestro trabajo

                        PALACE PRODUCTIONS 308-627-9989</p>


                    {{-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> --}}
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="mx-auto mb-3" src="{{ Storage::url($heading2) }}" alt="Generic placeholder image"
                        width="400" height="200">
                    <h2 class="text-xl font-bold">Professional Expertise</h2>
                    <p>"With my experience and passion for photography, you can trust that you'll receive high-quality
                        images that exceed your expectations.".</p>
                    {{-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> --}}
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="mx-auto mb-3" src="{{ Storage::url($heading3) }}" alt="Generic placeholder image"
                        width="400" height="200">
                    <h2 class="text-xl font-bold">"Elevate Your Brand with Stunning Photography!"</h2>
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
        </div>


        {{-- MASTER CLASS - PARALLAX EFFECT - (bg-fixed bg-center bg-no-repeat bg-cover)
                                         min-h-screen - OCUPA TODA LA ALTURA DE PANTALLA
                                         opacity-75 - Detremina la opacity Inicial
                                         hover:opacity-100 - Elimina el opacity --}
            {{-- foot Image ParallaxImage1 --}}
        <section class="mt-16 opacity-75 relative bg-fixed bg-cover bg-center bg-no-repeat hover:opacity-100"
            style="background-image: url('{{ Storage::url($parallaxImage1) }}')">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-48">
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="text-white text-bold text-6xl py-6 justify-center font-Playfair Display SC">Working
                        with
                        Love</h1>
                    {{-- <h1 class="text-white text-bold text-4xl">
                        Means
                    </h1>
                    <p class="text-white font-bold text-lg mt-2 mb-4 backdrop-brightness-5">
                        Easy Access to Decorating Experts Ensuring Quality Outputs from Concept to Completion
                    </p> --}}

                </div>
            </div>
        </section>

        {{-- Marketing with  IMAGES --}}
        <div class="container marketing">

            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading text-2xl mb-2">Capturing <span class="text-muted">Moments</span></h2>
                    <p class="lead">"I love freezing beautiful moments in time, creating images that you can treasure
                        for years to come."</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" src="{{ Storage::url($blog1p) }}" alt="blog1p">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading text-2xl mb-2">Personal<span class="text-muted"> Touch</span></h2>
                    <p class="lead">"Every session is tailored to reflect your unique personality and story, ensuring
                        that your photos truly represent you."</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img class="featurette-image img-fluid mx-auto" src="{{ Storage::url($blog2p) }}" alt="blog2p">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading text-2xl mb-2">Attention<span class="text-muted"> to Detail</span>
                    </h2>
                    <p class="lead">"I pay close attention to the little details, from lighting to composition, to
                        create stunning images that stand out."</p>
                </div>
                <div class="col-md-5">
                    <img class="featurette-image img-fluid mx-auto" src="{{ Storage::url($blog3p) }}" alt="blog3p">
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->



        {{-- Marketing with  VIDEO --}}
        <div class="container marketing">

            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h1 class="featurette-heading text-2xl mb-2">Capturing <span class="text-muted">Moments on
                            Video</span></h1>
                    <p class="lead">"Para nosotros el detalle es lo que cuenta, sobre todo hacer lucir tu hermoso
                        vestido y tenerlo
                        en video para verlo y volverlo a ver cuantas veces quieras, por eso es muy importante usar lo
                        ultimo tecnologia
                        para la filmacion"</p>
                </div>
                <div class="col-md-5">

                    {{-- Add controls=0 to NOT display controls in the video player.
                    controls=0 - Player controls does not display.
                    controls=1 (default) - Player controls is displayed. --}}

                    <iframe class="w-full h-96" src="https://www.youtube.com/embed/z1pbhHgB79Q" title="promo"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>


                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading text-2xl mb-2">Personal<span class="text-muted"> Touch</span></h2>
                    <p class="lead">"Nos encanta la gran variedad de temas sobre quinceañeras que existen,
                        una de nuestras favoritas es la de Charro, una tradicion muy Mexicana y lucen espectaculares,
                        mas cuando usamos drones para la filmacion"</p>
                </div>

                <div class="col-md-5 order-md-1">
                    <iframe class="w-full h-96" src="https://www.youtube.com/embed/BvG8zgC106s" title="Adrianna XV"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        {{-- MASTER CLASS - PARALLAX EFFECT - (bg-fixed bg-center bg-no-repeat bg-cover)
                                         min-h-screen - OCUPA TODA LA ALTURA DE PANTALLA
                                         opacity-75 - Detremina la opacity Inicial
                                         hover:opacity-100 - Elimina el opacity --}
        {{-- foot Image ParallaxImage2 --}}
        <section class="mt-16 opacity-75 relative bg-fixed bg-cover bg-center bg-no-repeat hover:opacity-100"
            style="background-image: url('{{ Storage::url($parallaxImage2) }}')">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-48">
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="text-white text-bold text-6xl py-6 justify-center font-Playfair Display SC">Working with
                        Love</h1>
                    {{-- <h1 class="text-white text-bold text-4xl">
                        Means
                    </h1>
                    <p class="text-white font-bold text-lg mt-2 mb-4 backdrop-brightness-5">
                        Easy Access to Decorating Experts Ensuring Quality Outputs from Concept to Completion
                    </p> --}}

                </div>
            </div>
        </section>


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
