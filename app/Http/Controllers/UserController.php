<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.form', [
            'user' => null,
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = User::create($data);

        if ($user) {
            return redirect()->route('users.index')
                ->with('success', 'Usuario creado correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo crear el usuario.');
    }

    public function show(User $user)
    {
        return view('users.form', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('users.form', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if ($user->update($data)) {
            return redirect()->route('users.index')
                ->with('success', 'Usuario actualizado correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo actualizar el usuario.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->delete()) {
            return redirect()->route('users.index')
                ->with('success', 'Usuario eliminado correctamente.');
        }

        return redirect()->route('users.index')
            ->with('error', 'No se pudo eliminar el usuario.');
    }

    public function vets()
    {
        return view('users.vets');
    }
}
