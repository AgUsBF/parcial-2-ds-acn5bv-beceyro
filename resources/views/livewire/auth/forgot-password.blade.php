<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
};
?>

<div class="flex-column mt-10 items-center justify-center max-w-md mx-auto 
    md:h-screen px-8 py-8 bg-white border border-gray-200 
    dark:bg-gray-700 dark:border-gray-600 rounded-lg shadow-sm">

    {{-- Sesion --}}
    @if (session('status'))
        <div class="text-sm text-green-600 dark:text-green-400 text-center">
            {{ session('status') }}
        </div>
    @endif

    {{-- Titulo --}}
    <h1 class="text-2xl font-bold leading-tight tracking-tight text-center
        text-gray-900 md:text-2xl dark:text-white">
        Recuperar contraseña
    </h1>

    {{-- Formulario --}}
    <form wire:submit.prevent="sendPasswordResetLink" class="space-y-4 md:space-y-6">
        {{-- Email --}}
        <x-formularios.div>
            <x-formularios.label for="email">
                Email
            </x-formularios.label>

            <x-formularios.campo type="email" model="email" id="email" placeholder="correo@patitas.com" required />

            @error('email')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror
        </x-formularios.div>

        {{-- Boton --}}
        <x-formularios.div>
            <x-botones.estandar class="w-full" type="submit">
                Enviar enlace de recuperación
            </x-botones.estandar>
        </x-formularios.div>

    </form>

    {{-- Usuario con cuenta --}}
    <div class="mt-4 flex flex-col items-center justify-center">
        {{-- Texto --}}
        <p class="text-lg text-gray-900 dark:text-white">
            ¿Recuperaste tu contraseña?
        </p>

        {{-- Link --}}
        <x-formularios.link class="text-xl pt-4" href="{{ route('login') }}">
            Iniciar sesión
        </x-formularios.link>

    </div>
</div>