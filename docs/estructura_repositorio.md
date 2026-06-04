# Estructura del Proyecto
## Club Manager Escolar | TEC San Pedro

```
school-proyect-/
│
├── config/             # Configuración y conexión a la base de datos
│   ├── conexion.php
│   └── db.php
│
├── public/             # Vistas y recursos accesibles desde el navegador
│   ├── assets/
│   │   ├── css/        # Estilos separados por vista
│   │   │   ├── global.css
│   │   │   ├── index.css
│   │   │   ├── login.css
│   │   │   ├── admin.css
│   │   │   ├── vista_clubes.css
│   │   │   ├── registrar.css
│   │   │   ├── editar_alumno.css
│   │   │   └── perfil_alumno.css
│   │   └── img/        # Imágenes del proyecto
│   │       └── logo_tec.png
│   ├── admin.php
│   ├── editar_alumno.php
│   ├── index.php
│   ├── login.php
│   ├── login_alumno.php
│   ├── opciones_alumno.php
│   ├── perfil_alumno.php
│   ├── registrar.php
│   └── vista_clubes.php
│
├── src/                # Lógica del sistema, procesa datos del usuario
│   ├── actualizar_proceso.php
│   ├── eliminar_alumno.php
│   ├── guardar.php
│   ├── logout.php
│   ├── validar_acceso.php
│   └── validar_alumno.php
│
├── templates/          # Componentes PHP reutilizables entre páginas
│   └── sidebar.php
│
├── bd/                 # Archivos SQL de la base de datos
│   └── sistema_clubes.sql
│
├── docs/               # Documentación y evidencias del proyecto
│   ├── criterios_aceptacion.md
│   ├── mejoras_interfaz.md
│   ├── test_report.md
│   ├── validacion_requisitos.md
│   └── T3_Demo_Sprint3_Equipo_LosTilines.mp4
│
├── .env
├── .gitignore
└── README.md
