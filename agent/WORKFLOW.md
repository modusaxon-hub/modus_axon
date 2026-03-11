---
scope: global
version: 2.0
enforcement: MANDATORY
read-order: 1
---

# WORKFLOW MAESTRO: Flujo de 6 Fases con Gates de Control

> **INSTRUCCIÓN PARA EL AGENTE:** Lee este archivo **ANTES** de iniciar cualquier tarea
> en cualquier proyecto. No avances de fase sin completar el gate de la fase anterior.
> Registra cada gate superado en el `PHASE-TRACKER.md` del proyecto activo.
>
> Para seleccionar el skill correcto en cada fase, consulta: `SKILL-INDEX.md`

---

## LECTURA OBLIGATORIA AL INICIAR CUALQUIER PROYECTO

Antes de la Fase 1, verifica que existen estos archivos en la raíz del proyecto activo.
Si **no existen**, créalos copiando las plantillas de `agent/templates/project-boot/` y
reemplazando `{{ProjectName}}` y `{{YYYY-MM-DD}}`:

- [ ] `INSTRUCTIONS.md` (raíz del proyecto)
- [ ] `PHASE-TRACKER.md` (raíz del proyecto)
- [ ] `AI_LOG_CUMPLIMIENTO.md` (raíz del proyecto)
- [ ] `TASK.md` (raíz del proyecto — tabla de acciones con ⏳/✅/❌)

---

## REGLA DE REGRESIÓN (Global)

> Si un gate falla, el agente **NO avanza**. Debe volver al skill de la fase anterior,
> re-ajustar y re-validar el gate antes de continuar. **Nunca saltarse un gate.**

---

## FASE 1: ADN y Cimientos (Branding)

**Skill OBLIGATORIO:** `brandbook`
**Categoría:** 03-Compliance-Docs
**Referencia completa:** `skills/03-Compliance-Docs/brandbook/SKILL.md`

### Entradas requeridas
- Nombre del proyecto (`{{ProjectName}}`)
- Activos de marca disponibles (logo, paleta de colores, tipografía, tono)

### Acciones de la fase
1. Auditar identidad: revisar activos de marca disponibles del proyecto.
2. Configurar o validar `recursos/estilo-visual.json` con colores, fuentes y estilo.
3. Configurar o validar `recursos/guia-de-textos.md` con tono, reglas de copy y plantillas.
4. (Si maneja datos de usuario) Invocar `compliance-legal` para configurar privacidad.
5. (Opcional) Invocar `documentador-tecnico` en MODO S para inicializar `AI_LOG_CUMPLIMIENTO.md`.

### Gate F1: Criterios de Salida — OBLIGATORIO antes de F2
- [ ] `recursos/estilo-visual.json` existe con: colores primario/secundario/acento, tipografía, tono.
- [ ] `recursos/guia-de-textos.md` existe con ejemplos de copy y palabras prohibidas.
- [ ] El agente puede responder: "El color primario es [X], la fuente es [Y], el tono es [Z]".
- [ ] Si hay datos de usuario: `compliance-legal` ejecutado y `AI_LOG_CUMPLIMIENTO.md` inicializado.
- [ ] Registrar en `PHASE-TRACKER.md`: `FASE_1: COMPLETADA`

### Skills opcionales en F1
| Skill | Cuándo usarlo |
|:------|:--------------|
| `compliance-legal` | Proyecto con formularios, BD o datos personales |
| `documentador-tecnico` (MODO S) | Inicializar archivos en `technical/` desde el inicio |
| `configurador-global` | Proyecto nuevo: verificar Git, XAMPP, estructura de carpetas |

---

## FASE 2: Ideación y Concepto

**Skill OBLIGATORIO:** `brainstorming-pro`
**Categoría:** 01-Core-Orchestrator
**Referencia completa:** `skills/01-Core-Orchestrator/brainstorming-pro/SKILL.md`

### Entradas requeridas
- Objetivo exacto del proyecto (en 1-2 frases)
- Público objetivo y contexto de uso
- Restricciones: tiempo, presupuesto, tono de marca (de F1)

### Acciones de la fase
1. Generar 4 tandas de ideas:
   - **A)** 10 ideas rápidas y ejecutables
   - **B)** 5 ángulos disruptivos o diferentes
   - **C)** 5 ideas de bajo esfuerzo
   - **D)** 3 ideas ambiciosas de alto impacto
