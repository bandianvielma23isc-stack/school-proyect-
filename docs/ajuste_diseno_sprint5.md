### Ajuste Diseño

# Reporte de Ajuste de Diseño - Sprint 5

**Rol:** Diseñador  
**Etiqueta:** FEATURE-DISENO  
**Responsabilidad:** Ajuste de interfaz

---

## Relación con la Mejora Externa
Ajustes y correcciones solicitados durante la "Revisión del 20 de Mayo", orientados a mejorar la usabilidad, validación de datos y la presentación de la información en el sistema.

Era necesario corregir problemas de experiencia de usuario (selecciones automáticas no deseadas), falta de retroalimentación visual (errores) y adaptar la interfaz para integrar nuevos componentes solicitados (filtros, barra de búsqueda y carga de fotografías).

## Pantalla Afectada
* pantalla del alumno
* tablas de registros 

alumnos -> registro 

## Problema Detectado
1. El campo "Carrera" tenía una opción predeterminada, lo que causaba registros erróneos si el usuario olvidaba cambiarla.

2. No existía un indicador visual claro cuando se presentaba un error en la interfaz.

3. Faltan componentes clave en la pantalla del alumno (como el espacio para adjuntar fotografía).

4. La tabla de registros era difícil de navegar sin una barra de búsqueda reactiva y un filtro específico.

5. La "caligrafía general" (tipografía) presentaba inconsistencias visuales.


## Ajuste Propuesto e Implementado


* Se ajustó el componente de selección de "Carrera" para que inicie vacío (placeholder), obligando al usuario a elegir una opción activamente.

* Se diseñaron e implementaron indicadores visuales (alertas) para proporcionar retroalimentación inmediata al presentarse un error.

* Se rediseñó y "complementó la pantalla del alumno" agregando un área de drag & drop (o botón) que permite adjuntar fotografía.

* Se integró en la parte superior de las tablas una barra de búsqueda dinámica que filtra la información en tiempo real, junto con un dropdown para filtrar por carrera.

* Se unificó la tipografía (caligrafía general) y se estandarizó el uso de mayúsculas/apóstrofes en los campos de nombre para mantener coherencia visual.

### Antes del Ajuste
*ruta de la imagen de referencia*
*Descripción:*

### Después del Ajuste (Implementado)
*ruta de la imagen de referencia*
*Descripción:* 

---

## Impacto y Apoyo al Usuario Final
Los cambios reducen la fricción y los errores de captura (al obligar a seleccionar carrera y mostrar indicadores claros de error). Además, la navegación en las tablas de datos ahora es mucho más rápida e intuitiva gracias a los nuevos filtros visuales y la barra de búsqueda.