<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function index()
    {
        return view('admin.locations.index');
    }
}
