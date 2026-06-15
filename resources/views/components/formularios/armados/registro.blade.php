<form wire:submit.prevent="register" class="space-y-4 md:space-y-6">
    {{-- Nombre --}}
    <x-formularios.div>
        <x-formularios.label for="nombre">
            Nombre
        </x-formularios.label>

        <x-formularios.campo type="text" model="name" id="nombre" placeholder="nombre" required />

        @error('name')
            <span class="text-red-500 text-sm">
                {{ $message }}
            </span>
        @enderror
    </x-formularios.div>

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
</form>