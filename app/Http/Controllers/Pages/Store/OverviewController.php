<?php

namespace App\Http\Controllers\Pages\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function show(Product $product){
        return view('pages/store/page1/overview',compact('product'));
    }
}
