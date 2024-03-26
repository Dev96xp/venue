<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Section;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        //$section = Section::find(1);
        $invitation = Invitation::find(1);
        return view('customer.index',compact('invitation'));
    }
}
