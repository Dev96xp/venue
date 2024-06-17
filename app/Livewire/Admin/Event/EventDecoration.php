<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use App\Models\ItemsDecoration;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class EventDecoration extends Component
{

    #[Reactive]
    public $event_id;    // (el evento selecionado, esta variable viene
                         // desde el componente[EventsIndex] y esta sincronizada)
    public $event;

    public $decoration;    // (la decoracion)
    public $decoration_id;
    public $name, $description = "...";

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->event = Event::find($this->event_id);
        $this->decoration = $this->event->decoration;  //ahora

        //Si existe una relacion entre las tablas
        if ($this->event->decoration()->exists()) {
            $this->decoration_id = $this->decoration->id;
        } else {
            $this->decoration_id = 0;
        }
    }

    public function render()
    {
        $this->event = Event::find($this->event_id);
        $this->decoration = $this->event->decoration;  //ahora

        //dd($this->decoration);

        //Si existe una relacion entre las tablas
        if ($this->event->decoration()->exists()) {
            $this->decoration_id = $this->decoration->id;
        } else {
            $this->decoration_id = 0;
        }

        return view('livewire.admin.event.event-decoration');
    }



    public function delete_element(ItemsDecoration $item)
    {
        // Borra un registro especifico, sin importar nada (relacion uno a muchos)
        $item->delete();
        //dd($item);
    }

    public function add_item()
    {
        // Validar los datos
        $this->validate();

        //dd($this->decoration_id);

        //Si existe una relacion entre las tablas
        if ($this->event->decoration()->exists()) {

            // Crea un nuevo item para el salon
            $itemdecoration = ItemsDecoration::create([
                'name' => $this->name,
                'description' => $this->description,
                'status' => 'open',
                'status_items_id' => 1,
                'executive_id' => auth()->user()->id, // Ejecutivo de ventas
                'decoration_id' => $this->decoration_id,
            ]);

        } else {
            // NO HACER NADA
        }

        $this->reset(['name','description','decoration_id']);

    }

    public function update_status(ItemsDecoration $items_decoration)
    {
        $items_decoration = ItemsDecoration::find($items_decoration->id);

        //dd($items_decoration->status_items_decoration_id);
        switch ($items_decoration->status_items_id) {
                // Si es 1 lo cambio a 2
            case '1':
                $items_decoration->status_items_id = 2;
                $items_decoration->save();
                break;
            case '2':
                // Si es 2 lo cambio a 3
                $items_decoration->status_items_id = 3;
                $items_decoration->save();
                break;
            case '3':
                // Si es 3 lo cambio a 4
                $items_decoration->status_items_id = 4;
                $items_decoration->save();
                break;
            case '4':
                // Si es 4 lo cambio a 1
                $items_decoration->status_items_id = 1;
                $items_decoration->save();
                break;
            default:
                # code...
                break;
        }

    }
}

