---
project: "{{ProjectName}}"
created: "{{YYYY-MM-DD}}"
enforcement: MANDATORY
---

# PHASE TRACKER: {{ProjectName}}

> **REGLA CARDINAL:** El agente **DEBE** actualizar este archivo al completar cada fase.
> El agente **NO PUEDE** iniciar una fase sin que la anterior marque `COMPLETADA`.
> En caso de bloqueo, marcar `BLOQUEADA` y documentar la causa antes de detener el trabajo.
>
> **Estados permitidos:** `PENDIENTE` | `EN_PROGRESO` | `COMPLETADA` | `BLOQUEADA`

---

## Panel de Control del Proyecto

| Fase | Nombre              | Estado       | Fecha Inicio | Fecha Cierre | Skill Principal       |
|:----:|:--------------------|:------------:|:------------:|:------------:|:----------------------|
| F1   | ADN y Cimientos     | `PENDIENTE`  | —            | —            | `brandbook`           |
| F2   | Ideación            | `PENDIENTE`  | —            | —            | `brainstorming-pro`   |
| F3   | Hoja de Ruta        | `PENDIENTE`  | —            | —            | `planificacion-pro`   |
| F4   | Construcción        | `PENDIENTE`  | —            | —            | `doc-to-app`          |
| F5   | Pulido QA           | `PENDIENTE`  | —            | —            | `modo-produccion`     |
| F6   | Despliegue          | `PENDIENTE`  | —            | —            | (manual asistido)     |

---

## Gate F1: ADN y Cimientos

**Skill OBLIGATORIO:** `brandbook`
**Referencia:** `d:/Documentos/Proyectos ADSO/agent/skills/03-Compliance-Docs/brandbook/SKILL.md`
**Estado:** `PENDIENTE`
**Fecha inicio:** —
**Fecha cierre:** —

### Checklist de Salida Gate F1
- [ ] `recursos/estilo-visual.json` creado con: colores primario/secundario/acento, tipografía, estilo.
- [ ] `recursos/guia-de-textos.md` creado con: tono de voz, palabras prohibidas, plantillas de copy.
- [ ] El agente puede responder: "El color primario es [X], la fuente es [Y], el tono es [Z]".
- [ ] Si el proyecto maneja datos de usuario: `compliance-legal` ejecutado.
- [ ] Si se inicializó `technical/`: `AI_LOG_CUMPLIMIENTO.md` actualizado con Build ID de F1.

**Veredicto:** `BLOQUEADO` — completar checklist antes de avanzar a F2.

**Skills opcionales usados en F1:**
- [ ] `compliance-legal` — ¿Aplica? Sí / No
- [ ] `documentador-tecnico` (MODO S) — ¿Aplica? Sí / No
- [ ] `configurador-global` — ¿Aplica? Sí / No

**Nota de cierre F1:** —

---

## Gate F2: Ideación y Concepto

**Skill OBLIGATORIO:** `brainstorming-pro`
**Referencia:** `d:/Documentos/Proyectos ADSO/agent/skills/01-Core-Orchestrator/brainstorming-pro/SKILL.md`
**Estado:** `PENDIENTE` *(BLOQUEADO hasta que F1 = COMPLETADA)*
**Fecha inicio:** —
**Fecha cierre:** —

### Checklist de Salida Gate F2
- [ ] Tanda A generada: 10 ideas rápidas y ejecutables.
- [ ] Tanda B generada: 5 ángulos disruptivos o diferentes.
- [ ] Tanda C generada: 5 ideas de bajo esfuerzo.
- [ ] Tanda D generada: 3 ideas ambiciosas de alto impacto.
- [ ] Cada idea tiene puntuación (1-5) en: Impacto, Claridad, Novedad, Esfuerzo, Viabilidad.
- [ ] **Concepto ganador** seleccionado con: nombre, descripción en 1 línea, puntuación, primer paso.
- [ ] Concepto ganador registrado en `TASK.md`.

**Veredicto:** `BLOQUEADO` — completar checklist antes de avanzar a F3.

**Concepto ganador seleccionado:** —

**Skills opcionales usados en F2:**
- [ ] `enhance-prompt` — ¿Aplica? Sí / No
- [ ] `personality_tracker` — ¿Aplica? Sí / No

**Nota de cierre F2:** —

---

## Gate F3: Hoja de Ruta

**Skills OBLIGATORIOS:** `planificacion-pro` + `documentador-tecnico` (MODO S + MODO D)
**Referencia planificacion-pro:** `d:/Documentos/Proyectos ADSO/agent/skills/01-Core-Orchestrator/planificacion-pro/SKILL.md`
**Referencia documentador-tecnico:** `d:/Documentos/Proyectos ADSO/agent/skills/03-Compliance-Docs/documentador-tecnico/SKILL.md`
**Estado:** `PENDIENTE` *(BLOQUEADO hasta que F2 = COMPLETADA)*
**Fecha inicio:** —
**Fecha cierre:** —

