<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @livewireStyles

    <title>AguaraVet</title>
</head>

<body class="h-screen flex flex-col">
    {{-- Header --}}
    <x-general.header />

    {{-- Contenido --}}
    <main class="flex-1 bg-white dark:bg-gray-800">

        {{ $slot }}

    </main>

    {{-- Footer --}}
    <x-general.footer />

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- Configurar CSRF token para Livewire --}}
    <script>
        // Configurar token CSRF para Livewire
        window.livewire = window.livewire || {};
        window.livewire.beforeRequest = (url, options) => {
            options.headers = options.headers || {};
            options.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
        };
    </script>

    {{-- Script para manejar eventos de Livewire --}}
    <script>
        // Función global para cerrar modales
        function closeModal(modalId) {
            console.log('Cerrando modal:', modalId);
            const modal = document.getElementById(modalId);
            if (modal) {
                const modalInstance = new Modal(modal);
                modalInstance.hide();

                // También disparar evento de Livewire por si es necesario
                window.dispatchEvent(new CustomEvent('close-modal', {
                    detail: [modalId]
                }));
            }
        }

        // Escuchar evento para abrir modal
        window.addEventListener('open-modal', event => {
            const modalId = event.detail[0];
            console.log('Intentando abrir modal:', modalId);
            const modal = document.getElementById(modalId);
            console.log('Modal encontrado:', modal);
            if (modal) {
                // Usar la API de Flowbite para abrir el modal
                const modalInstance = new Modal(modal);
                modalInstance.show();
            } else {
                console.error('Modal no encontrado con ID:', modalId);
            }
        });

        // Escuchar evento para cerrar modal
        window.addEventListener('close-modal', event => {
            const modalId = event.detail[0];
            console.log('Intentando cerrar modal:', modalId);
            const modal = document.getElementById(modalId);
            if (modal) {
                // Usar la API de Flowbite para cerrar el modal
                const modalInstance = new Modal(modal);
                modalInstance.hide();
            }
        });

        // Asegurar que los modales estén disponibles después de cargar Livewire
        document.addEventListener('livewire:load', function () {
            console.log('Livewire cargado, verificando modales...');
            const deleteModal = document.getElementById('modal-eliminar-usuario');
            console.log('Modal eliminar encontrado:', deleteModal);
        });

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                // Encontrar el modal abierto y cerrarlo
                const openModal = document.querySelector('.fixed.z-50:not(.hidden)');
                if (openModal) {
                    closeModal(openModal.id);
                }
            }
        });
    </script>
</body>

</html>