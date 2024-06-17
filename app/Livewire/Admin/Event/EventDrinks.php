<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use App\Models\ItemsDrink;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class EventDrinks extends Component
{

    #[Reactive]
    public $event_id;    // (el evento selecionado, esta variable viene
                         // desde el componente[EventsIndex] y esta sincronizada)
    public $event;

    public $drink;    // (la bebida)
    public $drink_id;
    public $name, $description = "...";

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->event = Event::find($this->event_id);
        $this->drink = $this->event->drink;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->drink()->exists()) {
            $this->drink_id = $this->drink->id;
        } else {
            $this->drink_id = 0;
        }
    }

    public function render()
    {
        $this->event = Event::find($this->event_id);
        $this->drink = $this->event->drink;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->drink()->exists()) {
            $this->drink_id = $this->drink->id;
        } else {
            $this->drink_id = 0;
        }

        return view('livewire.admin.event.event-drinks');
    }



    public function delete_element(ItemsDrink $item)
    {
        // Borra un registro especifico, sin importar nada (relacion uno a muchos)
        $item->delete();
        //dd($item);
    }

    public function add_item()
    {
        // Validar los datos
        $this->validate();

        //dd($this->drink_id);

        //Si existe una relacion entre las tablas
        if ($this->event->drink()->exists()) {

            // Crea un nuevo item para el salon
            $itemdrink = ItemsDrink::create([
                'name' => $this->name,
                'description' => $this->description,
                'status' => 'open',
                'status_items_id' => 1,
                'executive_id' => auth()->user()->id, // Ejecutivo de ventas
                'drink_id' => $this->drink_id,
            ]);

        } else {
            // NO HACER NADA
        }

        $this->reset(['name','description','drink_id']);

    }

    public function update_status(ItemsDrink $items_drink)
    {
        $items_drink = ItemsDrink::find($items_drink->id);

        //dd($items_drink->status_items_drink_id);
        switch ($items_drink->status_items_id) {
                // Si es 1 lo cambio a 2
            case '1':
                $items_drink->status_items_id = 2;
                $items_drink->save();
                break;
            case '2':
                // Si es 2 lo cambio a 3
                $items_drink->status_items_id = 3;
                $items_drink->save();
                break;
            case '3':
                // Si es 3 lo cambio a 4
                $items_drink->status_items_id = 4;
                $items_drink->save();
                break;
            case '4':
                // Si es 4 lo cambio a 1
                $items_drink->status_items_id = 1;
                $items_drink->save();
                break;
            default:
                # code...
                break;
        }

    }
}
