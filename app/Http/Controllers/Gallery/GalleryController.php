<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(){
        $pages = Page::find(2);

        $sectionxes = $pages->sectionxes;

        return view('pages.gallery.index',compact('sectionxes'));
    }
}
