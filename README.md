# Proyecto Veterinaria - Laravel 12

Este es un sistema de gestión para una veterinaria desarrollado con Laravel 12, integrando la plantilla **SB Admin 2** de StartBootstrap para una interfaz profesional y responsiva.

## 🚀 Características

- **Autenticación Completa**: Sistema de login personalizado.
- **Roles de Usuario**: Diferenciación entre `administrador` y `veterinario`.
- **Dashboards Diferenciados**: 
  - Panel oscuro y robusto para administradores.
  - Panel azul estándar para veterinarios.
- **Layouts Modulares**: Uso de componentes Blade (partials) para sidebar, topbar y footer.
- **Base de Datos**: Migraciones y Seeders configurados para pruebas inmediatas.

## 🆕 Cambios e Implementaciones Recientes (Módulo de Usuarios)

Se ha completado e integrado con éxito todo el módulo de **Gestión de Usuarios** con altos estándares de seguridad y experiencia de usuario (UX):

1.  **Form Requests Independientes:**
    - Se aisló la validación del controlador usando clases dedicadas: `StoreUserRequest` y `UpdateUserRequest`.
    - Lógica de correo único inteligente que excluye al propio usuario en la edición.
    - Contraseña opcional para edición (no se sobrescribe si se deja vacía).

2.  **Traducción e Idioma al Español (ES):**
    - Se creó el archivo de lenguaje nativo `lang/es/validation.php` para traducir todos los mensajes del sistema y personalizar los nombres de los campos (`nombre completo`, `correo electrónico`, etc.).

3.  **Paginación a Medida (Bootstrap 4):**
    - Se configuró la paginación a nivel de servidor (por defecto 2 registros en desarrollo para pruebas inmediatas).
    - Se adaptó Laravel en `AppServiceProvider` para utilizar el motor visual de `Bootstrap 4` en los controles de paginación.

4.  **Confirmación y Seguridad en la Eliminación (FK Constraints):**
    - Se creó la vista `show.blade.php` que actúa como pantalla de doble confirmación.
    - **Validación de integridad referencial (FK):** El sistema detecta automáticamente si el usuario veterinario tiene consultas médicas registradas. En caso afirmativo, **bloquea el botón de borrado** para prevenir daños en la base de datos. Si no tiene consultas, permite el borrado seguro.

5.  **Alertas Interactivas:**
    - Alertas de éxito y de restricción autodescartables integradas en la parte superior de la tabla de listado.

6.  **Corrección de Importaciones del Sistema:**
    - Se resolvió un error de Fatal Error general del framework importando de forma proactiva el Trait `HasFactory` en todos los modelos del sistema (`Veterinario`, `Consulta`, `Mascota`, `Dueno`, etc.).

## 🛠️ Instalación y Configuración

1.  **Clonar el repositorio:**
    ```bash
    git clone https://github.com/km3236833-netizen/Veterinaria-.git
    cd Veterinaria-
    ```

2.  **Instalar dependencias:**
    ```bash
    composer install
    npm install && npm run dev
    ```

3.  **Configurar el entorno:**
    - Copia el archivo `.env.example` a `.env`.
    - Configura tus credenciales de base de datos en el archivo `.env`.
    - Genera la clave de la aplicación: `php artisan key:generate`.

4.  **Ejecutar migraciones y seeders:**
    ```bash
    php artisan migrate:fresh --seed
    ```

## 🔐 Credenciales de Prueba

El sistema viene preconfigurado con los siguientes usuarios tras ejecutar los seeders:

| Rol | Usuario | Contraseña |
| :--- | :--- | :--- |
| **Administrador** | `admin@gmail.com` | `admin` |
| **Veterinario** | `veterinario@gmail.com` | `veterinario` |

## 📁 Estructura de Vistas

- `resources/views/layouts/`: Contiene los layouts `app`, `auth` y `admin`.
- `resources/views/layouts/partials/`: Componentes reutilizables (sidebar, topbar, etc.).
- `resources/views/modules/`: Vistas específicas de cada módulo (auth, dashboard, admin).

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia [MIT](https://opensource.org/licenses/MIT).
