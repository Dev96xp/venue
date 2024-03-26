<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
//use App\Models\Image;
use App\Models\File;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;
//use Intervention\Image\Drivers\Imagick\Driver;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // NO SE USA POR AHORA
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    public function edit_sections(Invitation $invitation)
    {
        // MUESTRA EL - INDEX DE LA SECCIONES PERTENECIENTES A UNA ESPECIFICA INVITACION
        //dd($invitation);

        // Solo las sectiones pertenecientes a una especificada invitacion
        $sections = $invitation->sections;
        return view('admin.sections.index', compact('sections', 'invitation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // NO SE ESTA USANDO TAMPOCO
        return view('admin.sections.create');
    }

    public function create_sections(Invitation $invitation)
    {
        return view('admin.sections.create', compact('invitation'));
    }


    public function select_files(Section $section)
    {
        // ya funciona
        return view('admin.sections.select_files', compact('section'));
    }




    public function save_files(Request $request, Section $section)
    {
        // ya funciona

        /*
        ****  METODO 1 NORMAL
        $request->validate([
            'file' => 'required|image|max:2045'  //Esto determina que tamaño de imagen se permite subir
        ]);

        $imagenes = $request->file('file')->store('public/images/sections');
        // Aqui se cambia la direcion public por storage usando este facade (Illuminate\Support\Facades\Storage)
        $url = Storage::url($imagenes);     // Como esto ('storage/images/sections')

        // Guardo esta url en la tabla (file)
        File::create([
            'url'=>$url,
        ]); */

        // Regreso a la vista index
        //return redirect()->route('admin.sections.index');



        // ***  METODO 2 USANDO INTERVENSION VERSION 3

        // 1#. Validacion de la imagen
        $request->validate([
            'file' => 'required|image'
        ]);

        // 2#. Se genera la ruta completa con nombre del archivo
        $number_random = Str::random(10);       //Genera un numero random de 10 cifras
        $nombre = $number_random . $request->file('file')->getClientOriginalName();  //Retorna  + el numero random + el nombre de la imagen
        $ruta = storage_path() . '/app/public/sections/' . $nombre;   //Ruta completa con nombre
        // Solo checar - $ruta = storage_path() . '/app/public/products/' . $nombre;   //  Nueva ruta donde se gusradra el archivo

        // 3#. Se modifica el tamaño del archivo y se guarda en la ruta apropiada
        /* ********USO INTERVENSION Version 3  (https:.intervention.io)
            https://image.intervention.io/v3/introduction/installation
            para cambiar su dimencion de altura conservando su proporcion,
            para luego guardala en la ruta contenida*/

        Image::read($request->file('file'))     //Lee el archivo
            ->scale(height: 1200)               //Cambia su altura a 1200px y conserva proporcion
            ->save($ruta);                      //Guarda la imagen en la ruta establecida, en tus carpestas

        // Guardo esta url en la tabla (file) YA NO SE VA A USAR
        // File::create([
        //     'user_id' => auth()->user()->id,
        //     'url' => '/storage/images/sections/' . $nombre,
        // ]);

        // 4#. Crea nuevo registro y guarda la cada nueva url en la tabla (images)
        $section->images()->create([
            'url' => 'sections/' . $nombre
        ]);


        //return redirect()->route('admin.sections.index')->with('info', 'Las fotos se agregaron corectamente !!!');
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Section $section)
    {
        // NO SE ESTA USANDO POR QUE NO PUEDE RECIVIR MAS PARAMETROS
        // SE CREO OTRA LLAMADA (store_sections)
    }

    public function store_sections(Request $request, Invitation $invitation)
    {

        $request->validate([
            'name' => 'required',          // Campo abligatorio
            'description' => 'required'    // Campo abligatorio
        ]);

        //dd($invitation);
        // MASTER CLASS      ojo

        // Parte 1
        // a) Crear el role
        // b) Se crea un nuevo registro
        // c) Con la informacion del formulario
        // d) Que ademas se almaceno en la variable, $role
        $section = Section::create([
            'name' => $request->name,
            'description' => $request->description,
            'invitation_id' => $invitation->id
        ]);

        //dd($invitation);

        // Por ultimo que me direcione a la ruta siguiente, que representa (INDEX DE SECTIONS)
        // y se manda un MESSAGE DE SESSION
        // Info - es la variable donde se guardara elmensaje de sseion
        return redirect()->route('admin.sections.edit_sections', $invitation)->with('info', 'La section se creo satisfactoriamente');
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
    public function edit(Section $section)
    {
        // NO SE ESTA USANDO TAMPOCO
        return view('admin.sections.edit', compact('section'));
    }


    public function edit_section(Section $section, Invitation $invitation)
    {
        return view('admin.sections.edit', compact('section', 'invitation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {

        // NO SE ESTA USANDO TAMPOCO
        $request->validate([
            'name' => 'required',          // Campo abligatorio
            'description' => 'required'    // Campo abligatorio
        ]);

        $section->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.sections.index', $section);
    }


    public function update_section(Request $request, Section $section, Invitation $invitation){

        //dd($invitation);


        $request->validate([
            'name' => 'required',          // Campo abligatorio
            'description' => 'required'    // Campo abligatorio
        ]);

        $section->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        // Por ultimo que me direcione a la ruta siguiente, que representa (INDEX DE SECTIONS)
        // y se manda un MESSAGE DE SESSION
        // Info - es la variable donde se guardara elmensaje de sseion
        return redirect()->route('admin.sections.edit_sections', $invitation)->with('info', 'La section se creo satisfactoriamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('info', 'La section se elimino con exito');
    }
}
