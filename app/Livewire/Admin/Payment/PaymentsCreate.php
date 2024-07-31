<?php

namespace App\Livewire\Admin\Payment;

use App\Models\Payment;
use Livewire\Component;

class PaymentsCreate extends Component
{
    public $open = false;
    public $botton_type = 'create';


    public $code, $name, $signo;



    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO

    protected $rules = [
        'code' => 'required',
        'name' => 'required',
        'signo' => 'required',
    ];



    public function render()
    {
        return view('livewire.admin.payment.payments-create');
    }

    public function save()
    {

        // Validar los datos
        $this->validate();

        // Se Crea el nuevo registro en la tabla: PERMISSIONS
        $paymentx = Payment::create([
            'code' => $this->code,
            'name' => $this->name,
            'signo' => $this->signo,
        ]);

        // b) una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['open', 'code','name','signo']);

        $this->dispatch('render-payments');

    }


}
