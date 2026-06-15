<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (
            !Auth::guard('web')->validate([
                'email' => Auth::user()->email,
                'password' => $this->password,
            ])
        ) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div class="flex-column mt-10 items-center justify-center max-w-md mx-auto 
    md:h-screen px-8 py-8 bg-white border border-gray-200 
    dark:bg-gray-700 dark:border-gray-600 rounded-lg shadow-sm">

    {{-- Session Status --}}
    <x-auth-session-status class="text-center" :status="session('status')" />

    {{-- Titulo --}}
    <h1 class="text-2xl font-bold leading-tight tracking-tight text-center
        text-gray-900 md:text-2xl dark:text-white">
        Confirmá tu contraseña
    </h1>

    {{-- Formulario --}}
    <form wire:submit="confirmPassword" class="space-y-4 md:space-y-6">
        {{-- Passord --}}
        <x-formularios.div>
            <x-formularios.label for="password">
                Contraseña
            </x-formularios.label>

            <x-formularios.campo type="password" model="password" id="password" placeholder="••••••••" required />

            @error('password')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
        </x-formularios.div>

        {{-- Boton --}}
        <x-formularios.div class="mt-6">
            <x-botones.estandar class="w-full" type="submit" variant="primary">
                Confirmar
            </x-botones.estandar>
        </x-formularios.div>

    </form>
</div>