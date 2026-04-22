<video width="600" controls>
  <source src="presentacion_completa.mp4" type="video/mp4">
  Tu navegador no soporta el video.
</video>

# Usuarios de Prueba

| ID | Nombre   | Email             | Contraseña | Rol      |
|----|----------|-------------------|------------|----------|
| 1  | admin    | admin@gmail.com   | `12345`    | admin    |
| 2  | Daniela  | daniela@mail.com  | `1234`     | empleado |
| 3  | Marcos   | marcos@mail.com   | `1234`     | empleado |
| 4  | Gianluca | gianluca@mail.com | `1234`     | empleado |

> **Nota:** Las contraseñas están hasheadas con MD5 en la base de datos.

# Autenticación

Gestión de sesión de usuario: inicio y cierre de sesión.

---

## `logout.php`

Destruye la sesión activa y redirige al login.

**Flujo:**
1. Inicia la sesión para poder acceder a ella.
2. Limpia todas las variables de sesión.
3. Destruye la sesión.
4. Redirige al usuario a la pantalla de login.

---

## `procesar_login.php`

Autentica al usuario con email y contraseña contra la base de datos.

**Flujo:**
1. Recibe `email` y `password` por `POST`.
2. Busca al usuario en la tabla `usuarios` por email.
3. Compara la contraseña ingresada (hasheada con `md5`) con la almacenada.
4. Si coinciden, guarda `usuario_id`, `rol` y `nombre` en `$_SESSION` y redirige al dashboard.
5. Si no coinciden, redirige al login anunciando un error.

**Variables de sesión registradas:**

| Variable                   | Descripción                            |
|----------------------------|----------------------------------------|
| `$_SESSION['usuario_id']`  | ID del usuario autenticado             |
| `$_SESSION['rol']`         | Rol del usuario (`admin` / `empleado`) |
| `$_SESSION['nombre']`      | Nombre del usuario                     |

> **Nota:** Las contraseñas se comparan usando `hash_equals()` con `md5`.

---

## Servicios relacionados

| Archivo                | Responsabilidad                               |
|------------------------|-----------------------------------------------|
| `UsuarioServicio.php`  | CRUD de usuarios, validación de datos y roles  |
| `VehiculoServicio.php` | CRUD de vehículos, subida y gestión de imágenes|


# Base de datos - `agencia`

<img src="./bd/DER.pdf" alt="Diagrama Entidad Relacion"></img>

Dentro de la carpeta bd se encuentra el archivo:
* agencia.sql: contiene la estructura completa de la base de datos del sistema, incluyendo la creación de tablas (usuarios, vehículos, etc.), relaciones y datos iniciales.

## Tabla `usuarios`

Almacena los usuarios del sistema con su rol de acceso.

| Columna    | Tipo                       | Restricciones               |
|------------|----------------------------|-----------------------------|
| `id`       | `int(11)`                  | PK, AUTO_INCREMENT          |
| `nombre`   | `varchar(100)`             | NOT NULL                    |
| `email`    | `varchar(100)`             | NOT NULL, UNIQUE            |
| `password` | `varchar(255)`             | NOT NULL (hash MD5)         |
| `rol`      | `enum('admin','empleado')` | DEFAULT `'empleado'`        |

---

## Tabla `vehiculos`

Almacena los vehículos cargados en el sistema, asociados a un usuario.

| Columna       | Tipo            | Restricciones                                        |
|---------------|-----------------|------------------------------------------------------|
| `id`          | `int(11)`       | PK, AUTO_INCREMENT                                   |
| `marca`       | `varchar(50)`   | NOT NULL                                             |
| `modelo`      | `varchar(50)`   | NOT NULL                                             |
| `anio`        | `int(11)`       | NOT NULL                                             |
| `precio`      | `decimal(10,2)` | NOT NULL                                             |
| `tipo`        | `varchar(50)`   | nullable (`Auto`, `SUV`, `Pick-up`, `Utilitario`)    |
| `color`       | `varchar(50)`   | nullable                                             |
| `imagen`      | `varchar(255)`  | nullable (nombre de archivo sin extensión)           |
| `usuario_id`  | `int(11)`       | FK → `usuarios.id` · ON DELETE SET NULL              |
| `transmision` | `varchar(50)`   | nullable (`Manual`, `Automatica`)                    |

