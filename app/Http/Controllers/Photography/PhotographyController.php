<?php

namespace App\Http\Controllers\Photography;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

    // USO PARA FOTOGRAFIA, EN EL DROPDOWN(my images)

class PhotographyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $account_id = $user->account->id;
        $account = Account::find($account_id);

        $gallery = $user->galleries->first();

        return view('dropdown.photography.index',compact('user', 'account', 'gallery'));
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
}
