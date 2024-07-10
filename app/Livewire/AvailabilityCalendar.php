<?php

namespace App\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class AvailabilityCalendar extends Component
{
    public $search;
    public $sort = 'scheduled_at';
    public $direction = 'asc'; //desc or asc ?
    public $store_id = 1;
    public $events;


    public $month_number = 7;
    public $currentDate;
    public $currentYear;
    public $currentMonth;
    //public $firstDayOfMonth = Carbon::getWeekStartsAt(); //Obtiene el primer dia del mes que puede ser de [1(lunes)-7()domindo]
    public $daysInMonth;  // El numero de dias que contiene un mes
    public $firstDayOfMonth = 1;

    public function mount()
    {
        $this->currentDate = now();
        $this->currentYear = date("Y");
        $this->currentMonth = date("F");
        $this->daysInMonth = Carbon::now()->month($this->month_number)->daysInMonth;

        $eventsx = Event::where('status', 'ACTIVE')
        ->where('store_id', $this->store_id)
        //->where('name', 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->pluck('scheduled_at');

        $this->dispatch('envio-eventos', $eventsx);
    }

    public function render()
    {
        $this->events = Event::where('status', 'ACTIVE')
            ->where('store_id', $this->store_id)
            //->where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->get();

        return view('livewire.availability-calendar');
    }

    // Solo para hacer pruebas
    #[On('post-createdxxx')]
    public function create()
    {
        dd('created!'.now());
    }


    public function provando(){

        $datox = 15;

        $eventsx = Event::where('status', 'ACTIVE')
        ->where('store_id', $this->store_id)
        //->where('name', 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->pluck('scheduled_at');
        //->get();

        //dd($event->id);

        $eventsrr = 27;

        // dispatching -  the act of sending off something
        $this->dispatch('envio-eventos', $eventsx);
    }

}
