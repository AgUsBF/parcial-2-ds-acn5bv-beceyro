<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
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
        Crea tu cuenta
    </h1>

    {{-- Formulario --}}
    <x-formularios.armados.registro />

    {{-- Usuario con cuenta --}}
    <div class="mt-4 flex flex-col items-center justify-center">

        {{-- Texto --}}
        <p class="text-lg text-gray-900 dark:text-white">
            ¿Ya tenés cuenta?
        </p>

        {{-- Link --}}
        <x-formularios.link class="text-xl pt-4" href="{{ route('login') }}">
            Iniciá sesión
        </x-formularios.link>
    </div>
</div>