2. Puntuar cada idea del 1 al 5 en: Impacto, Claridad, Novedad, Esfuerzo, Viabilidad.
3. Seleccionar el **concepto ganador** con razonamiento y primer paso de ejecución.
4. Entregar resultado en HTML autocontenido A4.

### Gate F2: Criterios de Salida — OBLIGATORIO antes de F3
- [ ] 4 tandas de ideas generadas y documentadas.
- [ ] Cada idea tiene puntuación en los 5 criterios.
- [ ] **Concepto ganador** seleccionado con: nombre, descripción en 1 línea, puntuación, primer paso.
- [ ] Concepto ganador registrado en `TASK.md`.
- [ ] Registrar en `PHASE-TRACKER.md`: `FASE_2: COMPLETADA`

### Skills opcionales en F2
| Skill | Cuándo usarlo |
|:------|:--------------|
| `enhance-prompt` | Si el concepto ganador se usará en Stitch para generación de UI |
| `personality_tracker` | Actualizar preferencias del usuario detectadas en esta sesión |

---

## FASE 3: Hoja de Ruta (Roadmap)

**Skill OBLIGATORIO:** `planificacion-pro`
**Categoría:** 01-Core-Orchestrator
**Referencia completa:** `skills/01-Core-Orchestrator/planificacion-pro/SKILL.md`

**Skill OBLIGATORIO secundario:** `documentador-tecnico` (MODO S + MODO D)
**Referencia completa:** `skills/03-Compliance-Docs/documentador-tecnico/SKILL.md`

### Entradas requeridas
- Concepto ganador de F2
- Fecha límite o cadencia de trabajo (ej: "2 horas diarias")
- Recursos disponibles: equipo, presupuesto, tiempo diario

### Acciones de la fase
1. Definir resultado final en 1 frase + 3 criterios de éxito.
2. Dividir en **máximo 4 sub-fases técnicas** (Preparación, Producción, QA, Lanzamiento).
3. Para cada sub-fase: tareas ordenadas, entregable claro, tiempo estimado.
4. Construir **Matriz de Riesgos**: mínimo 3 riesgos con mitigación (Si X → hago Y).
5. Generar Checklist Final de validación del proyecto.
6. Invocar `documentador-tecnico` MODO S: crear carpeta `technical/` con 4 archivos base.
7. Invocar `documentador-tecnico` MODO D: registrar Build ID inicial en `BUILD_PROJECT.html`.
8. Actualizar `TASK.md` con **todas** las tareas del plan.

### Gate F3: Criterios de Salida — OBLIGATORIO antes de F4
- [ ] Resultado final documentado en 1 frase + 3 criterios de éxito.
- [ ] Plan en máximo 4 sub-fases con tareas, tiempos y entregables.
- [ ] Matriz de Riesgos con mínimo 3 riesgos y sus mitigaciones.
- [ ] `TASK.md` actualizado con **todas** las tareas identificadas.
- [ ] `technical/` existe en la raíz del proyecto con: `BUILD_PROJECT.html`, `ERROR_LOG.html`, `DOC_TECNICO.html`, `MANUAL_USUARIO.html`.
- [ ] `AI_LOG_CUMPLIMIENTO.md` tiene el Build ID inicial generado por `documentador-tecnico`.
- [ ] Registrar en `PHASE-TRACKER.md`: `FASE_3: COMPLETADA`

### Skills opcionales en F3
| Skill | Cuándo usarlo |
|:------|:--------------|
| `configurador-global` | Verificar entorno Git, XAMPP y enlace simbólico |
| `creador-de-skills` | Si el proyecto requiere un skill nuevo no existente |

---

## FASE 4: Construcción

**Skill OBLIGATORIO:** `doc-to-app` *(si el proyecto nace de un documento)*
**Categoría:** 02-Builder-Stack
**Referencia completa:** `skills/02-Builder-Stack/doc-to-app/SKILL.md`

> **NOTA:** Esta es la fase con mayor variedad de skills. El skill OBLIGATORIO
> es `doc-to-app` si el proyecto nace de un documento o texto denso.
> Si es desarrollo React o UI Stitch, consulta el `SKILL-INDEX.md` para
> seleccionar la cadena correcta de skills opcionales.

### Entradas requeridas
- Fuente del contenido (PDF, texto, requisitos funcionales)
- Tipo de app (guía, catálogo, checklist, dashboard, landing, SPA)
- Prioridad: "Más visual" o "Más funcional"
- Identidad de marca de F1 (colores, fuentes, tono)

