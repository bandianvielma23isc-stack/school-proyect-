# Test Report — Sprint 5
## Club Manager Escolar

| Campo | Detalle |
|---|---|
| **Proyecto** | Club Manager Escolar |
| **Rol** | QA / Tester |
| **Rama de trabajo** | feature-qa |
| **Fecha de ejecución** | 25–28 de mayo de 2026 |
| **Sprint** | Sprint 5 — Validación Externa, Iteración Final y Cierre |
| **Versión probada** | Rama `desarrollo` — commit más reciente |

---

## 1. Contexto de la Mejora

Durante la revisión externa del 20 de mayo de 2026, el docente externo emitió observaciones sobre el sistema. Con base en el Análisis de Impacto elaborado por el Analista (Alejandro Hinojoza), las mejoras implementadas en este Sprint 5 son:

- **Barra de búsqueda** con filtro por nombre y carrera en la tabla de alumnos inscritos en clubes
- **Corrección de sesiones** — el sistema no debe cerrar la sesión al presionar el botón "Regresar" del navegador
- **Validación de nombres** — el buscador debe manejar correctamente acentos, mayúsculas y apóstrofos

Las pantallas afectadas son:
- Tabla general de alumnos inscritos en clubes
- Menú del usuario común

---

## 2. Casos de Prueba — Mejora Implementada

---

### CP-01 — Barra de búsqueda filtra por nombre correctamente

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que la barra de búsqueda filtra alumnos por nombre en tiempo real |
| **Precondición** | Hay alumnos registrados e inscritos en clubes. La tabla de alumnos está visible |
| **Entrada** | Escribir el nombre de un alumno existente en la barra de búsqueda |
| **Resultado esperado** | La tabla muestra únicamente los alumnos cuyo nombre coincide con el texto ingresado |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-02 — Barra de búsqueda filtra nombres con acentos

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el buscador maneja correctamente nombres con acentos |
| **Precondición** | Existe un alumno con nombre acentuado registrado (ej. `María`, `Héctor`) |
| **Entrada** | Escribir nombre con acento: `María`, `Héctor`, `José` |
| **Resultado esperado** | La tabla filtra y muestra correctamente al alumno sin errores ni tabla en blanco |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-03 — Barra de búsqueda filtra nombres con mayúsculas

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el buscador maneja correctamente nombres en mayúsculas |
| **Precondición** | La barra de búsqueda está disponible en la tabla de alumnos |
| **Entrada** | Escribir nombre en mayúsculas: `JUAN`, `PEDRO LÓPEZ` |
| **Resultado esperado** | La tabla filtra y muestra correctamente los alumnos sin importar si se escribe en mayúsculas o minúsculas |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-04 — Barra de búsqueda filtra nombres con apóstrofo

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el buscador maneja correctamente nombres con apóstrofo |
| **Precondición** | La barra de búsqueda está disponible |
| **Entrada** | Escribir nombre con apóstrofo: `O'Brien`, `D'Angelo` |
| **Resultado esperado** | La tabla filtra correctamente sin generar error en la consulta SQL ni dejar la tabla en blanco |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-05 — Filtro por carrera muestra alumnos correctos

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el filtro por carrera muestra únicamente los alumnos de esa carrera |
| **Precondición** | Hay alumnos de diferentes carreras inscritos en clubes |
| **Entrada** | Seleccionar una carrera específica en el filtro |
| **Resultado esperado** | La tabla muestra solo los alumnos inscritos en esa carrera. No aparecen alumnos de otras carreras |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-06 — Caso de dato inválido: búsqueda con caracteres especiales

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el buscador no genera errores ni vulnerabilidades con caracteres especiales |
| **Precondición** | La barra de búsqueda está disponible |
| **Entrada** | Escribir caracteres especiales: `<script>`, `--`, `''`, `%` |
| **Resultado esperado** | El sistema no genera error, no ejecuta código malicioso y simplemente muestra tabla vacía o sin coincidencias |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-07 — Sesión no se cierra al presionar "Regresar" en el navegador

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que la sesión del usuario se mantiene activa al presionar el botón "Regresar" del navegador |
| **Precondición** | El alumno ha iniciado sesión correctamente |
| **Entrada** | Navegar a una pantalla y presionar el botón "Regresar" del navegador varias veces seguidas |
| **Resultado esperado** | El sistema mantiene la sesión activa y no redirige al login ni cierra la sesión del usuario |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

## 3. Pruebas de No Regresión

Verifican que los cambios del Sprint 5 **no rompieron funcionalidades que ya existían**.

---

### NR-01 — Registro completo de alumno con datos válidos

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el flujo de registro sigue funcionando correctamente tras los cambios |
| **Entrada** | Nombre válido, correo único, contraseña, carrera seleccionada |
| **Resultado esperado** | El alumno queda registrado exitosamente y puede iniciar sesión |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |

---

### NR-02 — Login de alumno existente funciona correctamente

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el inicio de sesión sigue operativo tras los cambios |
| **Entrada** | Correo y contraseña de cuenta previamente registrada |
| **Resultado esperado** | El sistema autentica al alumno y redirige a su pantalla principal |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |

---

### NR-03 — Visualización de clubs disponibles

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que la lista de clubs sigue visible y funcional |
| **Entrada** | Alumno autenticado navega a la sección de clubs |
| **Resultado esperado** | Se muestran los clubs con su información correctamente |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |

---

### NR-04 — Inscripción a un club sigue funcionando

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el flujo de inscripción no fue afectado |
| **Entrada** | Alumno autenticado selecciona un club y se inscribe |
| **Resultado esperado** | La inscripción se registra y se refleja en el perfil del alumno |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |

---

### NR-05 — Login de administrador funciona correctamente

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el acceso de administrador no fue afectado por los cambios |
| **Entrada** | Credenciales de administrador válidas |
| **Resultado esperado** | El sistema autentica al administrador y redirige a su panel de control |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente |

---

## 4. Resumen de Resultados

| Tipo | Total | Aprobados | Fallidos | Pendientes |
|---|---|---|---|---|
| Casos de mejora (CP) | 7 | _(llenar)_ | _(llenar)_ | _(llenar)_ |
| No regresión (NR) | 5 | _(llenar)_ | _(llenar)_ | _(llenar)_ |
| **Total** | **12** | | | |

---

## 5. Errores Detectados y Correcciones

| ID Error | Caso relacionado | Descripción | Severidad | Corrección aplicada | Estatus |
|---|---|---|---|---|---|
| _(llenar)_ | _(llenar)_ | _(llenar)_ | Alta / Media / Baja | _(llenar)_ | Resuelto / Pendiente |

> Si no se detectaron errores, indicar: *"No se detectaron errores durante la ejecución de pruebas."*

---

## 6. Conclusión de Aptitud para Liberación

> _(Completar al finalizar todas las pruebas)_

**Veredicto:** ⬜ APTA PARA LIBERACIÓN / ⬜ CONDICIONADA / ⬜ NO APTA

**Justificación:**

- Se ejecutaron ___ casos de prueba sobre las mejoras del Sprint 5 (barra de búsqueda, filtro por carrera, manejo de nombres especiales y corrección de sesiones).
- Las pruebas de no regresión confirman que el flujo principal _(funciona correctamente / presenta observaciones)_.
- _(Agregar observaciones finales del QA)_

**Firmado por:** Oliver Molina Saavedra — Rol: QA / Tester — Fecha: _(fecha de cierre)_

---

*Documento generado como entregable obligatorio del Sprint 5 — Ingeniería de Software SCD-1011*
