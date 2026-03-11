---
project: "{{ProjectName}}"
created: "{{YYYY-MM-DD}}"
skill-owner: documentador-tecnico
enforcement: MANDATORY
---

# AI_LOG_CUMPLIMIENTO: {{ProjectName}}

> **MANDATO LEGAL:** Este archivo registra cada decisión significativa tomada por la IA
> en este proyecto. Garantiza cumplimiento con:
> - **Ley 1581 de 2012** (Colombia) — Protección de Datos Personales
> - **GDPR** (EU) — Reglamento General de Protección de Datos
> - **Resolución 1519 de 2020** (MinTIC) — Accesibilidad y Transparencia Web
> - **Normativa SIC 2026** — Seguridad y Consentimiento Digital
>
> **El agente DEBE actualizar este archivo en cada interacción significativa.**
> Mantenido por el skill `documentador-tecnico`.

---

## Registro de Decisiones de IA

> **Formato de Build ID:** `ddmmAAAAhhmmXXXX` — generado por `documentador-tecnico` en MODO D.

| Build ID | Fecha | Fase | Decisión Tomada | Justificación Técnica | Skill Usado |
|:---------|:------|:----:|:----------------|:----------------------|:------------|
| `{{ddmmAAAAhhmmXXXX}}` | {{YYYY-MM-DD}} | F1 | Proyecto inicializado | Inicio del flujo maestro WORKFLOW.md | `configurador-global` |

---

## Auditoría de Datos Personales

> Completar únicamente si el proyecto recolecta, almacena o procesa datos de usuario.
> Si el proyecto **no** maneja datos personales, escribir: `N/A — proyecto sin recolección de datos`.

**Estado de recolección de datos:** [ ] Aplica | [ ] No aplica (N/A)

| Campo | Detalle |
|:------|:--------|
| Tipos de datos recolectados | — |
| Base legal de tratamiento | — |
| Responsable del tratamiento | — |
| Mecanismo de consentimiento | — |
| Derechos del titular habilitados | Acceso / Rectificación / Eliminación / Portabilidad |
| Retención de datos | — (ej: "30 días", "mientras dure la sesión") |
| Transferencia a terceros | — (ej: "ninguna" o especificar) |

---

## Auditoría de Accesibilidad (WCAG 2.1)

> Verificar en Fase 5 con el skill `modo-produccion` y `compliance-legal`.

| Criterio | Estado | Observación |
|:---------|:------:|:------------|
| Contraste de texto (ratio mínimo 4.5:1) | ⏳ Pendiente | — |
| Navegación por teclado | ⏳ Pendiente | — |
| Atributos ARIA en componentes interactivos | ⏳ Pendiente | — |
| `alt` descriptivo en todas las imágenes | ⏳ Pendiente | — |
| Jerarquía de encabezados (H1 → H2 → H3) | ⏳ Pendiente | — |

---

## Historial de Cambios Significativos

> Registrar cualquier cambio que afecte arquitectura, seguridad, stack tecnológico o flujo de usuario.

| Fecha | Build ID | Cambio | Razón | Impacto |
|:------|:---------|:-------|:------|:--------|
| {{YYYY-MM-DD}} | `{{ddmmAAAAhhmmXXXX}}` | Archivo creado | Inicio del flujo WORKFLOW.md | Trazabilidad establecida |

---

## Registro de Errores Críticos

> Los errores detallados viven en `technical/ERROR_LOG.html`.
> Este registro captura solo errores que tuvieron impacto en decisiones de IA.

| Fecha | Build ID | Error | Acción Tomada | Resultado |
|:------|:---------|:------|:--------------|:----------|
| — | — | — | — | — |

---

## Estado de Lanzamiento

| Campo | Detalle |
|:------|:--------|
| Estado del proyecto | ⏳ En desarrollo |
| Fecha de lanzamiento | — |
| URL de producción | — |
| Build ID de lanzamiento | — |
| Verificación final compliance | ⏳ Pendiente (realizar en F5 con `compliance-legal`) |
