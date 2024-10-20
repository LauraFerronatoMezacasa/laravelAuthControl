<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\{Role, Permission};
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $roles = Role::paginate($perPage);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $allPermissions = Permission::all();
        return view('admin.roles.form', compact('allPermissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions); 

        return redirect()->route('admin.roles.index')->with('success', 'Tipo de acesso criado com sucesso!');
    }

    public function edit(Role $role)
    {
        $allPermissions = Permission::all();
        return view('admin.roles.form', compact('role', 'allPermissions')); 
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);

        $role->name = $request->name;
        $role->save();
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Tipo de acesso atualizado com sucesso!');
    }

    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Tipo de acesso excluído com sucesso!');
    }
}
