<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class EditDate extends Component
{

    //#[Reactive]
    public $event_id;    // ($event_id, es el evento selecionado, esta variable viene
                         // desde el componente[EventsIndex] y esta sincronizada)

    public $open = false;
    public $event, $type = 5;
    public $eventEditId;


    // 1.  Crear una propiedad que tenga los mismos campos del formulario
    public $eventEdit = [
        'id' => 'required',
        'date' => 'required',
        'name' => 'required'
    ];

    public function mount(Event $event){

        $this->event = $event;
        $this->event_id = $event->id;
        $this->eventEditId = $this->event->id;

        $event = Event::find($this->event->id);
        $this->eventEditId = $this->event->id;

        // Muesta estos valores en el formulario
        $this->eventEdit['id'] = $event->id;
        $this->eventEdit['date'] = $event->date;
        $this->eventEdit['name'] = $event->name;

    }

    public function render()
    {
        $this->event = Event::find($this->event->id);
        $this->eventEditId = $this->event->id;

        // Muesta estos valores en el formulario
        $this->eventEdit['id'] = $this->event->id;
        $this->eventEdit['date'] = $this->event->date;
        $this->eventEdit['name'] = $this->event->name;

        return view('livewire.admin.event.edit-date');
    }

    // MASTER CLASS - Actualiza la fecha
    // a) Llamamos a la propiedad: event
    // b) Le pasamos el metodo: save
    // c) Esto va ser que cualquier cambio que hallamos hecho
    // en la propiedad : event, se actualice en la base de datos

    public function save(){

        $event = Event::find($this->eventEditId);

        $event->update([
            'date' => $this->eventEdit['date'],
        ]);

        $this->reset(['open','eventEdit','eventEditId']);

        // DISPATCH - Emite un evento, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-events');

    }

    public function hide(){

        $this->event->status ='HIDE';
        $this->event->save();  //Guardar los cambios
        $this->reset(['open']); //Reset la variable open, para cerra el formulario(Modal)

        $this->dispatch('render-events');
    }

}
