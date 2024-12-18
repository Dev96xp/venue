<?php

namespace App\Http\Controllers\Pages\Photography;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Page;
use Illuminate\Http\Request;

class PhotographyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $business = Business::first();  //Todos los datos referente a este website

        // Es un helper, que obtiene y registra un nuevo ip address(visitante nr)
        get_ip_address($request);

        $pages = Page::find(6);     // Por defult #6 es para la pagina photography

        $sectionxes = $pages->sectionxes;   // Por defult un apagina incluye varias sectiones

        // Se obtiene la PRIMERA section solamente para usarla en el carousel principal
        $galleryOfCarouselPrincipal = $sectionxes->first()->images;       // imagenes para el carrousel principal

        //dd($galleryPrincipal);

        $heading1 = '';
        $heading2 = '';
        $heading3 = '';
        $heading4 = '';

        $blog1p = '';
        $blog2p = '';
        $blog3p = '';

        $parallaxImage1 = '';
        $parallaxImage2 = '';



        foreach ($sectionxes as $section) {
            foreach ($section->images as $image) {
                switch ($image->location) {
                    case 'heading1':
                        $heading1 = $image->url;
                        break;
                    case 'heading2':
                        $heading2 = $image->url;
                        break;
                    case 'heading3':
                        $heading3 = $image->url;
                        break;
                    case 'heading4':
                        $article4 = $image->url;
                        break;
                    case 'blog1p':
                        $blog1p = $image->url;
                        break;
                    case 'blog2p':
                        $blog2p = $image->url;
                        break;
                    case 'blog3p':
                        $blog3p = $image->url;
                        break;
                    case 'blog4p':
                        $blog4p = $image->url;
                        break;
                    case 'parallaxImage1':
                        $parallaxImage1 = $image->url;
                        break;
                    case 'parallaxImage2':
                        $parallaxImage2 = $image->url;
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }


        return view('pages.photography.index', compact(
            'business',
            'galleryOfCarouselPrincipal',
            'sectionxes',
            'heading1',
            'heading2',
            'heading3',
            'heading4',
            'blog1p',
            'blog2p',
            'blog3p',
            'parallaxImage1',
            'parallaxImage2',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
