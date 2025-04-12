<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $roles = Role::all();
        return view("admin.roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("admin.roles.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name'=> 'required|unique:roles',

        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('admin.roles.index')
        ->with ('mensaje','se registro el rol corectamente')
        ->with('icono','success');

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
        
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([ 
            'name'=> 'required|unique:roles,name,'.$id,
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        return redirect()->route('admin.roles.index')
        ->with('mensaje','se modifico el rol correctamente')
        ->with('icono','success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        Role::destroy($id); 
        return redirect()->route('admin.roles.index')
        ->with('mensaje','se elimino el rol')
        ->with('icono','success');
    }
}
