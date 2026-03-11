---
project: "{{ProjectName}}"
created: "{{YYYY-MM-DD}}"
phase-current: 1
enforcement: MANDATORY
read-order: 0
---

# INSTRUCCIONES DEL PROYECTO: {{ProjectName}}

> **INSTRUCCIÓN PARA EL AGENTE:** Este archivo es de lectura **OBLIGATORIA** al iniciar
> cualquier sesión en este proyecto. **No ejecutes ninguna acción antes de leerlo.**
>
> Después de leer este archivo, consulta `PHASE-TRACKER.md` para conocer en qué
> fase estamos y cuál es el próximo gate a superar.

---

## 1. Contexto del Proyecto

| Campo | Valor |
|:------|:------|
| **Nombre** | {{ProjectName}} |
| **Objetivo** | *(Descripción en 1 frase del objetivo del proyecto)* |
| **Stack tecnológico** | *(HTML/Vanilla \| React/Vite \| React/CRA \| Otro)* |
| **Base de datos** | *(MySQL local \| Supabase \| Ninguna)* |
| **Ruta local** | `d:/Documentos/Proyectos ADSO/{{ProjectName}}/` |
| **URL local** | `localhost/{{ProjectName}}` |
| **Fecha de inicio** | {{YYYY-MM-DD}} |
| **Estado actual** | En desarrollo |

---

## 2. Fase Activa

> Consultar `PHASE-TRACKER.md` en esta misma raíz para el estado detallado.
> **NO iniciar una fase sin que la anterior esté en estado `COMPLETADA`.**

| Fase | Nombre | Estado |
|:----:|:-------|:------:|
| F1 | ADN y Cimientos | `PENDIENTE` |
| F2 | Ideación | `PENDIENTE` |
| F3 | Hoja de Ruta | `PENDIENTE` |
| F4 | Construcción | `PENDIENTE` |
| F5 | Pulido QA | `PENDIENTE` |
| F6 | Despliegue | `PENDIENTE` |

**Fase activa al abrir este archivo:** F1 *(actualizar manualmente al avanzar)*

---

## 3. Identidad de Marca del Proyecto

> Estos archivos son generados por el skill `brandbook` en F1.
> **No generar ningún asset visual sin verificar su existencia.**

| Recurso | Ruta | Estado |
|:--------|:-----|:------:|
| Estilo visual | `recursos/estilo-visual.json` | ⏳ Pendiente |
| Guía de textos | `recursos/guia-de-textos.md` | ⏳ Pendiente |

**Color primario:** —
**Tipografía principal:** —
**Tono de voz:** —

---

## 4. Reglas Activas para Este Proyecto

Marcar las que aplican. El agente activa los skills correspondientes automáticamente.

| Regla | Aplica | Skill a invocar |
|:------|:------:|:----------------|
| Proyecto maneja datos de usuario (Ley 1581 / SIC 2026) | ☐ | `compliance-legal` en F1 y F5 |
| Comparte Header Maestro con `project_jacquin` | ☐ | `header-manager` en F4 |
| UI generada con Stitch MCP | ☐ | `design-md` → `enhance-prompt` → `stitch-loop` en F4 |
| Stack React + shadcn/ui | ☐ | `react-components` + `shadcn-ui` en F4 |
| Requiere video de walkthrough | ☐ | `remotion` en F4 |
| PWA requerida (offline-first) | ☐ | Incluido en `doc-to-app` — verificar en F4 |

---

## 5. Verificación de Archivos Obligatorios

> El agente verifica la existencia de estos archivos **al inicio de cada sesión**.
> Si alguno falta, lo crea usando el skill correspondiente **antes** de cualquier otra acción.

### Archivos de Gestión del Proyecto (raíz)
- [ ] `TASK.md` — tabla de acciones con ⏳/✅/❌
- [ ] `PHASE-TRACKER.md` — bitácora de gates por fase
- [ ] `AI_LOG_CUMPLIMIENTO.md` — registro legal de decisiones de IA
- [ ] `INSTRUCTIONS.md` — este archivo

### Archivos de Marca (carpeta `recursos/`)
- [ ] `recursos/estilo-visual.json` *(generado por `brandbook` en F1)*
- [ ] `recursos/guia-de-textos.md` *(generado por `brandbook` en F1)*

### Archivos de Documentación Técnica (carpeta `technical/`)
- [ ] `technical/BUILD_PROJECT.html` *(generado por `documentador-tecnico` en F3)*
- [ ] `technical/ERROR_LOG.html` *(generado por `documentador-tecnico` en F3)*
- [ ] `technical/DOC_TECNICO.html` *(generado por `documentador-tecnico` en F3)*
- [ ] `technical/MANUAL_USUARIO.html` *(generado por `documentador-tecnico` en F3)*

**Si algún archivo no existe:** Crearlo con el skill indicado antes de continuar con la tarea principal.

---

## 6. Workflow Global y Referencias

> Fuente de verdad del proceso: leer antes de cada sesión.

| Documento | Propósito | Ruta |
|:----------|:----------|:-----|
| **WORKFLOW.md** | Flujo de 6 fases con gates de control | `d:/Documentos/Proyectos ADSO/agent/WORKFLOW.md` |
| **SKILL-INDEX.md** | Catálogo de los 17 skills con cuándo y cómo usarlos | `d:/Documentos/Proyectos ADSO/agent/SKILL-INDEX.md` |
| **PHASE-TRACKER.md** | Estado actual de cada fase en este proyecto | `PHASE-TRACKER.md` (raíz del proyecto) |
| **AI_LOG_CUMPLIMIENTO.md** | Registro legal de decisiones de IA | `AI_LOG_CUMPLIMIENTO.md` (raíz del proyecto) |
| **TASK.md** | Log de acciones en tiempo real | `TASK.md` (raíz del proyecto) |

---

## 7. Decisiones Arquitectónicas del Proyecto

> Registrar aquí las decisiones importantes tomadas durante el desarrollo.
> Esto evita repetir discusiones ya resueltas en sesiones futuras.

| Fecha | Decisión | Razón | Resultado |
|:------|:---------|:------|:----------|
| {{YYYY-MM-DD}} | Proyecto inicializado con WORKFLOW.md v2.0 | Inicio del flujo maestro | Estructura base creada |

---

## 8. Instrucción de Arranque (Protocolo de Inicio de Sesión)

Al iniciar cualquier sesión en este proyecto, el agente ejecuta este protocolo **en orden**:

1. **Leer este archivo** (`INSTRUCTIONS.md`) — contexto y reglas del proyecto.
2. **Consultar `PHASE-TRACKER.md`** — identificar la fase activa y el próximo gate.
3. **Verificar la lista de archivos obligatorios** (sección 5) — crear los que falten.
4. **Consultar `TASK.md`** — identificar tareas pendientes (⏳) de la sesión anterior.
5. **Activar el skill correspondiente** a la fase activa según `WORKFLOW.md`.
6. **Al finalizar la sesión:** actualizar `TASK.md`, `PHASE-TRACKER.md` y `AI_LOG_CUMPLIMIENTO.md`.

> **Regla de oro:** Si tienes dudas sobre qué skill usar, consulta primero `SKILL-INDEX.md`.
