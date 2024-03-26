<?php

namespace App\Livewire\Admin\Schedule;

use App\Models\Schedule;
use App\Models\Store;
use Livewire\Component;

class SchedulesIndex extends Component
{


    // NOTA: *****************   NO SE ESTA USANDO POR AHORA, SE CAMBIO POR EVENTS


    public $client_name = "";
    public $client_date = "";
    public $client_created_at = "";

    public $user;  //Usado para abrir las FACTURAS de este paquete

    public $package_id = 0;
    public $schedule_id = 0;
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

    protected $listeners = ['render'];

    // INICIALIZA VARIABLES (INTERNAS) DEL EVENTO MOUNT
    public function mount()
    {
        // MASTER CLASS
        // Por default, Seleciona la tienda donde trabaja esta - PERSONA AUTENTIFICADA
        $this->store_id = auth()->user()->store_id;


        // Se inicializa las variables con el primer registro activo (schedule)
        $schedule = Schedule::where('status', 'ACTIVE')->first();
        // Y asu vez se obtiene el usuario, dueño de este registro, usado para obtener las facturas
        $this->user = $schedule->user;
    }


    public function render()
    {
        $schedules = Schedule::where('status','ACTIVE')
        ->where('store_id', $this->store_id)
        ->orderBy($this->sort, $this->direction)->get();

        $stores = Store::all();
        return view('livewire.admin.schedule.schedules-index', compact('schedules', 'stores'));
    }


    public function show_items(Schedule $schedule)
    {

        $this->schedule_id = $schedule->id;

        $this->client_name = $schedule->name;
        $this->client_date = $schedule->date;
        $this->client_created_at = $schedule->created_at;

        $this->user = $schedule->user;

        $this->lbCase = 4;  //En el caso 4, Imprimir etiqueta para users;
        $this->lb_pkId = $schedule->id;
        $this->lb_pkClient= $schedule->name;
        $this->lb_pkPhone = $schedule->phone;
        $this->lb_pkStore = $schedule->store_id;
        $this->lb_pkPackage = $schedule->aux4;
        $this->lb_pkDate = $schedule->date;

        // Envia la señal a todo los otros componente de livewire
        $this->emit('sendData', $schedule->id);
    }

    public function delete(Schedule $schedule)
    {
        // $schedule->delete();
    }
}
