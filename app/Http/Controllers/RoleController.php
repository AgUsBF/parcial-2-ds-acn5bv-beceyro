<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function create()
    {
        return view('roles.form', [
            'role' => null
        ]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $role = Role::create($data);

        if ($role) {
            return redirect()->route('roles.index')
                ->with('success', 'Rol creado correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo crear el rol.');
    }

    public function show(Role $role)
    {
        return view('roles.form', [
            'role' => $role
        ]);
    }

    public function edit(Role $role)
    {
        return view('roles.form', [
            'role' => $role
        ]);
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $data = $request->validated();

        if ($role->update($data)) {
            return redirect()->route('roles.index')
                ->with('success', 'Rol actualizado correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo actualizar el rol.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->delete()) {
            return redirect()->route('roles.index')
                ->with('success', 'Rol eliminado correctamente.');
        }

        return redirect()->route('roles.index')
            ->with('error', 'No se pudo eliminar el rol.');
    }
}

