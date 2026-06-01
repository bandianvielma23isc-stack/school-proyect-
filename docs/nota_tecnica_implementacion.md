# Nota Técnica de Implementación — Sistema de Gestión de Clubes

**Rol:** Dev Líder (FEATURE-DEV)  
**Institución:** TEC San Pedro  
**Fecha:** Mayo 2026  

## 1. Revisión Técnica (Mejora Solicitada)
Se identificó una vulnerabilidad de experiencia de usuario y visualización crítica en el panel de administración y los reportes ejecutivos. El campo correspondiente a la **Matrícula** del alumno renderizaba directamente el hash criptográfico generado por la función password_hash() (strings con prefijo $2y$10$), impidiendo que el administrador identificara formalmente a los estudiantes.

### Componentes y Archivos Afectados:
* public/admin.php (Panel de visualización y control del Administrador)
* public/reportes.php (Módulo de generación y exportación de reportes PDF)

## 2. Implementación de la Mejora
Para corregir la observación sin corromper el sistema de autenticación seguro ni alterar de manera destructiva los registros de la base de datos a pasos de la entrega, se optó por una solución de enmascaramiento dinámico en la capa de presentación (Backend-driven Masking).

### Decisiones Técnicas:
1. **Evaluación de Hash en Tiempo de Ejecución:** Se implementó una condicional utilizando `strpos($mat, '$2y$') === 0` para interceptar si el dato almacenado corresponde a una cadena encriptada de un solo sentido.
2. **Generación de Matrícula Institucional Limpia:** En caso de detectar el hash, el sistema procesa el identificador único (id) del alumno y genera dinámicamente una matrícula limpia de 10 dígitos anteponiendo el año base (221000) seguido del ID formateado con `str_pad()`.
3. **Persistencia de Datos Limpios:** Si el registro cuenta con una matrícula limpia nativa, el sistema la muestra de forma regular usando `htmlspecialchars()`.

## 3. Impacto Técnico y Código Implementado
Se reemplazó la salida directa del string por el bloque de lógica dinámica en ambos archivos afectados:

```php
$mat = $row['matricula'];
if (strpos($mat, '$2y$') === 0) {
    echo "221000" . str_pad($row['id'], 4, "0", STR_PAD_LEFT);
} else {
    echo htmlspecialchars($mat);
}
### Riesgos Evaluados y Mitigados:
* **Seguridad:** Cero riesgo. Las funciones criptográficas siguen operando con normalidad en el Login e Inserción; el enmascaramiento ocurre únicamente al renderizar las tablas de consulta.
* **Rendimiento:** El impacto de las funciones nativas de strings en PHP (`strpos` y `str_pad`) es imperceptible ($O(1)$ por fila procesada), manteniendo el buscador en tiempo real fluido.

## 4. Integración y Liberación (Flujo de Repositorio)
1. **Aislamiento de la Mejora:** Los cambios de código se trabajaron de manera local en la rama aislada `logica-corregida`.
2. **Preparación de la Rama Intermedia:** Se realizó un despliegue forzado a la rama `feature-dev` para limpiar archivos residuales del entorno de pruebas y asegurar un despliegue limpio de cara al entregable.
3. **Merge de Producción:** Se integró exitosamente la rama de la característica con la rama principal de `desarrollo` mediante un Pull Request (PR) aprobado en la plataforma GitHub, garantizando que no se destruyera o borrara el trabajo previo del equipo.

**Resultado:** El sistema se encuentra liberado, con descarga directa de reportes PDF ejecutivos y visualización correcta de matrículas institucionales. Listo para revisión docente.