### Checklist de Salida Gate F3
- [ ] Resultado final documentado en 1 frase.
- [ ] 3 criterios de éxito definidos.
- [ ] Plan en máximo 4 sub-fases con tareas, tiempos y entregables.
- [ ] Matriz de Riesgos: mínimo 3 riesgos con mitigación (Si X → hago Y).
- [ ] `TASK.md` actualizado con **todas** las tareas del plan.
- [ ] `technical/` creada con los 4 archivos base: `BUILD_PROJECT.html`, `ERROR_LOG.html`, `DOC_TECNICO.html`, `MANUAL_USUARIO.html`.
- [ ] `AI_LOG_CUMPLIMIENTO.md` tiene el Build ID inicial generado en MODO D.

**Veredicto:** `BLOQUEADO` — completar checklist antes de avanzar a F4.

**Skills opcionales usados en F3:**
- [ ] `configurador-global` — ¿Aplica? Sí / No
- [ ] `creador-de-skills` — ¿Aplica? Sí / No

**Nota de cierre F3:** —

---

## Gate F4: Construcción

**Skill OBLIGATORIO (base):** `doc-to-app`
**Referencia:** `d:/Documentos/Proyectos ADSO/agent/skills/02-Builder-Stack/doc-to-app/SKILL.md`
**Estado:** `PENDIENTE` *(BLOQUEADO hasta que F3 = COMPLETADA)*
**Fecha inicio:** —
**Fecha cierre:** —

### Skills opcionales usados en F4

| Skill | Rol | Estado |
|:------|:---:|:------:|
| `doc-to-app` | OBLIGATORIO (si nace de documento) | `PENDIENTE` |
| `design-md` | OPCIONAL | N/A |
| `enhance-prompt` | OPCIONAL | N/A |
| `react-components` | OPCIONAL | N/A |
| `shadcn-ui` | OPCIONAL | N/A |
| `stitch-loop` | OPCIONAL | N/A |
| `remotion` | OPCIONAL | N/A |
| `header-manager` | OPCIONAL | N/A |

### Checklist de Salida Gate F4
- [ ] Artefacto funcional existe (`index.html` abre sin errores en localhost).
- [ ] PWA implementada: `manifest.json` + `service-worker.js` existen y están registrados.
- [ ] Sin rutas rotas ni textos de placeholder visible (lorem ipsum, "TBD", "TODO").
- [ ] Brandbook respetado: colores y fuentes coinciden con `recursos/estilo-visual.json`.
- [ ] `TASK.md` actualizado con todos los componentes construidos.
- [ ] Errores encontrados registrados en `technical/ERROR_LOG.html`.

**Veredicto:** `BLOQUEADO` — completar checklist antes de avanzar a F5.

**Nota de cierre F4:** —

---

## Gate F5: Pulido de Excelencia

**Skill OBLIGATORIO:** `modo-produccion`
**Referencia:** `d:/Documentos/Proyectos ADSO/agent/skills/04-Optimization-Flow/modo-produccion/SKILL.md`
**Estado:** `PENDIENTE` *(BLOQUEADO hasta que F4 = COMPLETADA)*
**Fecha inicio:** —
**Fecha cierre:** —

### Checklist de Salida Gate F5
- [ ] **Checklist A** — Funciona y se ve: carga sin errores, imágenes OK, estilos aplicados. ⬜ PASADO
- [ ] **Checklist B** — Responsive mobile-first: sin cortes ni scroll horizontal. ⬜ PASADO
- [ ] **Checklist C** — Copy y UX: headline claro, CTAs consistentes, **sin lorem ipsum**. ⬜ PASADO
- [ ] **Checklist D** — Accesibilidad: contraste OK, `alt` en imágenes, jerarquía H1-H2 lógica. ⬜ PASADO
- [ ] Veredicto emitido (`"OK para enseñar"` o `"OK para publicar"`) y registrado en `TASK.md`.
- [ ] `technical/DOC_TECNICO.html` actualizado.
- [ ] `technical/MANUAL_USUARIO.html` actualizado.

**Veredicto `modo-produccion`:** —

**Skills opcionales usados en F5:**
- [ ] `compliance-legal` — ¿Aplica? Sí / No
- [ ] `documentador-tecnico` (MODO D) — ¿Aplica? Sí / No

**Veredicto:** `BLOQUEADO` — todos los checklists deben estar PASADOS antes de avanzar a F6.

**Nota de cierre F5:** —

---

## Gate F6: Despliegue y Lanzamiento

**Skill OBLIGATORIO:** (manual asistido)
**Skills de apoyo:** `configurador-global`, `documentador-tecnico`
**Estado:** `PENDIENTE` *(BLOQUEADO hasta que F5 = COMPLETADA)*
**Fecha inicio:** —
**Fecha cierre:** —

### Checklist de Salida Gate F6
- [ ] Git commit realizado con mensaje descriptivo.
- [ ] `technical/Repositorio.md` actualizado con URL final + estado `"PUBLICADO"`.
- [ ] `AI_LOG_CUMPLIMIENTO.md` tiene registro del lanzamiento con fecha y Build ID.
- [ ] Túnel zrok activado o URL de producción documentada (si aplica).
- [ ] `TASK.md`: **todas** las tareas en estado ✅ — ninguna ⏳ ni ❌.

**Estado final:** `PROYECTO CERRADO`
**Fecha de cierre del proyecto:** —
**URL de producción:** —

**Nota de cierre F6:** —
