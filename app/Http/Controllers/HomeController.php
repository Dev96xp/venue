<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $month_number = 7;
        $currentDate = now();
        $currentYear = date("Y");
        $currentMonth = date("F");
        $firstDayOfMonth = Carbon::getWeekStartsAt(); //Obtiene el primer dia del mes que puede ser de [1(lunes)-7()domindo]
        $daysInMonth = Carbon::now()->month($month_number)->daysInMonth;  // El numero de dias que contiene un mes
        $firstDayOfMonth = 1;

        $business = Business::first();  //Todos los datos referente a este website

        // $pages = Page::where('name','Home')
        // ->where('status', 'Active')
        // ->get();

        $pages = Page::find(1);

        $sectionxes = $pages->sectionxes;

        $headImage = '';
        $article1 = '';
        $article2 = '';
        $article3 = '';
        $article4 = '';
        $footImage1 = '';

        $whereIWork ='';

        foreach ($sectionxes as $section) {
            foreach ($section->images as $image) {
                switch ($image->location) {
                    case 'headImage':
                        $headImage = $image->url;
                        break;
                    case 'article1':
                        $article1 = $image->url;
                        break;
                    case 'article2':
                        $article2 = $image->url;
                        break;
                    case 'article3':
                        $article3 = $image->url;
                        break;
                    case 'article4':
                        $article4 = $image->url;
                        break;
                    case 'whereIWork':
                        $whereIWork = $image->url;
                        break;
                    case 'footImage1':
                        $footImage1 = $image->url;
                        break;
                    case 'open2':
                        $open2 = $image->url;
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }




        return view('welcome', compact(
            'headImage',
            'article1',
            'article2',
            'article3',
            'article4',
            'whereIWork',
            'footImage1',
            'currentDate',
            'currentYear',
            'currentMonth',
            'firstDayOfMonth',
            'daysInMonth',
            'business'

        ));
    }
}
