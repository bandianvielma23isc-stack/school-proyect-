# Club Manager Escolar (CME)

### TEC San Pedro | Equipo Los Tilines

Sistema web para la gestión de clubes escolares del Tecnológico de San Pedro. Permite que los alumnos se registren, inicien sesión, se inscriban a un club y administren su perfil. También incluye paneles para consultar alumnos, clubes, reportes, estadísticas y maestros.

---

## Tecnologías utilizadas

- PHP
- MySQL
- HTML5
- CSS3
- XAMPP
- Git

---

## Requisitos previos

Antes de instalar el proyecto necesitas:

- XAMPP instalado.
- Apache activo desde el panel de XAMPP.
- MySQL activo. Puede ser el MySQL de XAMPP o una instalación externa como MySQL Workbench/MySQL Server.
- Git instalado para clonar el repositorio.
- Un navegador web moderno, como Chrome, Edge o Firefox.
- Visual Studio Code, recomendado para abrir y revisar el proyecto.

---

## Instalación

### 1. Crear una carpeta dentro de `htdocs`

Entra a la carpeta de XAMPP:

```text
C:\xampp\htdocs
```

Crea una carpeta llamada obligatoriamente `CME` para guardar el proyecto:

```text
C:\xampp\htdocs\CME
```

Después abre esa carpeta en Visual Studio Code.

### 2. Clonar el repositorio

Abre una terminal dentro de la carpeta que creaste y ejecuta:

```bash
git clone https://github.com/bandianvielma23isc-stack/school-proyect-.git
```

Al terminar, la estructura debería quedar parecida a esta:

```text
C:\xampp\htdocs\CME\school-proyect-
```

Importante: la carpeta dentro de `htdocs` debe llamarse exactamente `CME`.
El proyecto usa rutas locales pensadas para esta estructura, por lo que si la carpeta tiene otro nombre algunas redirecciones pueden fallar.

### 3. Crear la base de datos

Crear la base de datos desde MySQL Workbench.

Nombre de la base de datos:

```text
sistema_clubes
```

El archivo SQL que crea las tablas está en:

```text
config/queryDB.sql
```

En MySQL Workbench:

1. Abre una conexión a tu servidor MySQL.
2. Abre el archivo `config/queryDB.sql`.
3. Ejecuta todo el script.


El script ya incluye `CREATE DATABASE IF NOT EXISTS sistema_clubes`, así que puede crear la base de datos automáticamente si no existe.

### 4. Configurar la conexión a MySQL


En la mayoría de los casos se usa el puerto `3306`, que es el puerto común de MySQL.

Si usas MySQL desde XAMPP y está configurado en el puerto `3307`, cambia:

También ajusta `DB_PASS` si tu usuario `root` tiene contraseña. En muchas instalaciones de XAMPP el usuario es `root` y la contraseña va vacía.

### 5. Revisar el puerto de MySQL en XAMPP

Si MySQL de XAMPP no inicia porque el puerto está ocupado, normalmente es porque ya tienes otro MySQL usando el puerto `3306`.

Opciones:

- Usar el MySQL externo que ya está en `3306` y dejar `DB_PORT=3306`.
- Cambiar MySQL de XAMPP a `3307`.

Para cambiar el puerto de MySQL en XAMPP:

1. Abre el panel de XAMPP.
2. En MySQL, entra a `Config`.
3. Abre `my.ini`.
4. Busca las líneas donde aparezca `port=3306`.
5. Cámbialas a `port=3307`.
6. Guarda el archivo.
7. Reinicia MySQL desde XAMPP.
8. En el proyecto, cambia a `DB_PORT=3307`.

### 6. Ejecutar el sistema

Con Apache activo, abre esta URL:

```text
http://localhost/CME/school-proyect-/public/
```

No cambies el nombre de la carpeta `CME`. La estructura esperada es:

```text
C:\xampp\htdocs\CME\school-proyect-
```


## Notas importantes de seguridad

La carpeta correcta para entrar al sistema es `public/`.


En este proyecto, `nombre_carpeta` debe ser `CME`.


Si Apache sigue mostrando páginas tipo `Index of`, revisa que en la configuración de Apache esté permitido el uso de archivos `.htaccess` mediante `AllowOverride All`.

---

## Errores comunes

### Aparece `Index of`

Significa que Apache está mostrando el listado de archivos de una carpeta.

Soluciones:

- Entra directamente a `public/`.
- Verifica que existan los archivos `.htaccess`.
- Revisa que Apache tenga habilitado `AllowOverride All`.
- Reinicia Apache desde XAMPP después de cambiar configuración.

### Error de conexión a la base de datos

Revisa:

- Que MySQL esté iniciado.
- Que la base de datos `sistema_clubes` exista.
- Que el archivo `config/queryDB.sql` se haya ejecutado completo.
- Que `DB_HOST`, `DB_PORT`, `DB_USER` y `DB_PASS` coincidan con tu instalación.

### `Access denied for user 'root'@'localhost'`

El usuario o la contraseña de MySQL no coinciden.

Solución:

- Si tu MySQL no tiene contraseña, deja `DB_PASS=` vacío.
- Si tu MySQL sí tiene contraseña, escríbela en `DB_PASS`.

### `Unknown database 'sistema_clubes'`

La base de datos no existe o no se importó.

Solución:

- Ejecuta nuevamente el archivo `config/queryDB.sql`.
- Confirma en MySQL Workbench o phpMyAdmin que existe la base `sistema_clubes`.

### `Table doesn't exist`

La base de datos existe, pero faltan tablas.

Solución:

- Ejecuta completo el archivo `config/queryDB.sql`.

### Apache no inicia

Puede que el puerto `80` esté ocupado.

Soluciones:

- Cierra programas que usen el puerto `80`.
- Cambia el puerto de Apache desde `Config > httpd.conf`.
- Si cambias Apache a otro puerto, por ejemplo `8080`, entra con:

```text
http://localhost:8080/CME/school-proyect-/public/
```

### MySQL no inicia

Puede que otro MySQL ya esté usando el puerto `3306`.

Soluciones:

- Usa el MySQL que ya está activo en `3306`.
- O cambia MySQL de XAMPP a `3307` y actualiza `DB_PORT=3307` en `.env`.

---

## Equipo

**Equipo Los Tilines** - TEC San Pedro

