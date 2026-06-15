<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PasswordReset) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
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
        Restear contraseña
    </h1>

    {{-- Formulario --}}
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

    {{-- Confirmar Passord --}}
    <x-formularios.div>
        <x-formularios.label for="password_confirmation">
            Repetir contraseña
        </x-formularios.label>

        <x-formularios.campo type="password" model="password_confirmation" id="password_confirmation"
            placeholder="••••••••" required />

        @error('password_confirmation')
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
</div>