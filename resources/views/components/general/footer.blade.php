<footer class="bg-white shadow-sm dark:bg-gray-900">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            {{-- Logo + Titulo + Link --}}
            <a href="{{ route('home') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('favicon.png') }}" class="h-8" alt="Logo AguaraVet" />

                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                    AguaraVet
                </span>
            </a>

            {{-- Links Redes --}}
            <a class="" href="https://www.facebook.com">
                <img src="{{ asset('img/logos/facebook.svg') }}" class="h-8" alt="Logo Facebook" />
            </a>

            <a class="" href="https://www.instagram.com">
                <img src="{{ asset('img/logos/instagram.svg') }}" class="h-8 " alt="Logo Instagram" />
            </a>

            <a class="" href="https://twitter.com">
                <img src="{{ asset('img/logos/twitter.svg') }}" class="h-8" alt="Logo Twitter" />
            </a>

            <a class="" href="https://www.whatsapp.com/">
                <img src="{{ asset('img/logos/whatsapp.svg') }}" class="h-8" alt="Logo Whatsapp" />
            </a>

            <div></div>
        </div>

        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />

        {{-- Legales --}}
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © 2026 AguaraVet - Todos los derechos reservados.
        </span>
    </div>
</footer>