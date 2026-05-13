# Mejoras de Interfaz.

## Club Manager Escolar | TEC San Pedro

---

## 1. Pantalla de Inicio / Selección de Rol

### Problema revisado
En el Sprint 2 no existía una pantalla de inicio que permitiera al usuario elegir su perfil de acceso. El sistema partía directamente desde un login genérico sin diferenciar si el usuario era alumno o administrador, lo que generaba confusión en la experiencia de entrada.

### Coherencia con Sprint 2
El Sprint 2 presentaba únicamente una pantalla de login con campos de "Correo Inst." y "Matrícula" sobre un fondo rojo intenso, sin ninguna distinción de roles ni identificación institucional.

### Mejora aplicada
Se diseñó una **pantalla de bienvenida institucional** con el logo de TEC SAN PEDRO y el título "Gestión de Clubs Escolares". Se incorporaron **dos tarjetas de selección de rol**: "Soy Alumno" (con icono de birrete) y "Soy Admin" (con icono de profesor), cada una con descripción de su función ("Acceder al portal" / "Gestionar registros"). Las tarjetas tienen fondo blanco, borde inferior rojo institucional y sombra sutil, sobre un fondo gris claro limpio.

### Evidencia
La nueva pantalla de inicio establece una jerarquía visual clara desde el primer contacto: branding institucional arriba, selección de rol en el centro. Cada tarjeta es clickeable y redirige al flujo correspondiente (alumno o admin). Esto elimina la ambigüedad del acceso y alinea la experiencia con la estructura de permisos del sistema.

---

## 2. Login de Alumno

### Problema revisado
El login del Sprint 2 era estéticamente poco refinado: fondo rojo saturado con una tarjeta gris opaca, campos sin etiquetas claras ("Correo Inst." y "Matrícula" como placeholders sin contexto), icono de usuario genérico y botón "LOGIN" con bajo contraste. No transmitía identidad institucional ni claridad en el flujo.

### Coherencia con Sprint 2
El Sprint 2 mantenía los mismos campos de entrada (identificador institucional y matrícula) pero sin jerarquía tipográfica, sin branding y con una paleta de colores agresiva (rojo intenso + gris opaco) que dificultaba la legibilidad.

### Mejora aplicada
Se rediseñó el login como un **formulario centrado en tarjeta blanca con borde inferior rojo**, sobre fondo gris neutro. Se añadió el **logo de TEC SAN PEDRO** en la parte superior, el título "Bienvenido" y un subtítulo descriptivo "Ingresa tus datos para acceder a tu club". Los campos de entrada ahora son campos redondeados con relleno visual (uno con fondo azul claro para el nombre, otro con borde rojo para la matrícula), y el botón de acción es "ENTRAR" en rojo institucional sólido. Se agregó la opción "← Volver a opciones" para retroceder al selector de rol.

### Evidencia
El nuevo login mejora la identificación institucional, la legibilidad de los campos y la jerarquía visual. El uso de colores de estado (azul para nombre, rojo para matrícula) ayuda a diferenciar los tipos de entrada. La navegación de retorno al selector de rol cierra el flujo de manera coherente.

---

## 3. Login de Administrador (Panel Admin)

### Problema revisado
En el Sprint 2 no existía un login exclusivo para administradores; el acceso admin se realizaba presumiblemente por el mismo formulario genérico o por una ruta oculta, sin credenciales diferenciadas ni interfaz propia.

### Coherencia con Sprint 2
El Sprint 2 carecía por completo de una interfaz de autenticación para administradores. Las funciones de gestión (Gestionar clubs, Editar club, Ver alumnos, Reportes) aparecían en un sidebar expandido sin previa validación de credenciales de admin.

### Mejora aplicada
Se creó un **login exclusivo para administradores** titulado "Panel Admin", con el logo institucional, campos para usuario ("admin") y contraseña (enmascarada), botón "ENTRAR" rojo, y opción "← Volver". La tarjeta mantiene la misma estética redondeada con borde inferior rojo que el login de alumno, garantizando consistencia visual entre flujos.

