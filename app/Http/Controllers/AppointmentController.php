<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointments.index');
    }

    public function create()
    {
        return view('appointments.form', [
            'appointment' => null
        ]);
    }

    public function store(AppointmentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $appointment = Appointment::create($data);

        if ($appointment) {
            return redirect()->route('appointments.index')
                ->with('success', 'Cita creada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo crear la cita.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.form', [
            'appointment' => $appointment
        ]);
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.form', [
            'appointment' => $appointment
        ]);
    }

    public function update(AppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $data = $request->validated();

        if ($appointment->update($data)) {
            return redirect()->route('appointments.index')
                ->with('success', 'Cita actualizada correctamente.');
        }

        return redirect()->back()->withInput()
            ->with('error', 'No se pudo actualizar la cita.');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        if ($appointment->delete()) {
            return redirect()->route('appointments.index')
                ->with('success', 'Cita eliminada correctamente.');
        }

        return redirect()->route('appointments.index')
            ->with('error', 'No se pudo eliminar la cita.');
    }
}