### Acciones de la fase — `doc-to-app` (flujo base)
1. Extraer estructura del documento (secciones, listas, tablas, puntos clave).
2. Crear `data.json` con contenido estructurado y ordenado.
3. Generar `index.html` con Vanilla HTML/JS consumiendo `data.json`.
4. Implementar PWA: `manifest.json` + `service-worker.js` con estrategia stale-while-revalidate.
5. Validar: búsqueda funciona, filtros operan, diseño mobile-first, sin lorem ipsum.
6. Registrar errores en `technical/ERROR_LOG.html` si ocurren.

### Gate F4: Criterios de Salida — OBLIGATORIO antes de F5
- [ ] Existe al menos un artefacto funcional (`index.html` abre sin errores en localhost).
- [ ] PWA implementada: `manifest.json` + `service-worker.js` existen y registrados.
- [ ] Sin rutas rotas ni textos de placeholder (lorem ipsum, "TBD", "TODO").
- [ ] El brandbook se respeta: colores y fuentes coinciden con `recursos/estilo-visual.json`.
- [ ] `TASK.md` actualizado con todos los componentes construidos en esta fase.
- [ ] Errores encontrados registrados en `technical/ERROR_LOG.html`.
- [ ] Registrar en `PHASE-TRACKER.md`: `FASE_4: COMPLETADA`

### Skills opcionales en F4 (seleccionar según tipo de proyecto)
| Skill | Cuándo usarlo |
|:------|:--------------|
| `design-md` | Si se usa Stitch — ejecutar **primero** para crear `DESIGN.md` |
| `enhance-prompt` | Optimizar prompts antes de enviarlos a Stitch |
| `react-components` | Stack React: crear componentes type-safe desde diseños |
| `shadcn-ui` | Stack React: integrar componentes shadcn/ui con tema del proyecto |
| `stitch-loop` | Iterar múltiples pantallas en Stitch de forma autónoma |
| `remotion` | Generar video programático de walkthrough del proyecto |
| `header-manager` | Si se modifica `Header.jsx` del ecosistema `project_jacquin` |

---

## FASE 5: Pulido de Excelencia (QA)

**Skill OBLIGATORIO:** `modo-produccion`
**Categoría:** 04-Optimization-Flow
**Referencia completa:** `skills/04-Optimization-Flow/modo-produccion/SKILL.md`

### Entradas requeridas
- Ruta del archivo principal (`index.html` o ruta del proyecto en localhost)
- Objetivo de revisión: `"Listo para enseñar"` o `"Listo para publicar"`
- Restricciones: qué NO tocar (branding, estructura, etc.)

### Acciones de la fase
1. **Diagnóstico rápido:** lista de 5-10 problemas priorizada.
2. **Plan de arreglos:** máximo 8 cambios de alto impacto con razonamiento.
3. **Ejecución:** aplicar cambios en los archivos necesarios.
4. **Validación** contra el checklist de 4 secciones:
   - **A)** Funciona y se ve: carga sin errores, imágenes OK, estilos aplicados.
   - **B)** Responsive mobile-first: sin cortes ni scroll horizontal, botones legibles.
   - **C)** Copy y UX básico: headline claro, CTAs consistentes, **sin lorem ipsum**.
   - **D)** Accesibilidad mínima: contraste razonable, `alt` en imágenes, jerarquía H1-H2 lógica.
5. Emitir **veredicto final**: `"OK para enseñar"` o `"OK para publicar"`.
6. Invocar `documentador-tecnico` para actualizar `technical/DOC_TECNICO.html` y `MANUAL_USUARIO.html`.

### Gate F5: Criterios de Salida — OBLIGATORIO antes de F6
- [ ] Checklist A (Funciona y se ve): **PASADO**.
- [ ] Checklist B (Responsive mobile-first): **PASADO**.
- [ ] Checklist C (Copy sin lorem ipsum): **PASADO**.
- [ ] Checklist D (Accesibilidad mínima): **PASADO**.
- [ ] Veredicto emitido y registrado en `TASK.md`.
- [ ] `technical/DOC_TECNICO.html` actualizado.
- [ ] `technical/MANUAL_USUARIO.html` actualizado.
- [ ] Registrar en `PHASE-TRACKER.md`: `FASE_5: COMPLETADA`