### Evidencia
El Panel Admin establece una barrera de seguridad clara antes de exponer las funciones de gestión. La consistencia visual con el login de alumno (misma tarjeta, mismo botón, mismo logo) mantiene la unidad del sistema mientras diferencia funcionalmente ambos perfiles. El campo de contraseña enmascarado refuerza la seguridad del acceso administrativo.

---

## 4. Registro de Alumno (Formulario de Inscripción)

### Problema revisado
En el Sprint 2, el registro a club no tenía un formulario dedicado. La opción "Registro a club" en el sidebar del alumno no mostraba una interfaz de captura de datos; presumiblemente era un flujo incompleto o no visualizado en los bocetos.

### Coherencia con Sprint 2
El Sprint 2 mostraba una opción de menú "Registro a club" pero no presentaba la interfaz de captura. El sistema actual necesitaba un formulario completo para registrar nuevos alumnos en el sistema y asignarlos a un club.

### Mejora aplicada
Se diseñó un **formulario de registro completo titulado "Registro de Alumno"** con el logo institucional. Incluye campos estructurados: Nombre(s), Apellidos, Matrícula (con ejemplos de formato), Carrera (selector desplegable con "Sistemas Computacionales" como opción visible), y selección de club ("¿A qué club quieres pertenecer?" con "TIRO CON ARCO" como opción visible). El botón de acción es "ENVIAR REGISTRO" en rojo institucional ancho, y se mantiene la opción "← Volver a opciones".

### Evidencia
El formulario captura todos los datos necesarios para el perfil del alumno (identidad, matrícula, carrera, club asignado) en una sola pantalla con jerarquía clara. Los placeholders con ejemplos reales ("Ej: Juan Carlos", "Ej: 221000150") reducen errores de formato. El selector de carrera y club reemplaza la entrada libre por opciones controladas, mejorando la integridad de datos. Este formulario es compartido entre el flujo de alumno (autoinscripción) y admin (inserción de alumnos), optimizando el desarrollo.

---

## 5. Dashboard del Alumno (Vista de Club Asignado)

### Problema revisado
En el Sprint 2, la vista del alumno mostraba un catálogo general de clubs (Página principal con grid de fotos: Banda de Guerra, Fútbol, Danza, Rondalla) sin personalización ni información del usuario logueado. No había una vista dedicada al club específico al que el alumno pertenecía, ni se mostraban compañeros de equipo.

### Coherencia con Sprint 2
El Sprint 2 presentaba un grid de clubs con fotografías como página principal del alumno, con opciones de menú "Todos los clubs" y "Registro a club". No existía una vista post-login que confirmara la membresía del alumno ni mostrara datos de su grupo.

### Mejora aplicada
Se creó un **dashboard personalizado del alumno** con layout de dos columnas. Columna izquierda: tarjeta de perfil con avatar circular (inicial "A"), nombre completo ("Alondra Juarez Ortiz"), matrícula, carrera ("Industrial") y botón "Cerrar Sesión" en rojo. Columna derecha: tarjeta de encabezado roja con "Club: Danza" y "Maestro Encargado: Lic. Carmen Vega", seguida de una tabla "Mis Compañeros" con columnas Nombre y Carrera, listando compañeros del mismo club (Oliver Molina Savedra — Logística, Arturo Bandian Vielma Lopez — Industrial).

### Evidencia
El dashboard transforma la experiencia del alumno de un catálogo genérico a una vista personalizada de membresía. La confirmación visual del club asignado, el nombre del maestro encargado y la lista de compañeros fomentan el sentido de pertenencia y comunidad. La tarjeta de perfil en sidebar izquierdo mantiene la identidad del usuario visible en todo momento, reemplazando la navegación por sidebar oscuro del Sprint 2 por un perfil integrado.

---

## 6. Dashboard del Administrador (Gestión de Alumnos)

