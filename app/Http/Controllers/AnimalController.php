<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AnimalRequest;

class AnimalController extends Controller
{
    public function index()
    {
        return view('animals.index');
    }

    public function create()
    {
        return view('animals.form', [
            'animal' => null
        ]);
    }

    public function store(AnimalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $animal = Animal::create($data);

        if ($animal) {
            return redirect()->route('animal.index')
                ->with('success', 'Mascota creada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo crear la mascota.');
    }

    public function show(Animal $animal)
    {
        return view('animals.form', [
            'animal' => $animal
        ]);
    }

    public function edit(Animal $animal)
    {
        return view('animals.form', [
            'animal' => $animal
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

