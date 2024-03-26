<?php

namespace App\Livewire\Store;

use Livewire\Component;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\State;
use App\Models\store;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{

    public $envio_type = 1;

    public $contact, $phone, $address, $references = "", $city, $district = "", $zip;
    public $shipping_cost = 0;

    public $decimals = 2;
    public $decimalSeperator = null;
    public $thousandSeperator = null;

    // Inicializar a un ARRAY VACIO PARA EVITAR UN ERROR
    public $states, $cities = [], $districts = [], $stores;

    // en estas variables guardaremos los valoresque selecionaremos en el formulario
    // Inicializamos la variable a un lugar vacio
    public $state_id = "", $city_id = "", $district_id = "", $store_id = "";

    // REGLAS DE VALIDACION INICIALES
    public $rules = [
        'state_id' => 'required',
        'city' => 'required',
        'address' => 'required',
        'zip' => 'required',
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required'
    ];



    public function mount()
    {
        $this->states = State::all();
        $this->cities = City::all();  // OJO - PARA MODIFICAR SI ES NECESARIO PARA shippin_cost
        $this->districts = District::all();
        $this->stores = store::all();
    }


    // Esta es una funcion, que hace que estemos a la escucha del cambio
    // de una variable, en este caso de la variable (envio_type) y si su valor
    // llegara a ser 1, se resetean las reglas de validacion

    public function updatedEnvioType($value)
    {

        if ($value == 1) {
            $this->resetValidation([
                'state_id', 'city_id', 'district_id', 'store_id', 'address', 'references'
            ]);
        }
    }

    public function render()
    {

        //  return view('livewire.store.create-order');  ORIGINAL - Por default se redizara en la plantilla (layouts.app.blade.php)
        // pero en su lugar se usara otra plantilla llamada: (layouts.store.blade.php)

        return view('livewire.store.create-order')->layout('layouts.invitation');
    }

    // Esta Funcion esta a la escucha, de un cambio en el Id de las ciudades, cuando el usuario cambia de ciudad
    // en el formulario y se obtiene el nuevo shipping cost de la nueva ciudad

    //    Esta funcion se comforma de la siguiente manera:
    //         a) con la palabra: updated
    //         b) con el nombre de la columna (city_id), en camel format y sin guiones bajos, quedando asi: CityId
    //         c) Resultado final:  updatedCityId


    // YA NO LO ESTOY USANDO
    // public function updatedCityId($value){
    //     $city = City ::find($value);
    //     $this->shipping_cost = $city->cost; // OJO - PARA MODIFICAR SI ES NECESARIO PARA shippin_cost

    // }


    public function updatedStateId($value)
    {
        $state = State::find($value);
        $this->shipping_cost = $state->shipping_cost; // OJO - PARA MODIFICAR SI ES NECESARIO PARA shippin_cost

    }

    public function create_order()
    {

        $rules = $this->rules;

        $this->validate($rules);

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = $this->shipping_cost;
        $order->store_id = 1;   // Por default solo va ser venta online (1)

        $order->state_id = $this->state_id;
        $order->city = $this->city;
        $order->district = $this->district;
        $order->address = $this->address;
        $order->zip = $this->zip;
        $order->references = $this->references;

        // EJEMPLO - $order->total = Cart::subtotal($decimals, $decimalSeperator, $thousandSeperator);
        // IMPORTANT - Se produce un ERROR, pq Cart(), envia 1,000.00, cuando la base de datos solo acepta 1000.00, sin la coma
        // de tal manera especificar, los separadores del subtotal.

        $order->tax = Cart::subtotal(2, '.', '') * .07;
        $order->total = $this->shipping_cost + Cart::subtotal(2, '.', '') * 1.07;

        //$order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content();  // AQUI SE GUARDA LA TALLA, COLOR, DATE, WAIST...ETC, ES UN CAMPO JSON

        // CREA LA NUEVA ORDEN Y SALVA LOS DATOS EN LA TABLA : ORDER
        $order->save();

        /*NO SE USA
        SUPUESTAMENTE ACTUALIZA NUESTRO INVENTARIO
        // a) Que intere nuestro carrito de compras
        // b) por cada item del carrito de compras, que se ejecute el HELPER: discount
        foreach (Cart::content() as $item) {
            // Sirve para descontar de la base de datos cada articulo vendido en nuestro stock
            discount($item);
        }
        */

        // Destruyes el carrito de compras
        Cart::destroy();

        return redirect()->route('sales.orders.payment', $order);
    }
}
