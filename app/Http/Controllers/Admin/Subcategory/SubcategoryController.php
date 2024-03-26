<?php

namespace App\Http\Controllers\Admin\Subcategory;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::all();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); //Para laravel collective
        $brands = Brand::all();

        return view('admin.subcategories.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDA - Que sea un campo unico en la tabla subcategories, que la inf. que proporciona el usuario sea unica
        // para la tabla subcategories
        $request->validate([
            'name' => 'required|unique:subcategories',
            'slug' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required'
        ]);

        $subcategories = Subcategory::create($request->all());

        return redirect()->route('admin.subcategories.edit', $subcategories)->with('info', 'La subcategoria se creado con exito');
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
    public function edit(Subcategory $subcategory)
    {
        $features = Feature::all();
        $categories = Category::all(); //Para laravel collective
        $brands = Brand::all();

        return view('admin.subcategories.edit', compact('subcategory', 'features','categories','brands'));
    }

    public function editx(Subcategory $subcategory)
    {
        $valueToSelectByDefault[] = [ null => 'Select category'];
        $features = Feature::all();
        $categories = Category::pluck('name', 'id'); //Para laravel collective
        $brands = Brand::pluck('name','id');

        return view('admin.subcategories.edit', compact('subcategory', 'features', 'categories', 'brands', 'valueToSelectByDefault'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {

        $request->validate([
            'name' => 'required|unique:subcategories,name,' . $subcategory->id,  // Que sea un campo unico en la tabla categories,
            'slug' => 'required', //requerido, y unico en la TABLA SUBCATEGORIES
            'features' => 'required',
            'category_id' => 'required',
            'days' => 'required'
        ]);

        // active - se queda pendiente

        $subcategory->update($request->all());

        // a) (sync) - Elimina todos los features relacionados a un determinado subcategory,
        // b) y una vez que los elimina, los vuelve a crear pero con los nuevos features,
        // selecionados por el usuario en el formulario
        // METODO NUEVO
        $subcategory->features()->sync($request->features);
        //$subcategory->features()->syncWithPivotValues([1,2,3,4,5,6,7],['days' => 10]); // ESTE SI TRABAJA
        // ESTE ES UN CASO ESPECIAL, AQUI SE GUARDA LOS DIAS DE ENTREGA DE UNA ORDEN
        $subcategory->features()->updateExistingPivot(20, ['days' => $request->days]);


        //return redirect()->route('admin.subcategories.edit', $subcategory)->with('info', 'La subcategoria se actualizo con exito');
        return redirect()->route('admin.subcategories.index')->with('info', 'La subcategoria se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index', $subcategory)->with('info', 'La subcategoria se elimino con exito');
    }
}