---

## Relación

`usuarios` **1 → N** `vehiculos` a través de `usuario_id`.
Si se elimina un usuario, los vehículos asociados quedan con `usuario_id = NULL` (no se eliminan en cascada).

---

> **Nota de seguridad:** Las contraseñas están almacenadas como hash `MD5`.

# Clases

## 1. Arquitectura del módulo

El sistema implementa una separación entre:

- **Clases de dominio:** representan entidades del sistema (`Usuario`, `Vehiculo`).
- **Clases derivadas:** especializan comportamientos (`Administrador`, `Empleado`).
- **Acceso a datos:** gestionado mediante la clase `BD` usando PDO.
- **Excepciones:** control de errores mediante clases personalizadas.

---

## 2. Modelo de objetos (POO)

### A. Clase `Usuario`

Representa a un usuario del sistema.

**Propiedades:**

- `id`
- `nombre`
- `email`
- `password`
- `rol`

**Características:**

- Los atributos están definidos como `protected`.
- Se accede a ellos mediante métodos públicos (getters y setters).
- Se aplican validaciones en setters (email válido, contraseña mínima, etc.).

---

### B. Clase `Administrador`

Hereda de `Usuario`.

**Responsabilidades:**

- Crear usuarios.
- Actualizar usuarios.
- Eliminar usuarios.

**Características:**

- Utiliza PDO para interactuar con la base de datos.
- Aplica hash MD5 a las contraseñas antes de almacenarlas.

---

### C. Clase `Empleado`

Hereda de `Usuario`.

**Responsabilidad:**

- Obtener los vehículos cargados por el usuario autenticado.

**Funcionalidad:**

- Consulta la base de datos filtrando por `usuario_id`.

---

### D. Clase `Vehiculo`

Representa un vehículo dentro del sistema.

**Propiedades:**

- `marca`
- `modelo`
- `anio`
- `precio`
- `tipo`
- `color`
- `imagen`
- `usuario_id`
- `transmision`

**Características:**

- Atributos `private` para mayor encapsulamiento.
- Validaciones en setters:
  - Año válido (entre 1886 y actual).
  - Precio mayor a 0.
  - Campos obligatorios no vacíos.

---

## 3. Encapsulamiento

El sistema aplica encapsulamiento mediante:

- Uso de atributos `private` y `protected`.
- Acceso controlado mediante getters y setters.
- Validación de datos antes de ser asignados.

Esto permite mantener la integridad de los datos y evitar accesos indebidos.

---

## 4. Herencia

Se implementa herencia para reutilizar código:

- `Usuario` → clase base
- `Administrador` y `Empleado` → clases hijas

Esto permite:

- Reutilizar propiedades comunes.
- Especializar comportamientos según el rol.

---

## 5. Persistencia de datos (PDO)

La clase `BD` implementa el patrón Singleton para gestionar la conexión a la base de datos.

**Características:**

- Una única instancia de conexión (PDO).
- Manejo de errores mediante `PDO::ERRMODE_EXCEPTION`.
- Uso de sentencias preparadas para evitar inyección SQL.

---

## 6. Manejo de excepciones

Se utilizan excepciones personalizadas:

- `UsuarioException`
- `VehiculoException`

**Objetivo:**

- Validar datos.
- Controlar errores de negocio.
- Mostrar mensajes claros al usuario.

---

## 7. Validaciones

El sistema valida los datos antes de procesarlos:

**Usuario:**

