<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecieRequest;
use App\Models\Specie;
use Illuminate\Http\RedirectResponse;

class SpecieController extends Controller
{
    public function index()
    {
        return view('species.index');
    }

    public function create()
    {
        return view('species.form', [
            'specie' => null,
        ]);
    }

    public function store(SpecieRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $specie = Specie::create($data);

        if ($specie) {
            return redirect()->route('species.index')
                ->with('success', 'Especie creada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo crear la especie.');
    }

    public function show(Specie $species)
    {
        return view('species.form', [
            'specie' => $species,
        ]);
    }

    public function edit(Specie $species)
    {
        return view('species.form', [
            'specie' => $species,
        ]);
    }

    public function update(SpecieRequest $request, Specie $species): RedirectResponse
    {
        $data = $request->validated();

        if ($species->update($data)) {
            return redirect()->route('species.index')
                ->with('success', 'Especie actualizada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo actualizar la especie.');
    }

    public function destroy(Specie $species): RedirectResponse
    {
        if ($species->delete()) {
            return redirect()->route('species.index')
                ->with('success', 'Especie eliminada correctamente.');
        }

        return redirect()->route('species.index')
            ->with('error', 'No se pudo eliminar la especie.');
    }
}

