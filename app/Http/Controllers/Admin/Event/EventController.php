<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Para imprimir atravez del impressora una REPORT - INVOICE
    public function print_report(Request $request)
    {

        $event = Event::find($request->event_id);
        //dd($event);


        //$transaction = Transaction::find($request->transaction_id);
        //$items = $transaction->items->where('status', '3'); // Con el status igual a 3, por que 4 significa que ue cancelado ese item

        // $subtotal = get_subtotal($items);
        // $totalpayments = get_totalpayments($items);
        // $total = $subtotal * 1.07;
        // $balance = $total - $totalpayments;

        $user = $event->user;
        $venue = $event->venue;
        $drink = $event->drink;
        $personal = $event->personal;


        return view('admin.events.report', compact('user','event','venue','drink','personal'));
    }

}
