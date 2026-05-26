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

Durante la revisión externa del 20 de mayo de 2026, el docente externo emitió observaciones sobre el sistema. El Dev Líder confirmó que los siguientes puntos fueron implementados en este sprint:

- Validación de nombre: permite apóstrofo y manejo de mayúsculas
- Carrera seleccionable y no predeterminada en formularios
- Mejoras de caligrafía/tipografía general en la interfaz
- En progreso: encriptación de contraseña en base de datos

---

## 2. Casos de Prueba — Mejora Implementada

---

### CP-01 — Campo de nombre acepta apóstrofo

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el campo de nombre acepta correctamente caracteres con apóstrofo |
| **Precondición** | El sistema está en el formulario de registro de alumno |
| **Entrada** | Nombre con apóstrofo: `O'Brien`, `D'Angelo`, `Juan O'Farrill` |
| **Resultado esperado** | El sistema acepta el nombre sin error y lo guarda correctamente |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-02 — Campo de nombre acepta y maneja mayúsculas correctamente

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el sistema maneja nombres en mayúsculas sin error |
| **Precondición** | El sistema está en el formulario de registro de alumno |
| **Entrada** | Nombre en mayúsculas: `JUAN PÉREZ`, `MARÍA LÓPEZ` |
| **Resultado esperado** | El sistema acepta el nombre y lo muestra de forma consistente (sin truncarlo ni transformarlo incorrectamente) |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-03 — Caso de dato inválido: nombre con números o caracteres no permitidos

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el sistema rechaza nombres con caracteres inválidos |
| **Precondición** | El sistema está en el formulario de registro |
| **Entrada** | Nombre con números o símbolos: `Juan123`, `@@pedro`, `<script>` |
| **Resultado esperado** | El sistema muestra un mensaje de error indicando que el nombre no es válido y no permite continuar |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-04 — Carrera seleccionable y no predeterminada en registro

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el campo de carrera no tiene valor predeterminado y obliga al usuario a seleccionar |
| **Precondición** | El sistema está en el formulario de registro de alumno |
| **Entrada** | Abrir el formulario sin tocar el campo de carrera e intentar enviar |
| **Resultado esperado** | El campo de carrera aparece vacío o con placeholder (ej. "Selecciona tu carrera"). El sistema bloquea el envío si no se selecciona |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-05 — Todas las carreras disponibles aparecen en el selector

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que el dropdown de carrera muestra todas las opciones correctamente |
| **Precondición** | El sistema está en el formulario de registro |
| **Entrada** | Hacer clic en el campo de carrera |
| **Resultado esperado** | Se despliegan todas las carreras disponibles en el sistema y se puede seleccionar cualquiera |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-06 — Mejoras visuales y tipografía general aplicadas

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que las mejoras de caligrafía y tipografía son visibles y consistentes en toda la interfaz |
| **Precondición** | El sistema está ejecutándose |
| **Entrada** | Navegar por las pantallas principales: inicio, registro, login, lista de clubs, perfil de alumno |
| **Resultado esperado** | Las fuentes, tamaños y estilos de texto son consistentes en todas las pantallas. No hay texto desbordado, cortado ni ilegible |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |
| **Evidencia** | _(captura de pantalla o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

### CP-07 — Contraseña almacenada encriptada en la base de datos *(en progreso)*

| Campo | Detalle |
|---|---|
| **Objetivo** | Verificar que la contraseña del usuario no se almacena en texto plano en la BD |
| **Precondición** | Se registra un nuevo alumno con contraseña conocida. Se tiene acceso a la BD para verificar |
| **Entrada** | Registrar alumno con contraseña: `test1234` y revisar el valor guardado en la tabla de usuarios |
| **Resultado esperado** | La contraseña en la BD aparece como hash encriptado (ej. `$2y$10$...`) y no como `test1234` |
| **Resultado obtenido** | _(completar cuando el Dev finalice la implementación)_ |
| **Estatus** | ⏳ En progreso — pendiente de implementación |
| **Evidencia** | _(captura de la BD o descripción)_ |
| **Error detectado** | _(si aplica)_ |
| **Corrección aplicada** | _(si aplica)_ |

---

## 3. Pruebas de No Regresión

Verifican que los cambios del Sprint 5 **no rompieron funcionalidades que ya existían**.

---

### NR-01 — Registro completo de alumno con datos válidos

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el flujo de registro sigue funcionando correctamente tras todos los cambios |
| **Entrada** | Nombre con apóstrofo válido, correo único, contraseña, carrera seleccionada |
| **Resultado esperado** | El alumno queda registrado exitosamente y puede iniciar sesión |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |

---

### NR-02 — Login de alumno existente funciona correctamente

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el inicio de sesión sigue operativo tras los cambios |
| **Entrada** | Correo y contraseña de cuenta previamente registrada |
| **Resultado esperado** | El sistema autentica al alumno y redirige a su pantalla principal |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |

---

### NR-03 — Visualización de clubs disponibles

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que la lista de clubs sigue visible y funcional |
| **Entrada** | Alumno autenticado navega a la sección de clubs |
| **Resultado esperado** | Se muestran los clubs con su información correctamente |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |

---

### NR-04 — Inscripción a un club sigue funcionando

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el flujo de inscripción no fue afectado |
| **Entrada** | Alumno autenticado selecciona un club y se inscribe |
| **Resultado esperado** | La inscripción se registra y se refleja en el perfil del alumno |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |

---

### NR-05 — Login de administrador funciona correctamente

| Campo | Detalle |
|---|---|
| **Objetivo** | Confirmar que el acceso de administrador no fue afectado por los cambios |
| **Entrada** | Credenciales de administrador válidas |
| **Resultado esperado** | El sistema autentica al administrador y redirige a su panel de control |
| **Resultado obtenido** | _(completar al ejecutar)_ |
| **Estatus** | ⬜ Pendiente / ✅ Aprobado / ❌ Fallido |

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

- Se ejecutaron ___ casos de prueba sobre las mejoras del Sprint 5 (validación de nombre, carrera seleccionable, tipografía).
- El caso CP-07 (encriptación de contraseña) queda **condicionado** hasta que el Dev Líder finalice su implementación.
- Las pruebas de no regresión confirman que el flujo principal _(funciona correctamente / presenta observaciones)_.
- _(Agregar observaciones finales del QA)_

**Firmado por:** Oliver Molina Saavedra — Rol: QA / Tester — Fecha: _(fecha de cierre)_

---

*Documento generado como entregable obligatorio del Sprint 5 — Ingeniería de Software SCD-1011*
