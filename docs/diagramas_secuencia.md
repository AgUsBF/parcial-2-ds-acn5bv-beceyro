# Diagramas de Secuencia

## 1. Diagrama de Secuencia de Registro de Usuario

El registro se gestiona mediante el componente Livewire Volt `auth.register` (`resources/views/livewire/auth/register.blade.php`) y utiliza el componente de formulario `<x-formularios.armados.registro />`. Detalles del flujo:

1. **Acceso:** El usuario navega a la URL `/register`.
2. **Ruta:** El Router de Laravel mapea la ruta `register` al componente Volt `auth.register`.
3. **Renderizado:** Se utiliza el layout de autenticación `components.layouts.auth` y se inyecta el componente de formulario `registro`.
4. **Envío:** Al enviar el formulario, Livewire intercepta el evento con `wire:submit.prevent="register"`.
5. **Validación:** Se validan los datos (Nombre, Email con regla unique, Contraseña con regla `confirmed` y reglas por defecto).
6. **Almacenamiento y Eventos:** Se hashea la contraseña, se crea el registro de usuario en la base de datos, se dispara el evento nativo de Laravel `Registered` (para posibles listeners como envío de correo de verificación) y se inicia la sesión automáticamente con `Auth::login($user)`.
7. **Redirección:** El usuario es redirigido de forma asíncrona hacia el Dashboard principal con soporte de navegación SPA (`navigate: true`).

---

## 2. Diagrama de Secuencia de Inicio de Sesión (Login)

El inicio de sesión se gestiona mediante el componente Livewire Volt `auth.login` (`resources/views/livewire/auth/login.blade.php`) y utiliza el componente de formulario `<x-formularios.armados.login />`. Incluye protección contra ataques de fuerza bruta mediante limitación de tasa (Rate Limiting). Detalles del flujo:

1. **Acceso:** El usuario accede a la URL `/login`.
2. **Ruta:** El Router de Laravel mapea la ruta `login` al componente Volt `auth.login`.
3. **Control de Tasa (Rate Limiting):** Antes del intento de autenticación, el método `ensureIsNotRateLimited` verifica con la IP del cliente y el correo electrónico (`throttleKey`) si se han superado los 5 intentos permitidos. En caso afirmativo, se dispara el evento `Lockout` y se bloquea temporalmente al usuario con una `ValidationException`.
4. **Intento de Autenticación:** Se utiliza `Auth::attempt` pasando las credenciales e indicando si se debe recordar la sesión (`remember`).
5. **Fallo de Login:** Si las credenciales no son válidas, se incrementa el contador del limitador (`RateLimiter::hit`) y se le notifica al usuario.
6. **Éxito de Login:** Si son correctas, se limpia el limitador (`RateLimiter::clear`), se regenera el ID de la sesión para evitar ataques de fijación de sesión (`Session::regenerate`), y se le redirige al dashboard o a la ruta que intentaba acceder originalmente mediante `$this->redirectIntended()`.

---

## 3. Diagrama de Secuencia Genérico CRUD

El flujo genérico de gestión de entidades como `Role` y `Specie` sigue un patrón común en los controladores `RoleController` y `SpecieController`, así como en sus vistas Blade y modelos Eloquent. Este proceso cubre las operaciones de listado, creación, edición, actualización y eliminación.

Detalles del flujo:

1. **Acceso a la interfaz:** El usuario entra a la vista de listado (`index`) o a un formulario (`create`, `edit` o `show`).
2. **Solicitud a la vista:** La vista Blade renderiza la interfaz correspondiente y, si corresponde, muestra botones para crear, editar o eliminar registros.
3. **Invocación del controlador:** Al interactuar con la aplicación, la ruta llama al método del controlador correspondiente: `index()`, `create()`, `edit()`, `show()`, `store()`, `update()` o `destroy()`.
4. **Validación de datos:** En los casos de creación y actualización, el controlador delega la validación al `Request` correspondiente (`RoleRequest` o `SpecieRequest`) mediante `validated()`.
5. **Persistencia en el modelo:** El controlador utiliza el modelo `Role` o `Specie` para ejecutar la operación deseada:
   - `create($data)` para insertar un nuevo registro,
   - `update($data)` para modificar uno existente,
   - `delete()` para eliminar un registro.
6. **Interacción con la base de datos:** El modelo Eloquent ejecuta la operación sobre la tabla correspondiente (`roles` o `species`) y devuelve el resultado al controlador.
7. **Respuesta del controlador:** Según el resultado, el controlador devuelve una redirección con un mensaje de éxito o error mediante `redirect()->route(...)->with('success'|'error')`.
8. **Feedback visual:** La vista muestra el mensaje de feedback al usuario y recarga la interfaz con el estado actualizado del listado o del formulario.

Este patrón es representativo porque los módulos comparten la misma arquitectura: vista Blade, controlador, request de validación, modelo Eloquent y base de datos, con un flujo de redirección y mensajes de estado muy similar.
