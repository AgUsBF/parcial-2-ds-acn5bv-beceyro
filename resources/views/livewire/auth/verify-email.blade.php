<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};
?>

<div class="flex-column mt-10 items-center justify-center max-w-md mx-auto 
    md:h-screen px-8 py-8 bg-white border border-gray-200 
    dark:bg-gray-700 dark:border-gray-600 rounded-lg shadow-sm">

    {{-- Titulo --}}
    <h1 class="text-2xl font-bold leading-tight tracking-tight text-center
        text-gray-900 md:text-2xl dark:text-white">
        Por favor verifica tu email haciendo clic en el enlace que acabamos de enviarte.
    </h1>

    @if (session('status') == 'verification-link-sent')
        <h2 class="text-center font-medium !dark:text-green-400 !text-green-600">
            Un nuevo enlace de verificación ha sido enviado a la dirección de correo electrónico que proporcionaste durante
            el registro.
        </h2>
    @endif

    <x-formularios.div class="mt-6">
        <x-botones.estandar wire:click="sendVerification" class="w-full" type="submit" variant="primary">
            Enviar nuevo link de verificación
        </x-botones.estandar>
    </x-formularios.div>

    <x-formularios.div class="mt-6">
        <x-botones.estandar wire:click="logout" class="w-full" type="button" variant="secondary">
            Cerrar sesión
        </x-botones.estandar>
    </x-formularios.div>
</div>