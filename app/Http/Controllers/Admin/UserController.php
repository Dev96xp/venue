<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
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
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function updateG(Request $request, Role $role)
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request);

        // return request()->all;

        $request->validate([
            'name' => 'required',          // Campo abligatorio
            'roles' => 'required'    // Campo abligatorio
        ]);

        $user->update([
            'name' => $request->name
        ]);

        // a) (sync) - Elimina todos los permisos relacionados a un determinado role,
        // b) y una vez que los elimina, los vuelve a crear pero con los nuevos roles,
        // selecionados por el usuario en el formulario
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
