<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SpecieRequest;

class SpecieController extends Controller
{
    public function index()
    {
        return view('species.index');
    }

    public function create()
    {
        return view('species.form', [
            'specie' => null
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

    public function show(Specie $specie)
    {
        return view('species.form', [
            'specie' => $specie
        ]);
    }

    public function edit(Specie $specie)
    {
        return view('species.form', [
            'specie' => $specie
        ]);
    }

    public function update(SpecieRequest $request, Specie $specie): RedirectResponse
    {
        $data = $request->validated();

        if ($specie->update($data)) {
            return redirect()->route('species.index')
                ->with('success', 'Especie actualizada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo actualizar la especie.');
    }

    public function destroy(Specie $specie): RedirectResponse
    {
        if ($specie->delete()) {
            return redirect()->route('species.index')
                ->with('success', 'Especie eliminada correctamente.');
        }

        return redirect()->route('species.index')
            ->with('error', 'No se pudo eliminar la especie.');
    }
}

