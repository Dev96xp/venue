<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\On;

class EventReviews extends Component
{
    public $event;
    public $event_id, $comment;
    public $rating = 5;
    public $showDiv = false;


    protected $rules = [
        'comment' => 'required'
    ];

    public function mount(Event $event)
    {
        $this->event_id = $event->id;
    }

    public function render()
    {

        // $appointments = Appointment::where('store_id', $this->store_id)
        // ->where('status','ACTIVE')
        // ->where('name','LIKE', '%' . $this->search .'%')
        // ->orderBy($this->sort, $this->direction)
        // ->paginate(20);

        // $notes = $this->event->notes;



        // (2/3) - Aqui se otorga otra vez ese valor
        $event = $this->event;
        // (3/3) - Y se le otorga ala vista
        return view('livewire.admin.event.event-reviews', compact('event'));
    }

    #[On('send-data-reviews')] //ESCUCHADOR DE EVENTO
    public function sendData(Event $send_event)
    {
        $event = $send_event;

        // (1/3) - Aqui se recibe el event enviado
        $this->event = $event;
        $this->event_id = $event->id;

        // METODO 2: Determina si se mostrara este elemento
        $this->showDiv = false;
        $this->aux2 = 'NADA';

        //isset($event->notes)
        //empty($event->notes)

        if (isset($event->notes)) {
            $this->showDiv = true;
        } else {
        }
    }


    // Guarda el review del usuario, junto con su evaluacion (rating)
    public function store()
    {

        // Validar los datos
        $this->validate();

        $event = Event::find($this->event_id);

        // Si existe un evento selecionado
        if (isset($event)) {

            $event->notes()->create([
                'comment' => $this->comment,
                'rating' => $this->rating,
                'user_id' => auth()->user()->id,

                'model' => $event->code,
                'notewable_id' => $event->id,
                'noteable_type' => 'App\Models\Event'
            ]);


            // MASTER CLASS - Ayuda actualizar la pantalla una ves agegado el registro a la base de datos
            // para asi mostrar los cambios realizados
            $this->event = $this->event->fresh();

            $this->reset(['comment']); //Reset la variable comment, para borrar el comentario

        } else {
            // NO HACER NADA
        }
    }
}
