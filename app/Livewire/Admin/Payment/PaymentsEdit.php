<?php

namespace App\Livewire\Admin\Payment;

use App\Models\Package;
use App\Models\Payment;
use Livewire\Component;

class PaymentsEdit extends Component
{

    public $open = false;
    public $botton_type = 'edit';
    public $payment, $payment_id;       // IMPORTATNTE: SE USO (idex) para evita usar la pala: (id), que causa conflito

    public $paymentEditId;

    // 1.  Crear una propiedad que tenga los mismos campos del formulario
    public $paymentEdit = [
        'id' => 'required',
        'code' => 'required',
        'name' => 'required',
        'signo' => 'required',
    ];

    public function mount(Payment $payment)
    {
        $this->payment = $payment;

        $this->payment = $payment;
        $this->payment_id = $payment->id;
        $this->paymentEditId = $this->payment->id;

        $payment = Payment::find($this->payment->id);
        $this->paymentEditId = $this->payment->id;

        // Muesta estos valores en el formulario
        $this->paymentEdit['id'] = $payment->id;
        $this->paymentEdit['code'] = $payment->code;
        $this->paymentEdit['name'] = $payment->name;
        $this->paymentEdit['signo'] = $payment->signo;

    }

    public function render()
    {
        $payment = Payment::find($this->payment->id);
        $this->paymentEditId = $this->payment->id;

        // Muesta estos valores en el formulario
        $this->paymentEdit['id'] = $this->payment->id;
        $this->paymentEdit['code'] = $this->payment->code;
        $this->paymentEdit['name'] = $this->payment->name;
        $this->paymentEdit['signo'] = $this->payment->signo;

        return view('livewire.admin.payment.payments-edit');
    }

    public function save(){

        $payment = Payment::find($this->paymentEditId);

        $payment->update([

            'code' => $this->paymentEdit['code'],
            'name' => $this->paymentEdit['name'],
            'signo' => $this->paymentEdit['signo'],
        ]);

        $this->reset(['open','paymentEdit','paymentEditId']);

        // DISPATCH - Emite un imageo, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-configuration');

    }

    public function update()
    {

        $payment = Payment::find($this->paymentEditId);

        $payment->update([

            'code' => $this->paymentEdit['code'],
            'name' => $this->paymentEdit['name'],
            'signo' => $this->paymentEdit['signo'],
        ]);

        $this->reset(['open','paymentEdit','paymentEditId']);

        // DISPATCH - Emite un imageo, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-payments');
    }


    public function delete(Payment $payment)
    {
        $payment->delete();
        $this->emit('render');
    }
}
