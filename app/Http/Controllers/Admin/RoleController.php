<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{

    // SEGURIDAD PERMISOS
    public function __construct()
    {
        // MASTER CALSS - PROTEJER CADA METODO POR SEPARADO

        // Primero protejer la ruta index, de los roles, en este caso
        // el permiso se llama (Listar roles) y que solo proteja al metodo index.
        // caso 1 - $this->middleware('can:Listar role');, Asi se protejen todos los metodos
        // caso 2 - $this->middleware('can:Listar role')->only('index');, y asi se proteje solo el metodo index
        $this->middleware('can:Listar role')->only('index');
        // Protejer metodo create y store al mismo tiempo
        $this->middleware('can:Crear role')->only('create', 'store');
        // Protejer metodo edit y update al mismo tiempo
        $this->middleware('can:Editar role')->only('edit', 'update');
        $this->middleware('can:Eliminar role')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera todo los roles existentes en la tabla roles,
        // ojo para poder usa este modelo se tuvo que declara en la parte de arriba
        // le pertenece a (spatie)

        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recupera todo los permisos existentes en la tabla persmisos,
        // ojo para poder usa este modelo se tuvo que declara en la parte de arriba
        // le pertenece a (spatie)

        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',          // Campo abligatorio
            'permissions' => 'required'    // Campo abligatorio
        ]);

        // MASTER CLASS      ojo

        // Parte 1
        // a) Crear el role
        // b) Se crea un nuevo registro
        // c) Con la informacion del formulario
        // d) Que ademas se almaceno en la variable, $role
        $role = Role::create([
            'name' => $request->name
        ]);

        // Parte 2
        // Una vez creado el role, agregar los TODOS LOS a la tabla intermedia
        // a) voy usar la variable role que contiene el registro creado
        // b) voy acceder a su la relacion permissions usandO : permissions()
        // c) Uso metodo attach()
        // d) Al metodo le paso el id, de CADA permiso que quiero agregar
        // e) Usando: $request->permissions, que contiene todos los permisos que
        //    el usuario seleciono en el formulario...y listo
        $role->permissions()->attach($request->permissions);

        // Por ultimo que me direcione a la ruta  siguiente
        // y se manda un MESSAGE DE SESSION
        // Info - es la variable donde se guardara elmensaje de sseion
        return redirect()->route('admin.roles.index')->with('info', 'El rol se creo satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        // dd($request);

        // return request()->all;

        $request->validate([
            'name' => 'required',          // Campo abligatorio
            'permissions' => 'required'    // Campo abligatorio
        ]);

        $role->update([
            'name' => $request->name
        ]);

        // a) (sync) - Elimina todos los permisos relacionados a un determinado role,
        // b) y una vez que los elimina, los vuelve a crear pero con los nuevos roles,
        // selecionados por el usuario en el formulario
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.roles.index', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // NO elimina los roles de administrador y de desarrollador
        if ($role->name == 'Admin' || $role->name == 'Developer') {
            return redirect()->route('admin.roles.index')->with('info', 'El rol NO se puede eliminar');
            # nada
        } else {
            $role->delete();
            return redirect()->route('admin.roles.index')->with('info', 'El rol se elimino con exito');
        }
    }
}
