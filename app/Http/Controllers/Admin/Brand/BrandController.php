<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDA - Que sea un campo unico en la tabla categories
        $request->validate([
            'name' => 'required|unique:brands',
            'code' => 'required|unique:brands'
        ]);

        $brands = Brand::create($request->all());

        //return redirect()->route('admin.brands.edit', $brands)->with('info', 'La marca se creado con exito 3');
        return redirect()->route('admin.brands.index', $brands)->with('info', 'La marca se creado con exito 3');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,'.$brand->id,  // Que sea un campo unico en la tabla categories
            'code' => 'required'
        ]);

        $brand->update($request->all());

        return redirect()->route('admin.brands.edit', $brand)->with('info', 'La marca se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index', $brand)->with('info', 'La marca se elimino con exito');
    }
}

