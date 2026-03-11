# 🎹 Manual de Stakeholders V1.0.5 — JACQUIN Academia Musical

> **Estado del Documento:** FINAL • BRANDBOOK COMPLIANT • MARZO 2026
> **Build ID:** 06032026-STAKEHOLDER-DOC

---

## 🏛️ Visión Maestro del Ecosistema
La plataforma digital de **JACQUIN Academia Musical** ha sido concebida bajo el estándar **MODUS AXON High-Performance SPA**, uniendo la sofisticación de una academia de artes con la robustez de un sistema de gestión empresarial (ERP) académico.

Su arquitectura se basa en un paradigma de **capas visuales (Glassmorphism)** y **componentes atómicos**, permitiendo una navegación fluida, transiciones instantáneas y una identidad de marca inquebrantable.

---

## 👤 Niveles de Usuario & Ecosistema de Roles

### 0. Visitante (Público General / Prospectos)
Es el primer contacto con el universo Jacquin. Su objetivo es la **conversión y el descubrimiento**.
- **Hero Carousel Experience:** Galería de alto impacto con mensajes institucionales y acceso directo a matrículas.
- **Catálogo de Programas:** Hub interactivo que despliega el `ProgramModal` con beneficios del curso, intensidad horaria y descripción pedagógica.
- **Widget de Comunicación:** Acceso inmediato a `WhatsAppButton` y `ContactModal` (Chat interno integrado) para resolución de dudas.

### 1. Estudiante (Perfil Académico Activo)
Centro de la formación artística. Su panel de control (`Dashboard Estudiante`) prioriza la claridad de su agenda.
- **Mis Cursos:** Tarjetas con indicador visual de "Docente Asignado" y estado de la matrícula.
- **Horarios en Chips:** Visualización segmentada de bloques horarios (Día + Hora) para evitar cruces.
- **Inscripción Simplificada:** Flujo optimizado para aplicar a nuevos programas desde su sesión activa.
- **Perfil Seguro:** Gestión de datos personales bajo cumplimiento de la **Ley 1581 (Colombia)**.

### 2. Docente (Perfil Académico Docente)
Facilitador del arte y responsable del seguimiento pedagógico.
- **Mi Calendario:** Vista unificada de carga horaria semanal asignada por la administración.
- **Asistencia Digital:** Módulo para la toma de asistencia en tiempo real con persistencia en base de datos.
- **Reporte Académico:** Registro de calificaciones y comentarios sobre el desempeño artístico.

### 3. Administrador (Control Total)
Nodo central de mando. Opera sobre el núcleo de la plataforma mediante 6 módulos especializados.
- **Gestión Universitaria:**
  - Control total de perfiles y roles.
  - Inscripción Manual: Asistente para inscribir estudiantes seleccionando múltiples horarios.
  - Notificaciones automáticas de inscripción vía email (Consolidado).
- **Gestión de Contenido (CMS):**
  - Edición del `Hero Carousel`.
  - Configuración de `Misión`, `Valores` y `Sobre Nosotros`.
  - **Switch Dimensional:** Habilitación/Deshabilitación global de inscripciones (Matrículas Abiertas/Cerradas).
- **Hub de Programas:**
  - CRUD Premium: Título, Ícono, Imágenes y características de la oferta académica.
- **Estructura Administrativa:**
  - Asignación manual de docentes a programas y cargos específicos.
- **Almacenamiento & Logs:**
  - Gestión física de archivos y auditoría de cambios y errores.

---

## 🎨 Identidad de Marca (Brandbook Compliance)
Se han aplicado estrictamente las directrices del **Manual de Identidad Jacquin**:

| Elemento | Especificación |
| :--- | :--- |
| **Principal Azul** | `#223F61` — Elegancia y profundidad. |
| **Acento Naranja** | `#E78C3B` — Energía y pasión artística. |
| **Tipografía Titular** | `HelveticaNeue Condensed Bold` — Impacto visual. |
| **Tipografía Cuerpo** | `HelveticaNeue Light` — Legibilidad técnica. |
| **Tipografía Narrativa**| `Marion Regular` — Calidez institucional. |
| **Iconografía** | `Bootstrap Icons` & `Piano SVG Jacquin`. |

---

## ⚙️ Mecánicas de Interfaz & Seguridad
1. **Seguridad React:** Implementación de `PrivateRoute` que valida el `role_id: 1` antes de cargar módulos administrativos.
2. **SPA Logic:** Navegación fluida sin recargas de página utilizando `react-router-dom` y `HashScroller`.
3. **UX Sin Fricciones:** Hook `useOutsideClick` en todos los modales para un cierre natural y predecible.
4. **Resistencia de Datos:** Sistema de bloqueo de archivos (`LOCK_EX`) en escrituras críticas de configuración JSON.

---
**© 2026 JACQUIN Academia Musical — Impulsado por MODUS AXON Technologies.**
