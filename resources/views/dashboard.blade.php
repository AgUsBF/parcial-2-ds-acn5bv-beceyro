<x-layouts.plantilla>
    <x-general.cuerpo>
        {{-- Titulo --}}
        <x-general.titular>
            Panel de Gestión
        </x-general.titular>

        {{-- Para todo el equipo --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="mb-8 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                General
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Mascotas --}}
                <x-tarjetas.dashboard>
                    <x-general.div-svg color="gray">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </x-general.div-svg>

                    <x-general.link-dashboard color="gray" title="Mascotas" ruta="animals.index" />
                </x-tarjetas.dashboard>

                {{-- Veterinarios --}}
                <x-tarjetas.dashboard>
                    <x-general.div-svg color="gray">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </x-general.div-svg>

                    <x-general.link-dashboard color="gray" title="Veterinarios" ruta="" />
                </x-tarjetas.dashboard>

                {{-- Turnos --}}
                <x-tarjetas.dashboard>
                    <x-general.div-svg color="gray">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </x-general.div-svg>

                    <x-general.link-dashboard color="gray" title="Turnos" ruta="" />
                </x-tarjetas.dashboard>
            </div>
        </div>

        {{-- Para Admins --}}
        @if(Auth::user()->isAdmin())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

                <h2 class="mb-8 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Administración de Sistema
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Usuarios --}}
                    <x-tarjetas.dashboard>
                        <x-general.div-svg color="gray">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </x-general.div-svg>

                        <x-general.link-dashboard color="gray" title="Usuarios" ruta="users.index" />
                    </x-tarjetas.dashboard>

                    {{-- Roles --}}
                    <x-tarjetas.dashboard>
                        <x-general.div-svg color="gray">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </x-general.div-svg>

                        <x-general.link-dashboard color="gray" title="Roles" ruta="roles.index" />
                    </x-tarjetas.dashboard>

                    {{-- Especies --}}
                    <x-tarjetas.dashboard>
                        <x-general.div-svg color="gray">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0 1 12 12.75Zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 0 1-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 0 0 2.248-2.354M12 12.75a2.25 2.25 0 0 1-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 0 0-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 0 1 .4-2.253M12 8.25a2.25 2.25 0 0 0-2.248 2.146M12 8.25a2.25 2.25 0 0 1 2.248 2.146M8.683 5a6.032 6.032 0 0 1-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0 1 15.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 0 0-.575-1.752M4.921 6a24.048 24.048 0 0 0-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 0 1-5.223 1.082" />
                            </path>
                        </x-general.div-svg>

                        <x-general.link-dashboard color="gray" title="Especies" ruta="species.index" />
                    </x-tarjetas.dashboard>
                </div>
            </div>
        @endif

    </x-general.cuerpo>

</x-layouts.plantilla>