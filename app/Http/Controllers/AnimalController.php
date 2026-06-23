<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use App\Models\Specie;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AnimalController extends Controller
{
    public function index()
    {
        return view('animals.index');
    }

    public function create()
    {
        return view('animals.form', [
            'animal' => null,
            'species' => Specie::query()->orderBy('name')->get(),
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function store(AnimalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $animal = Animal::create($data);

        if ($animal) {
            return redirect()->route('animals.index')
                ->with('success', 'Mascota creada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo crear la mascota.');
    }

    public function show(Animal $animal)
    {
        return view('animals.form', [
            'animal' => $animal,
            'species' => Specie::query()->orderBy('name')->get(),
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function edit(Animal $animal)
    {
        return view('animals.form', [
            'animal' => $animal,
            'species' => Specie::query()->orderBy('name')->get(),
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function update(AnimalRequest $request, Animal $animal): RedirectResponse
    {
        $data = $request->validated();

        if ($animal->update($data)) {
            return redirect()->route('animals.index')
                ->with('success', 'Mascota actualizada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo actualizar la mascota.');
    }

    public function destroy(Animal $animal): RedirectResponse
    {
        if ($animal->delete()) {
            return redirect()->route('animals.index')
                ->with('success', 'Mascota eliminada correctamente.');
        }

        return redirect()->route('animals.index')
            ->with('error', 'No se pudo eliminar la mascota.');
    }
}
