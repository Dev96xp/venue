<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){

        $month_number = 7;
        $currentDate = now();
        $currentYear = date("Y");
        $currentMonth = date("F");
        $firstDayOfMonth = Carbon::getWeekStartsAt(); //Obtiene el primer dia del mes que puede ser de [1(lunes)-7()domindo]
        $daysInMonth = Carbon::now()->month($month_number)->daysInMonth;  // El numero de dias que contiene un mes
        $firstDayOfMonth = 1;

        return view('welcome',compact('currentDate', 'currentYear', 'currentMonth','firstDayOfMonth','daysInMonth'));
    }
}

