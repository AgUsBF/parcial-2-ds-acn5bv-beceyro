# Gestor de Historial Médico de Mascotas

Aplicación web con fines educativos, desarrollada con Laravel para gestionar usuarios, mascotas, especies, roles y citas veterinarias.

Se implementó una versión preliminar a modo de mock-up del módulo de gestión de mascotas, con soporte de especies, roles y usuarios como entidades asociadas.

## Tecnología

- PHP 8.2+
- Laravel 12
- Composer
- Node.js y npm
- PostgreSQL

## Instalación

1. Clonar el repositorio.
2. Instalar dependencias PHP: `composer install`
3. Instalar dependencias frontend: `npm install`
4. Crear un archivo `.env` a partir de `.env.example`. Dado que es un proyecto académico y en modo de desarrollo local, el ejemplo ya se encuentra preconfigurado.
5. Generar la clave de la aplicación: `php artisan key:generate`
6. Crear la base de datos en PostgreSQL con nombre `dsapp_db`.
7. Ejecutar migraciones y seeders: `php artisan migrate --seed`
8. Compilar assets frontend: `npm run build`

## Configuración de base de datos

En el archivo `.env.example` ya se encuentra la conexión básica a PostgreSQL con los parámetros predefinidos para una base de datos local de pruebas. Solo se debe ajustar el puerto o el host en caso que se modifiquen los valores por defecto.

## Ejecución

- En una terminal, iniciar el servidor de desarrollo: `php artisan serve`
- En otra terminal, iniciar Vite para assets: `npm run dev`

## Pruebas

Para ejecutar las pruebas automatizadas del proyecto: `php artisan test`

## Uso demo

Los seeders crean usuarios de ejemplo para probar el sistema:

- Administrador: `admin@test.com` / `1234`
- Propietario: `user1@test.com` / `1234`
- Veterinario: `veterinario1@test.com` / `1234`
