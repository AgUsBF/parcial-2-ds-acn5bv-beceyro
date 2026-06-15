<form wire:submit.prevent="login" class="space-y-4 md:space-y-6">
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

    {{-- Recordarme --}}
    <x-formularios.div class="flex items-center justify-center">
        <div class="flex items-center">
            {{-- Checkbox --}}
            <div class="mr-2 mb-2">
                <x-formularios.campo type="checkbox" model="remember" id="remember" />
            </div>

            {{-- Label --}}
            <x-formularios.label class="text-md" for="remember">
                Recordarme
            </x-formularios.label>
        </div>
    </x-formularios.div>

    {{-- Boton --}}
    <x-formularios.div>
        <x-botones.estandar class="w-full" type="submit">
            Ingresar
        </x-botones.estandar>
    </x-formularios.div>

    {{-- Olvido de password --}}
    <x-formularios.link href="{{ route('password.request') }}">
        ¿Te olvidaste la contraseña?
    </x-formularios.link>
</form>