<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Omnia\LivewireCalendar\LivewireCalendar;

class AppointmentsCalendar extends LivewireCalendar
{

    // IMPORTANTE: Este componente trabaja en conjunto con LivewireCalendar hubicado en:
    // vendor/omnia-digital/livewire-calendar/src/LiveiwreCalendear.php

    public $store_id = 1;

    // METODO  2
    public function events(): Collection
    {
        return Event::query()
            ->whereDate('scheduled_at', '>=', $this->gridStartsAt)
            ->whereDate('scheduled_at', '<=', $this->gridEndsAt)
            ->where('store_id', $this->store_id)  //Lo agregue
            ->get()
            ->map(function (Event $event) {
                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'description' => $event->title,
                    'date' => $event->scheduled_at,
                ];
            });
    }

    // public function onDayClick($year, $month, $day)
    // {
    //     // This event is triggered when a day is clicked
    //     // You will be given the $year, $month and $day for that day
    // }

    // public function onEventClick($eventId)
    // {
    //     // This event is triggered when an event card is clicked
    //     // You will be given the event id that was clicked

    // }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        // This event will fire when an event is dragged and dropped into another calendar day
        // You will get the event id, year, month and day where it was dragged to
        Event::where('id', $eventId)
            ->update(['scheduled_at' => $year.'-'.$month.'-'.$day]);

    }


    //  NO SE USA EL RENDER
    //  public function render()
    //  {
    //      return view('livewire.appointments-calendar');
    //  }


}
