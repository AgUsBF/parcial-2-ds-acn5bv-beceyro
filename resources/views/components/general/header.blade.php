<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            {{-- Logo + Titulo + Link --}}
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('favicon.png') }}" class="mr-3 h-6 sm:h-9" alt="Logo AguaraVet" />

                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                    AguaraVet
                </span>
            </a>

            {{-- Botonera --}}
            <div class="flex items-center lg:order-2 space-x-2">
                {{-- Login --}}
                @auth
                    <div class="relative inline-block text-left">
                        <x-botones.estandar id="user-menu" type="button" class="flex items-center 
                            justify-center w-10 h-10 text-white bg-gray-800 rounded-md hover:bg-gray-700 
                            focus:outline-none focus:ring-2 focus:ring-gray-300">
                            {{ Auth::user()->initials() }}
                        </x-botones.estandar>

                        <div id="dropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg dark:bg-gray-800 z-50">

                            {{-- Dashboard para staff --}}
                            {{-- @if(Auth::user()->isAdmin()) --}}
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 
                                hover:bg-gray-100 dark:hover:bg-gray-600">
                                Dashboard
                            </a>
                            {{-- @endif --}}

                            {{-- Cerrar sesión --}}
                            <hr class="border-gray-200 dark:border-gray-600">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 
                                    dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>

                    <script>
                        document.getElementById('user-menu').addEventListener('click', function () {
                            document.getElementById('dropdown').classList.toggle('hidden');
                        });
                    </script>
                @else
                    <a href="{{ route('login') }}">
                        <x-botones.estandar class="text-sm" type="button">
                            Iniciar Sesión
                        </x-botones.estandar>
                    </a>
                @endauth

                {{-- Menu colapsable --}}
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Abrir Menu</span>

                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>

                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>