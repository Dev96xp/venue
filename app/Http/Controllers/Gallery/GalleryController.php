<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Ipx;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Es un helper, que obtiene y registra un nuevo ip address(visitante nr)
        get_ip_address($request);

        $pages = Page::find(2);     // Por defult #2 es para solo para gallery


        $sectionxes = $pages->sectionxes;
        return view('pages.gallery.index', compact('sectionxes'));
    }
}
