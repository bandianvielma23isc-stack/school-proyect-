| Caso | Jerarquía del sistema |
|------|----------------------|
| Entrada: | Usuario y contraseña (matricula) del alumno correctos. |
| Esperado y obtenido: | **Esperado:** Rol alumno no puede acceder a los privilegios del administrador (CRUD).<br>**Obtenido:** El alumno solo tiene derecho a solo vista y no puede gestionar nada. |
| Estado: | Correcto. |

| Caso | Integridad en la Relación: |
|------|---------------------------|
| Entrada: | Usuario y contraseña y campo especifico (club) |
| Esperado y obtenido: | **Esperado:** Alumno no puede elegir un club que no exista.<br>**Obtenido:** El alumno elige un club de un listbox y solo limitan a los clubes existentes. |
| Estado: | Correcto |

| Caso | Formatos: |
|------|-----------|
| Entrada: | Usuario y contraseña del alumno |
| Esperado y obtenido: | **Esperado:** Para registrar un alumno en la parte de nombre y matricula no acepta caracteres inválidos.<br>**Obtenido:** Al intentar poner un carácter invalido salta una pequeña advertencia de que ingrese caracteres válidos, si no, no deja registrarlo. |
| Estado: | Correcto |

| Caso | Mensaje de confirmación/Invalidación. |
|------|--------------------------------------|
| Entrada: | Cualquier entrada que necesite validación. |
| Esperado y obtenido: | **Esperado:** Cuando una acción se realice aparece un mensaje de éxito y si no se realiza dará mensaje de error.<br>**Obtenido:** Muestra mensajes de acuerdo a lo que pase en el registro o acción. |
| Estado: | Correcto |

| Caso | Inserción de información |
|------|-------------------------|
| Entrada: | Datos completos del alumno. |
| Esperado y obtenido: | **Esperado:** El sistema debe capturar todos los datos correctamente.<br>**Obtenido:** El sistema obtiene los datos ingresados y los guarda en la Base de Datos. |
| Estado: | Correcto |

| Caso | No duplicidad |
|------|---------------|
| Entrada: | Datos completos del alumno. |
| Esperado y obtenido: | **Esperado:** El sistema no permitirá registrar un alumno si ya está en algún club.<br>**Obtenido:** El sistema restringe el registro si detecta que el alumno ya esta inscrito en un club. |
| Estado: | Correcto |

| Caso | Confianza y seguridad |
|------|----------------------|
| Entrada: | Usuario y contraseña de alumno o administrador |
| Esperado y obtenido: | **Esperado:** El sistema detecta las credenciales y acorde a ellas entra a su debido apartado.<br>**Obtenido:** El sistema ingresa a los apartados en base a las credenciales del login. |
| Estado: | Correcto |

| Caso | Prueba de roles. |
|------|-----------------|
| Entrada: | Usuario y contraseña de alumno. |
| Esperado y obtenido: | **Esperado:** Si el usuario alumno quiere acceder al apartado de admin mediante la URL, el sistema debe de bloquearlo.<br>**Obtenido:** El sistema al cambiar la url desde el apartado de alumno a la del admin, se redirige al login y no permite entrar al menos que inicie sesión como admin. |
| Estado: | Correcto |