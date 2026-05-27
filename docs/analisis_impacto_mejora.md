ANÁLISIS DE IMPACTO DE LA MEJORA — SPRINT 5
Proyecto: Club Manager Escolar (CME)
Materia: Ingeniería de Software
Estudiante / Rol: Alejandro Hinojoza (Analista) 
Fecha: 23 de mayo de 2026 

1.	¿Qué parte del sistema se modificará? Vamos a modificar la pantalla donde se ve la lista de los alumnos inscritos en los clubes y los archivos de PHP que controlan el inicio y regreso de las pantallas del usuario. 
2.	¿Qué requisito se fortalece o ajusta? Se mejora el Requisito Funcional de Consulta de alumnos (porque ahora será más rápido buscar) y el Requisito No Funcional de Usabilidad, porque el sistema va a ser más cómodo de usar y ya no se va a trabar al navegar. 
3.	¿Qué pantalla se verá afectada? Principalmente la pantalla de la tabla general de alumnos (ahí pondremos los nuevos botones y barras) y la pantalla del menú del usuario común. 
4.	¿Qué lógica o proceso se ajustará? Se cambiará la forma en que PHP recibe las búsquedas para pasárselas a la base de datos. También corregiremos el código de las sesiones para que el sistema no saque al usuario cuando este le dé al botón "Regresar" del navegador. 
5.	¿La base de datos requiere cambio? No, para nada. No vamos a crear tablas nuevas ni a cambiar columnas en MySQL. Las tablas de los clubes y alumnos se quedan igual; solo cambia la forma en que hacemos los SELECT con WHERE y LIKE para filtrar los nombres. 
6.	¿Se necesita agregar, modificar o consultar información? Solo vamos a consultar la información que ya tenemos guardada, pero de forma más inteligente (por carrera o por nombre). 
7.	¿Qué riesgo técnico existe? Que si alguien busca un nombre con acento, mayúsculas o apóstrofes (como vimos en la revisión), la consulta de SQL se rompa si el programador no limpia bien el texto. 
o	Que al arreglar lo de las pantallas, dejemos una página abierta que permita entrar al sistema sin contraseña.
8.	¿Qué pruebas deberá realizar QA? Nuestro compañero de QA tiene que inventar nombres raros para el buscador, checar que el filtro de carreras sí traiga a los alumnos correctos y picarle muchas veces al botón de "Regresar" para comprobar que la sesión no se cierre sola. 
9.	¿Qué puede romperse si el cambio se implementa mal? Si la consulta de PHP se programa mal, la tabla de alumnos se va a quedar completamente en blanco, va a salir un error raro en la pantalla o de plano nadie va a poder iniciar sesión en el sistema. 
10.	¿Cómo se comprobará que la mejora sí quedó implementada? Cuando entremos al sistema y veamos la barra de búsqueda y el filtro funcionando. También cuando descarguemos el proyecto en otra computadora (con la prueba de clonación) y todo corra a la primera usando las instrucciones del README.


| Área afectada | Impacto identificado | Acción requerida |
| :--- | :--- | :--- |
| **Requisitos** | Cambia la forma en que el usuario busca y filtra información en el módulo de clubes[cite: 4]. | **Analista (Alejandro):** Actualizar esta lista de requerimientos en el backlog y cuidar los tiempos de entrega. |
| **Interfaz** | Acomodar la barra de búsqueda, el menú de carreras y el botón de imprimir en la UI sin amontonar los elementos. | **Diseñador:** Hacer los bocetos de las pantallas modificadas para que mantengan la usabilidad. |
| **Lógica** | Modificar los scripts de PHP para enlazar la búsqueda y arreglar los errores de las sesiones al regresar. | **Dev Líder:** Programar las condicionales de la consulta y reparar las redirecciones de pantalla. |
| **Base de datos** | Mayor uso de sentencias lógicas dinámicas al realizar las búsquedas de alumnos en MySQL. | **Dev Líder:** Estructurar bien los `SELECT` para que la base de datos no se sature al buscar. |
| **Pruebas** | Validar el comportamiento de los nuevos campos y cuidar que el sistema viejo no se rompa (no regresión). | **QA / Tester:** Crear los escenarios de prueba funcionales y llenar el reporte final de calidad. |
| **Documentación** | Los manuales e instrucciones anteriores ya no coinciden con las pantallas modificadas del sistema. | **Todo el equipo:** Actualizar el archivo `README` explicando cómo instalar y probar los nuevos filtros. |
