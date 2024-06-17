<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use App\Models\ItemsPersonal;
use App\Models\ItemsVenue;
use App\Models\Venue;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class EventPersonal extends Component

{

    // A qui voy.........


    #[Reactive]
    public $event_id;    // (el evento selecionado, esta variable viene
                         // desde el componente[EventsIndex] y esta sincronizada)
    public $event;

    public $personal;    // (el salon)
    public $personal_id;
    public $name, $description = "...";

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->event = Event::find($this->event_id);
        $this->personal = $this->event->personal;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->personal()->exists()) {
            $this->personal_id = $this->personal->id;
        } else {
            $this->personal_id = 0;
        }
    }

    public function render()
    {
        $this->event = Event::find($this->event_id);
        $this->personal = $this->event->personal;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->personal()->exists()) {
            $this->personal_id = $this->personal->id;
        } else {
            $this->personal_id = 0;
        }

        return view('livewire.admin.event.event-personal');
    }



    public function delete_element(ItemsPersonal $item)
    {
        // Borra un registro especifico, sin importar nada (relacion uno a muchos)
        $item->delete();
        //dd($item);
    }

    public function add_item()
    {
        // Validar los datos
        $this->validate();

        //dd($this->personal_id);

        //Si existe una relacion entre las tablas
        if ($this->event->personal()->exists()) {

            // Crea un nuevo item para el salon
            $itempersonal = ItemsPersonal::create([
                'name' => $this->name,
                'description' => $this->description,
                'status' => 'open',
                'status_items_id' => 1,
                'executive_id' => auth()->user()->id, // Ejecutivo de ventas
                'personal_id' => $this->personal_id,
            ]);

        } else {
            // NO HACER NADA
        }

        $this->reset(['name','description','personal_id']);

    }

    public function update_status(ItemsPersonal $items_personal)
    {
        $items_personal = ItemsPersonal::find($items_personal->id);

        //dd($items_personal->status_items_personal_id);
        switch ($items_personal->status_items_id) {
                // Si es 1 lo cambio a 2
            case '1':
                $items_personal->status_items_id = 2;
                $items_personal->save();
                break;
            case '2':
                // Si es 2 lo cambio a 3
                $items_personal->status_items_id = 3;
                $items_personal->save();
                break;
            case '3':
                // Si es 3 lo cambio a 4
                $items_personal->status_items_id = 4;
                $items_personal->save();
                break;
            case '4':
                // Si es 4 lo cambio a 1
                $items_personal->status_items_id = 1;
                $items_personal->save();
                break;
            default:
                # code...
                break;
        }

    }
}


