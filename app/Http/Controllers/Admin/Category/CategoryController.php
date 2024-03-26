<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Detail;
use App\Models\Image;
use App\Models\Product;
use App\Models\StatusCategory;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $statuses = StatusCategory::all();
        $types = TypeCategory::all();

        return view('admin.categories.create', compact('types','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDA - Que sea un campo unico en la tabla categories, que la inf. que proporciona el usuario sea unica
        // para la tabla categories
         $request->validate([
             'name' => 'required|unique:categories',
             'slug' => 'required',
             'desc' => 'required',
             'type' => 'required',
         ]);

         //dd($request);

        // Parte 1
        // a) Crear una categoria
        // b) Se crea un nuevo registro
        // c) Con la informacion del formulario
        // d) Que ademas se almaceno en la variable, $categories
        $categories = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'desc' => $request->desc,
            'type_category_id' => $request->type,
            'status_category_id' => $request->status,
        ]);

        //$categories = Category::create($request->all());

        // return redirect()->route('admin.categories.edit', $categories)->with('info', 'La categoria se creado con exito');
        return redirect()->route('admin.categories.index', $categories)->with('info', 'La categoria se creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $details = Detail::all();
        // $statuses = StatusCategory::pluck('name', 'id'); ANTES
        $statuses = StatusCategory::all();
        //dd($statuses);
        $types = TypeCategory::all();

        return view('admin.categories.edit', compact('category', 'details', 'statuses','types'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        // Validar valores, pero tambien son los nombres de los campos a actualizar
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,  // Que sea un campo unico en la tabla categories,
            'desc' => 'required',
            //'details' => 'required',
            'status' => 'required',
            //'type' => 'required'
            'type_category_id' => 'required'
        ]);

        // Actualiza los cambios
        $category->update($request->all());


        // a) (sync) - Elimina todos los permisos relacionados a un determinado role,
        // b) y una vez que los elimina, los vuelve a crear pero con los nuevos roles,
        // selecionados por el usuario en el formulario
        $category->details()->sync($request->details);


        /*
        // METODO 3 NORMAL (FUNCIONA MUY BIEN) BORRA TODAS LAS IMAGENES EXISTENTES Y LAS REMPLAZA TODAS POR NUEVAS PUNTO.

        if($request->file('file')){                     //existe una nueva imagen selecionada en el formulario?
            // borrar las existentes fotos
            foreach($category->images as $image){
                    Storage::delete($image->url);           // borra el archivo excistente, borra la imagen de la carpeta
                    $image->delete();                       // borra el registro de la base de datos, de la imagen
            }

            foreach($request->file('file') as $item){
                    $url = Storage::put('categories', $item);     // mueve las fotos del archivo temporal al de produtos
                    $category->images()->create([                // crea nuevo registro y guarda la nueva url
                        'url' => $url
                    ]);
                }
        }
        */

        // METODO 4 CON INTERVENTION

        // 1. Si existe una nueva imagen selecionada en el formulario?
        if ($request->file('file')) {

            // 2. borrar todas las fotos existentes
            foreach ($category->images as $image) {
                Storage::delete($image->url);           // borra el archivo existente, borra la imagen de la carpeta
                $image->delete();                       // borra el registro de la base de datos, de la imagen
            }


            foreach ($request->file('file') as $item) {

                // 3. Uso Intervencion para subir imagenes y cambiar tamaño del archivo
                $nombre = Str::random(10) . $item->getClientOriginalName();
                $ruta = storage_path() . '/app/public/categories/' . $nombre;
                Image::make($item)                                      // Intervencion
                    ->resize(1200, null, function ($constraint) {       // Cambia el tamaño del imagen
                        $constraint->aspectRatio();                     // con una ncho de 1200px, y un alto proporcional
                    })
                    ->save($ruta);

                // 4. Crea nuevo registro y guarda la cada nueva url
                $category->images()->create([
                    'url' => 'categories/' . $nombre
                ]);
            }
        }


        return redirect()->route('admin.categories.index', $category)->with('info', 'La categoria se actualizo con exito');
    }


    public function files_for_testing(Product $product, Request $request)
    {

        $img = Image::make('public/storage/products/llanta.jpg');
        $img->resize(300, 200);


        $newFileName = $product->model . '_' . uniqid() . '.jpg';
        $path = 'products';
        Image::make($request->file('file'))->save(storage_path('app/public/' . $path . '/' . $newFileName));

        // METODO 1, FUNCIONA MUY BIEN TAMBIEN, SOLO QUE AQUI EL NOMBRE DEL ARCHIVO ES DADO POR EL SISTEMA
        //$url = Storage::put('products', $request->file('file'));


        // METODO 2, FUNCIONA MUY BIEN USANDO DROPZONE, FUNCIONA MUY BIEN, AQUI EL NOMBRE DEL ARCHIVO ES DADO POR MI

        //$newFileName = $product->model . '_' . $request->file('file')->getClientOriginalName();
        //$newFileName = $product->model . '_' . uniqid() . '.jpg';
        //$url = Storage::putFileAs('products', $request->file('file'), $newFileName);


        // METODO 3, USANDO INTERVENTION IMAGES PACKAGE
        // $nombre = Str::ramdon(10) . $request->file('file')->getClientOriginalName();  //Retorna solo el nombre original del archivo

        //  storage_path() - Retorna esto: "C:\xampp\htdocs\codersfree\storage"
        // $ruta = storage_path() . '\app\public\products/' . $newFileName; //Retorna toda la ruta y nombre del imagen

        //Image::make($request->file('file'))->save($rutax);

        //      ->save($ruta);  // Ruta completa donde se guardara el archivo



        //   $product->images()->create([
        //       'url' => $url,
        //       'model' => $product->model
        //   ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index', $category)->with('info', 'La categoria se elimino con exito');
    }
}