### Problema revisado
En el Sprint 2, la vista de administrador mostraba un grid de clubs con iconos de edición (Pantalla 3) y una tabla de alumnos básica (Pantalla 4) con columnas ID, Nombre, Apellido, Carrera, Sem., Club. La interfaz tenía fondo rosa, sidebar oscuro con opciones desordenadas, y botones de acción ("Editar reporte", "Descargar", "Agregar alumno) sin jerarquía clara.

### Coherencia con Sprint 2
El Sprint 2 mantenía la misma estructura de sidebar para admin con opciones: Página principal, Gestionar clubs, Editar club, Ver alumnos, Reportes, Cerrar Sesión. La tabla mostraba datos de alumnos pero con diseño plano, sin acciones individuales por fila ni branding institucional.

### Mejora aplicada
Se diseñó un **panel de administración con tema oscuro profesional** y branding de TEC SAN PEDRO. Sidebar izquierdo con logo, y opciones de navegación: Dashboard, Insertar Alumno, Vista de Clubs, Cerrar Sesión (botón rojo sólido en la parte inferior). Área principal con título "GESTIÓN DE CLUBES" y una **tabla de datos robusta** con encabezados rojos (MATRÍCULA, NOMBRE DEL ALUMNO, CARRERA, CLUB, ACCIONES). Cada fila incluye matrícula en rojo (destacada), nombre completo, carrera, club asignado, y **dos botones de acción por registro**: "EDITAR" (azul) y "ELIMINAR" (rojo). Los datos muestran diversidad de clubs: Danza, Tiro con Arco, Voleiball, Norteño, Rondalla.

### Evidencia
El dashboard admin evoluciona de una tabla estática a una interfaz de gestión activa. La separación de acciones por fila (editar/eliminar) permite la gestión individual sin necesidad de seleccionar registros previamente. El tema oscuro reduce la fatiga visual en sesiones prolongadas de gestión. La matrícula destacada en rojo facilita la identificación rápida de alumnos. La navegación simplificada (Dashboard, Insertar Alumno, Vista de Clubs) condensa las opciones dispersas del Sprint 2 en tres funciones core.

---

## 7. Vista de Clubs (Administrador)

### Problema revisado
En el Sprint 2, la vista de clubs para admin mostraba un grid de fotos con iconos de lápiz (Pantalla 3), similar a la vista del alumno pero con controles de edición. No proporcionaba información cuantitativa ni permitía ver los miembros de cada club de manera agrupada.

### Coherencia con Sprint 2
El Sprint 2 mantenía el mismo grid visual de 4 clubs (Banda de Guerra, Fútbol Varonil, Danza, Rondalla) con fotografías y un icono de edición por club. No había conteo de inscritos ni listado de miembros visible.

### Mejora aplicada
Se creó una **vista de clubs tipo tarjetas de dashboard** con tema oscuro. Cada club se presenta como una tarjeta con encabezado rojo que incluye el nombre del club y el número de inscritos (ej: "TIRO CON ARCO — 1 INSCRITOS", "NORTEÑO — 2 INSCRITOS", "DANZA — 3 INSCRITOS"). Debajo del encabezado, se indica "Taller deportivo/cultural" como categoría, y en clubs con inscritos se listan los alumnos con su matrícula en rojo y nombre completo. El layout es de dos columnas de tarjetas, scrollable.

### Evidencia
La vista de clubs transforma la gestión de un grid estático a un panel de monitoreo en tiempo real. El conteo visible de inscritos por club permite identificar popularidad y ocupación inmediatamente. La lista de miembros dentro de cada tarjeta elimina la necesidad de navegar a otra pantalla para ver quién pertenece a cada club. La categorización "Taller deportivo/cultural" añade metadatos útiles para filtrado futuro. Esta vista complementa la tabla de "Gestión de Alumnos" ofreciendo una perspectiva agrupada por club en lugar de la perspectiva individual por alumno.