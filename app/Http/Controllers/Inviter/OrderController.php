<?php

namespace App\Http\Controllers\Inviter;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(){

        //$orders = Order::where('user_id', auth()->user()->id)->get(); ORIGINAL

        // a) Le agrego un query, para agrega dinamicamente mas filtros
        $orders = Order::query()->where('user_id', auth()->user()->id); //NEW para agregar consultas dinamicas

        // b) Agregar una consulta mas de manera dinamica, si es enviada por la url
        if (request('status')) {
            $orders->where('status', request('status'));
        }
        // c)Por ultimo solicitar los datos
        $orders = $orders->get();

        $pendiente = Order::where('status',1)->where('user_id', auth()->user()->id)->count();
        $recibido = Order::where('status',2)->where('user_id', auth()->user()->id)->count();
        $enviado = Order::where('status',3)->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status',4)->where('user_id', auth()->user()->id)->count();
        $cancelado = Order::where('status',5)->where('user_id', auth()->user()->id)->count();



        return view('inviter.orders.index',compact('orders','pendiente','recibido','enviado','entregado','cancelado'));
    }



    public function show(Order $order){

        // MASTER CLASS - USO DE UNA POLICY
        // a) Usar metodo autorize(), para ejecutar una policy
        // b) Pasarle como primero parametro, el nombre de la policy en este caso: (author)
        // c) Pasarle como segundo parametro si es requerido en este caso es la variable: ($order)
        // d) En el caso de que NO se le pase un segundo parametro, ponerle como segundo parametro
        //    el nombre del modelo al que pertenece esta policy en esta caso seria: (Order::class)
        $this->authorize('author', $order);

        $items = json_decode($order->content);

        return view ('inviter.orders.show',compact('order','items'));
    }
}
