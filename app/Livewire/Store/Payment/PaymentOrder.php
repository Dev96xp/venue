<?php

namespace App\Livewire\Store\Payment;

use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\On;

// Paso 1: Proteccion usando Policy
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PaymentOrder extends Component

{
    // Paso 2: Proteccion usando Policy
    use AuthorizesRequests;

    public $order;

    public function mount(Order $order){
        $this->order = $order;
    }

    #[On('pay-order')]
    public function payOrder(){
        // a) cambia el status de la orden (RECIVIDO)
        $this->order->status = 2;
        // b) guarda el cambio de orden
        $this->order->save();
        // c) Nos manda a una nueva direcion
        return redirect()->route('sales.orders.show', $this->order);
    }


    public function render()
    {
        // Paso 3: Proteccion usando Policy
        // MASTER CLASS - USO DE UNA POLICY
        // a) Usar metodo autorize(), para ejecutar una policy
        // b) Pasarle como primero parametro, el nombre de la policy en este caso: (author)
        // c) Pasarle como segundo parametro si es requerido en este caso es la variable: ($order)
        // d) En el caso de que NO se le pase un segundo parametro, ponerle como segundo parametro
        //    el nombre del modelo al que pertenece esta policy en esta caso seria: (Order::class)
        // f) En este caso para (livewire components) El valor del la orden lo tenemos
        //    en el valor de la propiedad ($this->order) y este seria el segundo parametro
        $this->authorize('author', $this->order);

        $this->authorize('payment', $this->order);


        $items = json_decode($this->order->content);


        // MASTER CLASS - Por default esta vista usaria el layout llamado:(app.blade.php), pero aqui lo cambiamos a: (store.blade.php)
        //  y tambien le mandamos una variable llamada: order

        return view('livewire.store.payment.payment-order', compact('items'))->layout('layouts.invitation',['order' => $this->order]);
    }
}
