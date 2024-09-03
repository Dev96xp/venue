<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        //$orders = Order::where('user_id', auth()->user()->id)->get(); ORIGINAL

        // a) Le agrego un query, para agrega dinamicamente mas filtros
        $orders = Order::where('status', '<>', 1); //NEW para agregar consultas dinamicas

        // b) Agregar una consulta mas de manera dinamica, si es enviada por la url
        if (request('status')) {
            $orders->where('status', request('status'));
        }
        // c)Por ultimo solicitar los datos
        $orders = $orders->get();

        $pendiente = Order::where('status', 1)->count();
        $recibido = Order::where('status', 2)->count();
        $enviado = Order::where('status', 3)->count();
        $entregado = Order::where('status', 4)->count();
        $cancelado = Order::where('status', 5)->count();
        return view('admin.orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'cancelado'));
    }

    public function print(Order $order)
    {
        return view('admin.orders.print', compact('order'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }
}
