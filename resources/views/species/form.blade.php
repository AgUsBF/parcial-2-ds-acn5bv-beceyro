<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            @if(Route::is('species.show'))
                Detalle de Especie
            @elseif($specie)
                Editar Especie
            @else
                Crear Nueva Especie
            @endif
        </x-general.titular>

        <div class="w-96 mx-auto mt-8 px-4">
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
                    $readonly = Route::is('species.show');
                @endphp

                @if(!$readonly)
                    <form action="{{ $specie ? route('species.update', ['species' => $specie->id]) : route('species.store') }}"
                        method="POST" class="space-y-6">
                        @csrf
                        @if($specie)
                            @method('PUT')
                        @endif
                @else
                        <div class="space-y-6">
                    @endif

                        {{-- Campo Nombre --}}
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nombre de la Especie
                            </label>

                            <input type="text" name="name" id="name" 
                                value="{{ old('name', $specie?->name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Ej. Perro" required 
                                @if($readonly) disabled @endif>
                            @if ($errors->has('name'))
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>

                        {{-- Botones de Accion --}}
                        <div
                            class="flex items-center justify-between space-x-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('species.index') }}"
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