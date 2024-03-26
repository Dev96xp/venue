<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return view('admin.pos.index', compact('user'));
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

    // Para imprimir atravez del impressora una etiqueta
    public function prninvoice(Request $request)
    {
        $transaction_id = $request->transaction_id;
        $transaction = Transaction::find($request->transaction_id);
        $items = $transaction->items->where('status', '3'); // Con el status igual a 3, por que 4 significa que ue cancelado ese item

        $subtotal = get_subtotal($items);
        $totalpayments = get_totalpayments($items);
        $total = $subtotal * 1.07;
        $balance = $total - $totalpayments;

        $user = $transaction->account->user;


        return view('admin.pos.invoice', compact('user', 'items', 'transaction_id', 'subtotal', 'totalpayments', 'total', 'balance'));
    }
}
