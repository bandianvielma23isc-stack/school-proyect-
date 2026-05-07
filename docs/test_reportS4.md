=========================================
Qa/Test Report S4
=====================================

### objetivo 
Este informe documenta las actividades de prueba realizados sobre el codigo del proyecto y su funcionalidad y fiabilidad realizando a su vez correcciones a los bugs encontrados en el sprint anterior(Sprint3)


### resumen de pruebas
    [x] diseñar y ejecutar casos de prueba presentados en el sprint3
    [x] identificar y corregir errores detallados en el sprint3
    [x] forzar errores de usuario

### casos de prueba ejecutados 


CP-001: Registro de Usuario Exitoso:
------------------------------------
    Tipo: Flujo Principal

    Pasos: Rellenar campos válidos y enviar formulario.

    Resultado Esperado: Cuenta creada exitosamente y redirección automática al perfil.

    Resultado Real: Cuenta creada y redirección a perfil completada.

    Estado: PASA 

    Evidencia: [https://github.com/bandianvielma23isc-stack/school-proyect-/blob/documentacion/imagenes_sprint2/Pantalla1.jpeg];


CP-002: Credenciales inválidas al iniciar sesión:
-------------------------------------------------

    Tipo: Forzado de Error

    Pasos: Intentar iniciar sesión ingresando datos incorrectos (usuario/matricula).

    Resultado Esperado: El sistema debe mostrar un mensaje de error de validación claro.

    Resultado Real: Mensaje de error de validación mostrado correctamente.

    Estado: PASA 

    Evidencia: [https://github.com/bandianvielma23isc-stack/school-proyect-/blob/documentacion/imagenes_sprint2/Pantalla1.jpeg];


CP-003: Campo obligatorio vacío en registro:
--------------------------------------------

    Tipo: Forzado de Error

    Pasos: Dejar el campo 'nombre' vacío y enviar el formulario.

    Resultado Esperado: El sistema debe detener el envío y mostrar un mensaje de advertencia.

    Resultado Real: No se muestra error y el formulario se envía con datos incompletos.

    Estado: FALLA 

    Referencia: BUG-01;


CP-004: Seguridad de acceso al Dashboard de Admin:
--------------------------------------------------

    Tipo: Prueba de Seguridad / Forzado

    Pasos: Intentar acceder directamente a la URL o login del dashboard de administrador siendo un rol de alumno.

    Resultado Esperado: El sistema debe bloquear el acceso o redirigir al login administrativo sin permitir el paso.

    Resultado Real: No se permite el paso al dashboard sin las credenciales correspondientes.

    Estado: PASA 

    Evidencia: en proceso de subir ;


CP-005: Botón 'Regresar' en Registro de Alumno:
-----------------------------------------------

    Tipo: Flujo Principal (Navegación)

    Pasos: Hacer clic en el botón 'Regresar' dentro del formulario de registro.

    Resultado Esperado: Debería volver a la pantalla inmediatamente anterior (historial).

    Resultado Real: Redirige erróneamente a la página principal del sitio.

    Estado: FALLA 

    Referencia: BUG-02 ;

### reporte de errores y validacion de correciones 
BUG-01 
descricion:
    el campo nombre permitia registrar campos vacios y con caracteres extraños

gravedad:
    media 

estado:
    SOLUCIONADO 
 
validacion de la solucion:
    se corrigio el archivo php colocando multiples condiciones al insertar los datos en el archivo



BUG-02
descripcion:
    el boton regresar de la pagina 'registrar alumno' regresa a la pagina inicial no a la anterior

gravedad: 
    baja 

estado: 
    SOLUCIONADO

validacion de la solucion:
    se modifico el archivo 'registro.php' y se coloco una condicion en caso de ser alumno/admin se regresara a la pagina anterior correspondiente


