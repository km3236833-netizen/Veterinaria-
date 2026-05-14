# Proyecto Veterinaria - Laravel 11

Este es un sistema de gestión para una veterinaria desarrollado con Laravel 11, integrando la plantilla **SB Admin 2** de StartBootstrap para una interfaz profesional y responsiva.

## 🚀 Características

- **Autenticación Completa**: Sistema de login personalizado.
- **Roles de Usuario**: Diferenciación entre `administrador` y `veterinario`.
- **Dashboards Diferenciados**: 
  - Panel oscuro y robusto para administradores.
  - Panel azul estándar para veterinarios.
- **Layouts Modulares**: Uso de componentes Blade (partials) para sidebar, topbar y footer.
- **Base de Datos**: Migraciones y Seeders configurados para pruebas inmediatas.

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
