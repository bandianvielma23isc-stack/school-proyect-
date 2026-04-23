Reglas del sistema 
1.	Jerarquía del sistema:
Cualquier usuario con el rol de estudiante no puede acceder a las funciones que el administrador posee(modificar, añadir,eliminar).
2.	Integridad en la relación: 
no se permitirá registrar un alumno en un club que no exista.
3.	Formatos : 
en el apartado de nombre, matricula, etc. no se aceptaran caracteres invalidos a ese apartado(números en nombre, letras en matricula).
4.	Mensaje de confirmación/invalidación:
 cuando una acción se realice correctamente dará un mensaje, si existe un error se mostrara el mensaje de error.
5.	Inserción de información:
 el sistema debe permitir capturar los datos del alumno(nombre, grado,matricula,club) 
6.	No duplicidad:
el sistema no permitirá ingresar un alumno si este ya esta registrado en algún club.
 
7.	Confianza y seguridad:
El usuario debe registrarse o iniciar sesión al entrar al sistema con sus credenciales(admin:usuario y contraseña, alumno: nombre y matricula)


Criterios de aceptación 
Criterio 1 (Validación de Formatos): 
El sistema debe rechazar el formulario si el campo "Nombre" contiene números o si la "Matrícula" contiene letras (Regla 3).

Criterio 2 (Integridad): El campo "Club" debe ser un menú desplegable (select) que solo muestre clubes existentes en la base de datos MySQL (Regla 2).

Criterio 3 (No Duplicidad): Si se intenta registrar una matrícula que ya existe en cualquier club, el sistema debe bloquear la inserción y mostrar un mensaje: "Error: El alumno ya se encuentra inscrito en un club" (Regla 6 y 4).

Criterio 4 (Feedback): Tras una inserción exitosa, el sistema debe limpiar el formulario y mostrar un mensaje de confirmación verde: "Alumno registrado correctamente" (Regla 4 y 5).

Criterio 5(seguridad y jerarquia):Validar las credenciales en el inicio de sesion y redireccionar al dashboard correspondiente para cada usuario.

Pruebas del sistema(escenarios simulados)

Prueba de Roles (Regla 1): 
Iniciar sesión como "Estudiante" e intentar entrar manualmente a la URL para eliminar al alumno. El sistema debería redirigir al Index o mostrar "Acceso Denegado".

Prueba de Insercion: Intentar meter un nombre con símbolos extraños para ver si las validaciones de formato (Regla 3) funcionan antes de llegar a la base de datos.

Fuera de alcance 

No Pagos: El sistema no procesa pagos de cuotas ni deudas.

Multi-plataforma:La web debe funcionar en escritorio y en móvil(solo en el caso del alumno).

No Historial: Solo se mantiene el registro del club actual; no se guarda un historial de clubes pasados (a menos que decidan lo contrario en la base de datos).
