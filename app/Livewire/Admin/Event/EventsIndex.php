<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use App\Models\Store;
use App\Models\Venue;
use Livewire\Component;
use Livewire\Attributes\On;

class EventsIndex extends Component
{
    public $client_name = "";
    public $client_date = "";
    public $client_created_at = "";

    public $user;  //Usado para abrir las FACTURAS de este paquete

    public $package_id = 0;
    public $event_id = 1;    // Por default el primer evento

    public $event = 0;
    public $registro;

    public $sort = 'date';
    public $direction = 'asc'; //desc or asc ?

    public $store_id = "";

    public $lbCase = 4;  //En el caso 4, Imprimir etiqueta para paquetes
    public $lb_pkId = "";
    public $lb_pkClient = "";
    public $lb_pkPhone = "";
    public $lb_pkStore = "";
    public $lb_pkPackage = "";
    public $lb_pkDate = "";
    ///////////////////////////////////////////////////////////

    public $venue;    // (el salon)
    public $venue_open = false;


    // INICIALIZA VARIABLES (INTERNAS) DEL EVENTO MOUNT
    public function mount()
    {
        // MASTER CLASS
        // Por default, Seleciona la tienda donde trabaja esta - PERSONA AUTENTIFICADA
        $this->store_id = auth()->user()->store_id;


        // Se inicializa las variables con el primer registro activo (event)
        $event = Event::where('status', 'ACTIVE')->first();
        // Y asu vez se obtiene el usuario, dueño de este registro, usado para obtener las facturas
        $this->user = $event->user;


        // Venue selecionado
        $this->venue = Venue::find($this->event_id);  //checar, por deafult esta definido a: 1
    }


    #[On('render-events')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        $events = Event::where('status', 'ACTIVE')
            ->where('store_id', $this->store_id)
            ->orderBy($this->sort, $this->direction)
            ->get();

        $stores = Store::all();
        return view('livewire.admin.event.events-index', compact('events', 'stores'));
    }

    //SE SELECIONA UN EVENTO ESPECIFICO y se muestra los elementos para este evento
    public function show_items(Event $event)
    {
        $this->event_id = $event->id;
        $this->event = $event;

        $this->registro = Event::find($this->event_id)->name;   //agrege esto, para otra cosa

        $this->client_name = $event->name;
        $this->client_date = $event->date;
        $this->client_created_at = $event->created_at;

        $this->user = $event->user;

        $this->lbCase = 4;  //En el caso 4, Imprimir etiqueta para users;
        $this->lb_pkId = $event->id;
        $this->lb_pkClient = $event->name;
        $this->lb_pkPhone = $event->phone;
        $this->lb_pkStore = $event->store_id;
        $this->lb_pkPackage = $event->aux4;
        $this->lb_pkDate = $event->date;

        // Envia la señal a todo los otros componente de livewire
        //xxx $this->emit('sendData', $event->id);
        $this->dispatch('send-data-reviews', send_event: $event);
    }


    public function delete(Event $event)
    {
        // $event->delete();
    }

    // Limpiar la pagina
    // Para que la busqueda sea atravez de todas la paginas
    public function limpiar_page()
    {
        $this->resetPage();
    }

}
