# Sistema de Gestión de Clubes Escolares
### TEC San Pedro | Equipo Los Tilines

Sistema web para la gestión de clubes escolares del Tecnológico de San Pedro. Permite a los alumnos registrarse e inscribirse a un club, y al administrador gestionar alumnos y clubes desde un panel de control.

---

## Tecnologías utilizadas

El proyecto fue desarrollado con PHP para la lógica del servidor, MySQL como base de datos, HTML5 y CSS3 para la interfaz de usuario, y XAMPP como entorno local de desarrollo.

---

## Requisitos previos

Antes de instalar el proyecto necesitas tener instalado XAMPP versión 7.4 o superior, Git para clonar el repositorio, y un navegador web moderno como Chrome, Firefox o Edge.

---

## Instalación

**1. Iniciar XAMPP**

Abre el Panel de Control de XAMPP y activa los módulos de Apache y MySQL.

**2. Clonar el repositorio**

Abre una terminal y navega a la carpeta `htdocs` de tu instalación de XAMPP. En Windows la ruta es `C:\xampp\htdocs` y en Mac/Linux es `/Applications/XAMPP/htdocs`. Una vez ahí, ejecuta:

```bash
git clone https://github.com/tu-usuario/school-proyect-.git GestorClubes
```

Esto creará la carpeta `GestorClubes` dentro de `htdocs`.

**3. Crear la base de datos**

Abre tu navegador y entra a `http://localhost/phpmyadmin`. Crea una nueva base de datos llamada `sistema_clubes` con cotejamiento `utf8_general_ci`. Con la base de datos seleccionada, ve a la pestaña Importar, selecciona el archivo `bd/sistema_clubes.sql` que está dentro del proyecto y haz clic en Importar.

**4. Configurar la conexión**

Abre el archivo `config/conexion.php` y verifica que los datos coincidan con tu instalación. Por defecto XAMPP usa usuario `root` sin contraseña, por lo que no deberías necesitar modificar nada a menos que hayas configurado una contraseña distinta en MySQL.

**5. Configurar el archivo .env**

En la raíz del proyecto edita el archivo `.env` con los siguientes valores:

```
DB_HOST=localhost
DB_NAME=sistema_clubes
DB_USER=root
DB_PASS=

APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost/GestorClubes/school-proyect-/public
```

**6. Ejecutar el proyecto**

Abre tu navegador y entra a la siguiente URL:

```
http://localhost/GestorClubes/school-proyect-/public/index.php
```

---

## Credenciales de administrador

```
Usuario:    admin
Contraseña: TECSP
```

---

## Solución de problemas comunes

Si ves una página en blanco o error 404, verifica que Apache esté activo en XAMPP y que la URL sea correcta. Si hay un error de conexión a la base de datos, revisa el archivo `config/conexion.php` y que MySQL esté activo. Si la imagen del logo no aparece, verifica que `logo_tec.png` esté en `public/assets/img/`. Si aparece el error "Table doesn't exist", importa nuevamente el archivo SQL en phpMyAdmin. Si el puerto 80 está ocupado, cambia el puerto de Apache desde XAMPP Config en el archivo `httpd.conf`.

---

## Equipo

**Equipo Los Tilines** — TEC San Pedro
Proyecto desarrollado como parte del curso de Ingeniería de Software.
