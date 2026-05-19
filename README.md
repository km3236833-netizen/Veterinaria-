# Proyecto Veterinaria - Laravel 12

Este es un sistema de gestión para una veterinaria desarrollado con Laravel 12, integrando la plantilla **SB Admin 2** de StartBootstrap para una interfaz profesional y responsiva.

---

## 🚀 Características Principales

- **Autenticación Completa**: Sistema de login personalizado con soporte de roles.
- **Roles de Usuario**: Diferenciación entre `administrador` y `veterinario` para accesos protegidos.
- **Dashboards Diferenciados**: 
  - Panel oscuro y robusto para administradores.
  - Panel azul estándar para veterinarios.
- **Layouts Modulares**: Uso de componentes Blade (partials) para sidebar, topbar y footer.
- **Base de Datos**: Migraciones y Seeders configurados para pruebas inmediatas en SQLite.

---

## 🆕 Cambios e Implementaciones Recientes

### 1. Gestión de Usuarios (Módulo Admin)
* **Form Requests Independientes:** Validación aislada del controlador usando `StoreUserRequest` y `UpdateUserRequest`.
* **Traducción al Español:** Archivo `lang/es/validation.php` para internacionalizar todos los mensajes y campos.
* **Seguridad en la Eliminación (FK Constraints):** Doble confirmación en la vista `show.blade.php`. Si un veterinario tiene consultas registradas, el sistema bloquea preventivamente su borrado para resguardar la integridad referencial de los expedientes.
* **Paginación Adaptada:** Uso de paginación fluida por servidor integrada con los estilos visuales de `Bootstrap 4` en `AppServiceProvider`.

### 2. Módulo de Dueños y Mascotas (CRUD Completo & Relaciones)
* **Exclusión de Redes Sociales:** Conforme a los requisitos, se omitió por completo el campo `redes_sociales` a nivel de base de datos (migración), modelo `Dueno` y todos los formularios correspondientes.
* **Controladores RESTful robustos:**
  * `DuenoController.php` gestiona el registro, listado y modificaciones del propietario.
  * `MascotaController.php` asocia eficientemente la mascota con su respectivo dueño y carga su historial clínico.
* **Vistas de Apoyo:** Diseñadas en armonía visual con SB Admin 2 para listar, crear, editar y visualizar expedientes en `resources/views/modules/duenos` y `resources/views/modules/mascotas`.

### 3. Buscador en Tiempo Real y Selección Reactiva
* **Buscador de Pacientes:** Se incorporó un campo de texto interactivo con JavaScript en la vista de `expedientes.blade.php`. Filtra instantáneamente la tabla por folio (ID), nombre del paciente, especie, raza o nombre del dueño directamente en el cliente.
* **Buscador Reactivo de Dueños:** En los formularios de registro y edición de mascotas, se implementó un control de búsqueda de texto. **En la parte inferior de ese control**, se genera un listado interactivo en tiempo real que filtra a los dueños registrados en la base de datos y permite seleccionarlos con un solo clic, bloqueando la selección de forma clara e intuitiva.

### 4. Mapeo y Corrección de Integridad Clínica
* **Definición de Tablas Explícitas:** Se corrigió un desfase de pluralización entre los modelos y las tablas físicas de la base de datos agregando la propiedad `protected $table` en:
  * `AntecedenteAlergia` $\rightarrow$ `antecedentes_alergias`
  * `AntecedenteLesion` $\rightarrow$ `antecedentes_lesiones`
  * `AntecedentePatologico` $\rightarrow$ `antecedentes_patologicos`
  * `HistorialAlimentacion` $\rightarrow$ `historial_alimentacion`
* **Sincronización de Columnas de Expediente:** Se reestructuró la vista de expediente de mascota (`modules/mascotas/show.blade.php`) con pestañas interactivas, mapeando con precisión los campos exactos de las migraciones: `sustancia_alergena` (alergias), `tipo_lesion` (lesiones), `enfermedad` y `es_cronica` (patologías) y `descripcion_dieta` y `frecuencia_diaria` (dieta).

### 5. Historial Clínico Completo y Seeding
* Se potenció el seeder `DuenoMascotaSeeder.php` para precargar:
  * Un perfil clínico del **Dr. Fernando Ortiz** asociado a la cuenta de veterinario de prueba.
  * 4 propietarios y 4 mascotas con edades, especies y tipos de sangre variados.
  * Historiales de consulta médica detallados con peso, talla, diagnósticos y tratamientos clínicos vinculados.

---

## 🔍 Plan de Búsqueda con Laravel Scout
Se diseñó un plan de arquitectura detallado en `scout_implementation_plan.md` para integrar a futuro Laravel Scout usando el driver `database` para SQLite. Permite búsquedas de texto completo en la base de datos por folio, mascota y dueño sin dependencias externas de servidores.

---

## 🛠️ Instalación y Configuración

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/km3236833-netizen/Veterinaria-.git
   cd Veterinaria-
   ```

2. **Instalar dependencias:**
   ```bash
   composer install
   ```

3. **Configurar el entorno:**
   * Copia el archivo `.env.example` a `.env`.
   * Crea el archivo de base de datos SQLite vacío: `database/database.sqlite`.
   * Genera la clave de la aplicación: `php artisan key:generate`.

4. **Ejecutar migraciones y seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## 🔐 Credenciales de Prueba

El sistema viene preconfigurado con los siguientes usuarios tras ejecutar los seeders:

| Rol | Usuario | Contraseña |
| :--- | :--- | :--- |
| **Administrador** | `admin@gmail.com` | `admin` |
| **Veterinario** | `veterinario@gmail.com` | `veterinario` |

---

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia [MIT](https://opensource.org/licenses/MIT).