### Skills opcionales en F5
| Skill | Cuándo usarlo |
|:------|:--------------|
| `compliance-legal` | Auditoría final de privacidad y cumplimiento SIC 2026 |
| `documentador-tecnico` (MODO D) | Actualizar `ERROR_LOG.html` con errores encontrados en QA |

---

## FASE 6: Despliegue y Lanzamiento

**Skill OBLIGATORIO:** ninguno — proceso manual asistido
**Skills de apoyo recomendados:** `configurador-global`, `documentador-tecnico`

### Acciones de la fase
1. Consolidar artefactos finales en carpeta de distribución.
2. Verificar enlace simbólico XAMPP activo (si aplica).
3. Activar túnel zrok si se requiere compartir externamente.
4. Verificar estado final del proyecto: `"OK para publicar"` confirmado en F5.
5. Realizar commit Git con mensaje descriptivo:
   ```
   git commit -m "feat: lanzamiento de {{ProjectName}} v1.0"
   ```
6. Actualizar `technical/Repositorio.md` con URL final y estado `"PUBLICADO"`.
7. Registrar lanzamiento en `AI_LOG_CUMPLIMIENTO.md`.

### Gate F6: Criterios de Salida — PROYECTO CERRADO
- [ ] Git commit realizado con todos los archivos del proyecto.
- [ ] `technical/Repositorio.md` actualizado con URL + estado `"PUBLICADO"`.
- [ ] `AI_LOG_CUMPLIMIENTO.md` tiene registro del lanzamiento con fecha y Build ID.
- [ ] Túnel zrok activado o URL de producción documentada (si aplica).
- [ ] `TASK.md`: **todas** las tareas en estado ✅ — ninguna pendiente (⏳) ni bloqueada (❌).
- [ ] Registrar en `PHASE-TRACKER.md`: `FASE_6: COMPLETADA — PROYECTO CERRADO`

---

## Resumen Visual del Flujo

```
INICIO DE PROYECTO
       │
       ▼
[Verificar INSTRUCTIONS.md, PHASE-TRACKER.md, AI_LOG_CUMPLIMIENTO.md, TASK.md]
       │
       ▼
┌─────────────────────────────────────────────────────┐
│  F1: ADN y Cimientos                                │
│  OBLIGATORIO: brandbook                             │
│  Gate: estilo-visual.json + guia-de-textos.md ✅   │
└─────────────────────────────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────────────────────┐
│  F2: Ideación y Concepto                            │
│  OBLIGATORIO: brainstorming-pro                     │
│  Gate: Concepto ganador documentado en TASK.md ✅  │
└─────────────────────────────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────────────────────┐
│  F3: Hoja de Ruta                                   │
│  OBLIGATORIO: planificacion-pro + documentador-tecnico │
│  Gate: Plan + technical/ + Build ID inicial ✅     │
└─────────────────────────────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────────────────────┐
│  F4: Construcción                                   │
│  OBLIGATORIO: doc-to-app (+ skills opcionales)      │
│  Gate: Artefacto funcional + PWA + sin placeholders ✅│
└─────────────────────────────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────────────────────┐
│  F5: Pulido de Excelencia                           │
│  OBLIGATORIO: modo-produccion                       │
│  Gate: Checklist A+B+C+D PASADOS + veredicto ✅    │
└─────────────────────────────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────────────────────┐
│  F6: Despliegue y Lanzamiento                       │
│  OBLIGATORIO: (manual asistido)                     │
│  Gate: Git commit + Repositorio.md PUBLICADO ✅    │
└─────────────────────────────────────────────────────┘
       │
       ▼
  PROYECTO CERRADO
```

---

## Referencias Cruzadas

| Documento | Propósito | Ubicación |
|:----------|:----------|:----------|
| `SKILL-INDEX.md` | Catálogo completo de los 17 skills | `agent/SKILL-INDEX.md` |
| `INSTRUCTIONS.md` | Contexto del proyecto activo | Raíz de cada proyecto |
| `PHASE-TRACKER.md` | Bitácora de gates por proyecto | Raíz de cada proyecto |
| `AI_LOG_CUMPLIMIENTO.md` | Registro legal de decisiones de IA | Raíz de cada proyecto |
| `TASK.md` | Log de acciones en tiempo real | Raíz de cada proyecto |
| `recursos/estilo-visual.json` | Paleta y tipografía del proyecto | Raíz de cada proyecto |
| `recursos/guia-de-textos.md` | Tono y reglas de copy | Raíz de cada proyecto |
| `technical/` | Documentación técnica generada | Raíz de cada proyecto |
