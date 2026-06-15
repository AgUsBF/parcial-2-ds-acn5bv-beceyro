<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
};
?>

<div class="flex-column mt-10 items-center justify-center max-w-md mx-auto 
    md:h-screen px-8 py-8 bg-white border border-gray-200 
    dark:bg-gray-700 dark:border-gray-600 rounded-lg shadow-sm">

    {{-- Titulo --}}
    <h1 class="text-2xl font-bold leading-tight tracking-tight text-center 
        text-gray-900 md:text-2xl dark:text-white">
        Iniciar sesión
    </h1>

    {{-- Sesion --}}
    @if (session('status'))
        <div class="text-sm text-green-600 dark:text-green-400 text-center">
            {{ session('status') }}
        </div>
    @endif

    {{-- Formulario --}}
    <x-formularios.armados.login />

    {{-- Usuario sin cuenta --}}
    <div class="mt-4 flex flex-col items-center justify-center">

        {{-- Texto --}}
        <p class="text-lg text-gray-900 dark:text-white">
            ¿No tenés cuenta?
        </p>

        {{-- Link --}}
        <x-formularios.link class="text-xl pt-4" href="{{ route('register') }}">
            Registrate
        </x-formularios.link>
    </div>
</div>