- Email válido (`filter_var`)
- Contraseña mínima de 6 caracteres
- Nombre obligatorio

**Vehículo:**

- Año válido
- Precio mayor a 0
- Campos obligatorios completos

---

## 8. Relación entre entidades

- Un `Usuario` puede tener múltiples `Vehiculos`.
- Relación: 1 → N
- Se implementa mediante el campo `usuario_id`.

---

## 9. Buenas prácticas aplicadas

- Uso de POO
- Separación de responsabilidades
- Uso de PDO con prepared statements
- Encapsulamiento de datos
- Reutilización mediante herencia
- Manejo de errores con excepciones

---

# Excepciones

## 10. Manejo de excepciones personalizadas

El sistema implementa clases de excepciones personalizadas para controlar errores específicos del dominio.

### A. `UsuarioException`

Clase que extiende de `Exception` y se utiliza para manejar errores relacionados con la gestión de usuarios.

**Características:**

- Permite lanzar errores personalizados en validaciones de usuario.
- Se utiliza en métodos como:
  - `setNombre()`
  - `setEmail()`
  - `setPassword()`
- Incluye un mensaje por defecto en caso de no especificarse uno.

---

### B. `VehiculoException`

Clase que extiende de `Exception` y se utiliza para manejar errores relacionados con los vehículos.

**Características:**

- Permite validar datos del vehículo antes de procesarlos.
- Se utiliza en setters como:
  - `setAnio()`
  - `setPrecio()`
  - `setMarca()`
- Incluye un mensaje por defecto para errores generales.

---

# Interfaces

## 11. Uso de interfaces

El sistema implementa la interfaz `Gestionable` para definir un contrato común de operaciones básicas sobre entidades.

### Interfaz `Gestionable`

Define un conjunto de métodos que deben ser implementados por las clases que gestionan datos.

**Métodos:**

- `crear()` → Permite registrar un nuevo elemento.
- `actualizar($id)` → Permite modificar un elemento existente.
- `eliminar($id)` → Permite eliminar un elemento del sistema.

### Aplicación en el sistema

La interfaz `Gestionable` es implementada por:

- `UsuarioServicio`
- `VehiculoServicio`

Estas clases se encargan de la lógica de negocio y acceso a datos, asegurando que ambas cumplan con las operaciones básicas definidas (crear, actualizar y eliminar).

# Vistas

Archivos PHP ubicados en la carpeta `views/`. Cada vista representa una pantalla del sistema.

---

## Control de acceso

| Rol          | Acceso permitido                                                         |
|--------------|--------------------------------------------------------------------------|
| `admin`      | Todas las vistas                                                         |
| `empleado`   | `dashboard.php`, `perfil.php`                                            |
| Sin sesión   | `login.php`, `vehiculos.php`, `inicio.php`, `detalle_vehiculo.php`,      |

---

## Vistas públicas

### `login.php`

Pantalla de inicio de sesión. Accesible sin sesión activa.

- Presenta el formulario de autenticación (email y contraseña).
- Redirige al `dashboard.php` si las credenciales son válidas.
- Muestra un mensaje de error si la autenticación falla.

---

### `inicio.php`

Página de bienvenida tras iniciar sesión.

- Muestra información general del sistema.

---

### `vehiculos.php`

Listado público o general de vehículos disponibles.

- Muestra los vehículos registrados en el sistema.

---

### `detalle_vehiculo.php`

Vista de detalle de un vehículo específico.

- Muestra toda la información de un vehículo seleccionado.

---

## Vistas generales (todos los roles autenticados)

### `dashboard.php`

Panel principal del sistema.

- Muestra el listado de vehículos cargados.
- Permite acceder a las acciones de crear, editar y eliminar vehículos.
- Accesible por `admin` y `empleado`.

---

### `editar_vehiculo.php`

Formulario para modificar los datos de un vehículo existente.

