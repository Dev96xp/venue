<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use App\Models\ItemsVenue;
use App\Models\Venue;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class EventSalon extends Component
{
    #[Reactive]
    public $event_id;    // (el evento selecionado, esta variable viene desde el componente[EventsIndex]
    // y esta sincronizada)
    public $event;
    public $venue;    // (el salon)
    public $venue_id;
    public $name, $description = "...";

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->event = Event::find($this->event_id);
        $this->venue = $this->event->venue;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->venue()->exists()) {
            $this->venue_id = $this->venue->id;
        } else {
            $this->venue_id = 0;
        }
    }

    public function render()
    {
        $this->event = Event::find($this->event_id);
        $this->venue = $this->event->venue;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->venue()->exists()) {
            $this->venue_id = $this->venue->id;
        } else {
            $this->venue_id = 0;
        }



        return view('livewire.admin.event.event-salon');
    }

    public function delete_element(ItemsVenue $item)
    {
        // Borra un registro especifico, sin importar nada (relacion uno a muchos)
        $item->delete();
        //dd($item);
    }

    public function add_item()
    {
        // Validar los datos
        $this->validate();

        //dd($this->venue_id);

        //Si existe una relacion entre las tablas
        if ($this->event->venue()->exists()) {

            // Crea un nuevo item para el salon
            $itemvenue = ItemsVenue::create([
                'name' => $this->name,
                'description' => $this->description,
                'status' => 'open',
                'status_items_id' => 1,
                'executive_id' => auth()->user()->id, // Ejecutivo de ventas
                'venue_id' => $this->venue_id,
            ]);
        } else {
            // NO HACER NADA
        }

        $this->reset(['name', 'description', 'venue_id']);
    }

    public function update_status(ItemsVenue $items_venue)
    {
        $items_venue = ItemsVenue::find($items_venue->id);

        //dd($items_venue->status_items_venue_id);
        switch ($items_venue->status_items_id) {
                // Si es 1 lo cambio a 2
            case '1':
                $items_venue->status_items_id = 2;
                $items_venue->save();
                //dd($items_venue->status_items_venue_id);
                break;
            case '2':
                // Si es 2 lo cambio a 3
                $items_venue->status_items_id = 3;
                $items_venue->save();
                break;
            case '3':
                // Si es 3 lo cambio a 4
                $items_venue->status_items_id = 4;
                $items_venue->save();
                break;
            case '4':
                // Si es 4 lo cambio a 1
                $items_venue->status_items_id = 1;
                $items_venue->save();
                break;
            default:
                # code...
                break;
        }

        // MASTER CLASS - REFRESCA al componente por tanto la vista tambien.
        //$this->$items_venue = $this->$items_venue->fresh();
    }
}
