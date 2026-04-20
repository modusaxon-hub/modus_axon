# 🛠️ Manual del Administrador — JACQUIN Academia Musical

Este manual detalla todas las funciones avanzadas que un administrador o superusuario puede realizar en el panel de gestión.

## 1. Gestión de Usuarios
- **Directorio de Usuarios**: Ubicado en el módulo "Usuarios". Permite ver a todos los registrados (Estudiantes, Docentes, Colaboradores y otros Administradores).
- **Control de Roles del Sistema**: Puedes ascender o degradar usuarios modificando su nivel de acceso (ej: cambiar un estudiante a colaborador).
- **Edición de Perfiles**: Actualización de nombres y teléfonos desde una vista unificada.
- **Eliminación Segura**: Capacidad para dar de baja cuentas, incluyendo validaciones complejas que limpian inscripciones, asignaciones y dependencias antes de eliminar el registro.

## 2. Gestión de Cargos Administrativos (Nuevo)
- **Estructura Organizacional**: Accede al módulo "Cargos" para administrar la jerarquía.
- **Creación de Posiciones**: Define posiciones administrativas (ej. "Coordinador de Cuerdas", "Director Coral").
- **Asignación a Docentes/Colaboradores**: Vincula un cargo a un usuario activo. El sistema automatiza notificaciones vía correo electrónico avisando sobre la asignación del rol.
- **Documentación de Cargos**: Permite cargar URLs o lineamientos (Terms) específicos y definir estipendios si corresponde.

## 3. Gestión Académica Avanzada (Cursos y Horarios)
- **Cursos**: Define el currículo central. Crea y sube imágenes de material visual para cada curso.
- **Aulas y Horarios**: Configura de manera sincronizada cada horario. Los administradores tienen control total sobre agendas (Creación, Ajustes y Borrado). 
- **Relaciones (Docente - Clase)**: Asigna inmediatamente qué maestro cubrirá el horario. Toda asignación repercute en vivo en la interfaz del profesor.
- **Control Inteligente de Cupos**: A diferencia de establecer límites fijos genéricos, ahora el sistema contabiliza a los "Inscritos" versus la cantidad tope configurada (`max_students`), permitiendo automatizar bloqueos de turnos llenos.

## 4. Control de Inscripciones
- **Solicitudes Pendientes**: Las peticiones de registro de los estudiantes llegan a "Inscripciones" con notificaciones y estados de aprobación.
- **Validación Bidireccional**: Al autorizar la inscripción, el sistema previene cruces de horarios para un estudiante.
- **Matrícula Ejecutiva**: Los administradores pueden inscribir estudiantes en el acto y asignar varios horarios desde la vista administrativa centralizada.

## 5. Auditoría y Trazabilidad (Nuevo)
- **Bitácora Cero-Pérdida (Audit Log)**: Cada acción crítica (Acceso al panel, Cambios de Roles, Eliminación de Usuarios, Asignación de Roles especiales) es capturada automática e indefectiblemente.
- **Resolución de Logs**: Si se acumula excesiva actividad de diagnóstico, cuentas con un botón de "**Limpiar Historial de Diagnósticos**", que preserva acciones directas de usuarios mientras descarta las pruebas temporales de servidor.

## 6. Gestión Web, Contenido y Disponibilidad
- **Programas Dinámicos JSON**: Configura la Landing (Página de Inicio) inyectando títulos y resúmenes sin tocar el código fuente.
- **Apertura y Cierre de Matrículas**: Manejo global ("Switch Dimensional"). 
  - Al abrir inscripciones, los periodos/años se exigen a los prospectos.
  - Al cerrarlas, el diseño de la portada se repliega elegantemente desactivando elementos foráneos.
- **Sincronización en Directo**: Lo que configuras en Panel Admin se ve al instante en los Pies de Página (Footer) y menús de visitantes.

## 7. Inventario
- Control sobre los activos físicos, instrumentos en reparación o listos para alumnos.

---
*Documentación actualizada por Antigravity AI — Abril 2026*