- Permite editar marca, modelo, año, precio, tipo, color, transmisión e imagen.
- Accesible por `admin` y `empleado`.

---

## Vistas de perfil (solo empleado)

### `perfil.php`

Perfil del usuario autenticado.

- Permite al empleado ver y editar sus propios datos.
- **Acceso restringido:** solo `empleado`.

---

## Vistas de gestión de usuarios (solo admin)

### `gestion_usuarios.php`

Panel de administración de usuarios del sistema.

- Lista todos los usuarios registrados.
- Permite crear, editar y eliminar usuarios.
- **Acceso restringido:** solo `admin`.

---

### `editar_usuario.php`

Formulario para modificar los datos de un usuario existente.

- Permite editar nombre, email y rol.
- No permite modificar la contraseña desde esta vista.
- **Acceso restringido:** solo `admin`.

# Componentes

Archivos reutilizables incluidos en las vistas mediante `require` o `include`.

---

## `header.php`

Encabezado general del sistema. Se incluye al inicio de cada vista.

**Responsabilidades:**

- Inicia la sesión con `session_start()`.
- Renderiza el `<head>` del HTML con los estilos globales (`header.css`, `footer.css`).
- Muestra la barra de navegación con enlaces condicionales según el estado de sesión y el rol del usuario.

**Navegación condicional:**

| Condición                        | Enlaces visibles                                      |
|----------------------------------|-------------------------------------------------------|
| Sin sesión activa                | Inicio, Vehículos, Iniciar sesión                     |
| Sesión activa — rol `admin`      | Inicio, Vehículos, Panel, Usuarios, Cerrar sesión     |
| Sesión activa — rol `empleado`   | Inicio, Vehículos, Panel, Ver Perfil, Cerrar sesión   |

**Menú móvil:**

Incluye un botón de hamburguesa (`.nav-toggle`) que abre y cierra la navegación en pantallas pequeñas mediante JavaScript. Al abrirse, bloquea el scroll del body. Se cierra al hacer clic en el overlay, en cualquier enlace del menú, o en el botón nuevamente.

---

## `footer.php`

Pie de página general del sistema. Se incluye al final de cada vista.

---

## `session.php`

Componente de protección de rutas. Se incluye al inicio de las vistas que requieren autenticación.

**Responsabilidad:**

- Verifica que exista una sesión activa comprobando `$_SESSION['usuario_id']`.
- Si no hay sesión, redirige al usuario a `login.php` y detiene la ejecución.

> Debe incluirse después de `header.php` (que ya ejecuta `session_start()`) o asegurarse de que la sesión esté iniciada antes de llamarlo.

# Carpeta `assets/css`

Contiene los archivos de estilos del sistema. Cada archivo está enfocado en una sección específica para mantener una mejor organización y modularidad del diseño.

## Archivos incluidos

| Archivo                  | Descripción                                          |
|--------------------------|------------------------------------------------------|
| `dashboard.css`          | Estilos del panel de administración.                 |
| `detalle_vehiculo.css`   | Estilos de la vista de detalle de cada vehículo.     |
| `editar_usuario.css`     | Estilos del formulario de edición de usuarios.       |
| `editar_vehiculo.css`    | Estilos del formulario de edición de vehículos.      |
| `footer.css`             | Estilos del pie de página.                           |
| `gestion_usuarios.css`   | Estilos de la gestión de usuarios.                   |
| `header.css`             | Estilos del encabezado y navegación.                 |
| `inicio.css`             | Estilos de la página principal.                      |
| `login.css`              | Estilos del formulario de inicio de sesión.          |
| `perfil.css`             | Estilos de la vista de perfil de usuario.            |
| `styles.css`             | Estilos generales reutilizables en todo el sistema.  |
| `vehiculos.css`          | Estilos del listado de vehículos.                    |


# Carpeta `imagenes`

Contiene las fotos en formato .webp de los vehiculos cargados en el sistema.
