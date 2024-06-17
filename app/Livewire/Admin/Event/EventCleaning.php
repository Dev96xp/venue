<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use App\Models\ItemsCleaning;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class EventCleaning extends Component
{

    #[Reactive]
    public $event_id;    // (el evento selecionado, esta variable viene
                         // desde el componente[EventsIndex] y esta sincronizada)
    public $event;

    public $cleaning;    // (la bebida)
    public $cleaning_id;
    public $name, $description = "...";

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->event = Event::find($this->event_id);
        $this->cleaning = $this->event->cleaning;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->cleaning()->exists()) {
            $this->cleaning_id = $this->cleaning->id;
        } else {
            $this->cleaning_id = 0;
        }
    }

    public function render()
    {
        $this->event = Event::find($this->event_id);
        $this->cleaning = $this->event->cleaning;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->cleaning()->exists()) {
            $this->cleaning_id = $this->cleaning->id;
        } else {
            $this->cleaning_id = 0;
        }

        return view('livewire.admin.event.event-cleaning');
    }



    public function delete_element(ItemsCleaning $item)
    {
        // Borra un registro especifico, sin importar nada (relacion uno a muchos)
        $item->delete();
        //dd($item);
    }

    public function add_item()
    {
        // Validar los datos
        $this->validate();

        //dd($this->cleaning_id);

        //Si existe una relacion entre las tablas
        if ($this->event->cleaning()->exists()) {

            // Crea un nuevo item para el salon
            $itemcleaning = ItemsCleaning::create([
                'name' => $this->name,
                'description' => $this->description,
                'status' => 'open',
                'status_items_id' => 1,
                'executive_id' => auth()->user()->id, // Ejecutivo de ventas
                'cleaning_id' => $this->cleaning_id,
            ]);

        } else {
            // NO HACER NADA
        }

        $this->reset(['name','description','cleaning_id']);

    }

    public function update_status(ItemsCleaning $items_cleaning)
    {
        $items_cleaning = ItemsCleaning::find($items_cleaning->id);

        //dd($items_cleaning->status_items_cleaning_id);
        switch ($items_cleaning->status_items_id) {
                // Si es 1 lo cambio a 2
            case '1':
                $items_cleaning->status_items_id = 2;
                $items_cleaning->save();
                break;
            case '2':
                // Si es 2 lo cambio a 3
                $items_cleaning->status_items_id = 3;
                $items_cleaning->save();
                break;
            case '3':
                // Si es 3 lo cambio a 4
                $items_cleaning->status_items_id = 4;
                $items_cleaning->save();
                break;
            case '4':
                // Si es 4 lo cambio a 1
                $items_cleaning->status_items_id = 1;
                $items_cleaning->save();
                break;
            default:
                # code...
                break;
        }

    }
}
