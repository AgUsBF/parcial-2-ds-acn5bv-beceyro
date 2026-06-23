<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            @if(Route::is('animals.show'))
                Detalle de Mascota
            @elseif($animal)
                Editar Mascota
            @else
                Crear Nueva Mascota
            @endif
        </x-general.titular>

        <div class="w-full max-w-2xl mx-auto mt-8 px-4">
            {{-- Mensajes de feedback --}}
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-md p-6">
                @php
                    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
                    $readonly = Route::is('animals.show');
                    $currentUser = auth()->user();
                    $isOwnerUser = $currentUser?->role_id === \App\Models\Role::NORMAL_ID;
                @endphp

                @if(!$readonly)
                    <form action="{{ $animal ? route('animals.update', ['animal' => $animal->id]) : route('animals.store') }}"
                        method="POST" class="space-y-6">
                        @csrf
                        @if($animal)
                            @method('PUT')
                        @endif
                @else
                    <div class="space-y-6">
                @endif

                    {{-- Campo Nombre --}}
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nombre de la Mascota
                        </label>

                        <input type="text" name="name" id="name"
                            value="{{ old('name', $animal?->name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Ej. Luna" required
                            @if($readonly) disabled @endif>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Campo Fecha de Nacimiento --}}
                    <div>
                        <label for="birth_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fecha de Nacimiento
                        </label>

                        <input type="date" name="birth_date" id="birth_date"
                            value="{{ old('birth_date', $animal?->birth_date?->format('Y-m-d')) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required
                            @if($readonly) disabled @endif>
                        @error('birth_date')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Campo Sexo --}}
                    <div>
                        <label for="sex" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Sexo
                        </label>

                        <select name="sex" id="sex"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required
                            @if($readonly) disabled @endif>
                            <option value="">Seleccione una opción</option>
                            <option value="Macho" {{ old('sex', $animal?->sex) == 'Macho' ? 'selected' : '' }}>Macho</option>
                            <option value="Hembra" {{ old('sex', $animal?->sex) == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                        </select>
                        @error('sex')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Campo Esterilización --}}
                    <div>
                        <label for="is_sterilized" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            ¿Está esterilizado?
                        </label>

                        <select name="is_sterilized" id="is_sterilized"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required
                            @if($readonly) disabled @endif>
                            <option value="">Seleccione una opción</option>
                            <option value="1" {{ old('is_sterilized', $animal?->is_sterilized) == '1' ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('is_sterilized', $animal?->is_sterilized) == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('is_sterilized')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Campo Comentario --}}
                    <div>
                        <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Comentario
                        </label>

                        <textarea name="comment" id="comment" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Agregar observaciones adicionales"
                            @if($readonly) disabled @endif>{{ old('comment', $animal?->comment) }}</textarea>
                        @error('comment')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Campo Especie --}}
                    <div>
                        <label for="specie_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Especie
                        </label>

                        <select name="specie_id" id="specie_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required
                            @if($readonly) disabled @endif>
                            <option value="">Seleccione una especie</option>
                            @foreach($species as $specie)
                                <option value="{{ $specie->id }}" {{ old('specie_id', $animal?->specie_id) == $specie->id ? 'selected' : '' }}>
                                    {{ $specie->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('specie_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Campo Usuario / Propietario --}}
                    @if(!$isOwnerUser)
                        <div>
                            <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Propietario
                            </label>

                            <select name="user_id" id="user_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required
                                @if($readonly) disabled @endif>
                                <option value="">Seleccione un propietario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $animal?->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="user_id" value="{{ old('user_id', $animal?->user_id ?? $currentUser?->id) }}">
                    @endif

                    {{-- Botones de Accion --}}
                    <div class="flex items-center justify-between space-x-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('animals.index') }}"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-750">
                            Volver
                        </a>

                        @if(!$readonly)
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Guardar
                            </button>
                        @endif
                    </div>

                @if(!$readonly)
                    </form>
                @else
                    </div>
                @endif
            </div>
        </div>
    </x-general.cuerpo>
</x-layouts.plantilla>