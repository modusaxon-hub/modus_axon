---
scope: global
version: 1.0
enforcement: MANDATORY
read-order: 2
---

# SKILL INDEX: Catálogo de los 17 Skills del Sistema Antigravity

> **INSTRUCCIÓN PARA EL AGENTE:** Consulta este índice cuando necesites saber qué skill
> usar para una tarea específica. Cada entrada incluye: cuándo usarlo, fase donde aplica,
> si es OBLIGATORIO u OPCIONAL, y la ruta de la instrucción completa.
>
> Lee siempre **WORKFLOW.md** primero para conocer el contexto de fase activo.

---

## Categoría 01: Core Orchestrator

### `brainstorming-pro`
- **Fase:** 2
- **Rol en flujo:** **OBLIGATORIO** en F2
- **Cuándo invocar:** Generar ideas, variantes, conceptos, hooks, nombres o formatos para el proyecto.
- **Input clave:** Objetivo exacto + público objetivo + restricciones (tiempo, tono, presupuesto).
- **Output:** TOP 5 ideas puntuadas (Impacto, Claridad, Novedad, Esfuerzo, Viabilidad) entregadas en HTML A4.
- **Referencia:** `skills/01-Core-Orchestrator/brainstorming-pro/SKILL.md`

---

### `configurador-global`
- **Fase:** 1, 3, 6 (transversal)
- **Rol en flujo:** OPCIONAL — recomendado al iniciar proyecto nuevo y al desplegar
- **Cuándo invocar:** Verificar/configurar entorno Git, XAMPP, zrok, enlaces simbólicos, estructura de carpetas.
- **Input clave:** Nombre del proyecto (`{{ProjectName}}`).
- **Output:** Entorno validado con Git configurado, enlace simbólico XAMPP creado, estructura `technical/` verificada.
- **Referencia:** `skills/01-Core-Orchestrator/configurador-global/INSTRUCTIONS.md`
- **Nota crítica:** Leer siempre al iniciar un proyecto desde cero. Define reglas de identidad Git (usuario: `modusaxon-hub`).

---

### `creador-de-skills`
- **Fase:** 3
- **Rol en flujo:** OPCIONAL
- **Cuándo invocar:** Si el proyecto requiere un proceso repetitivo que no tiene skill existente en este índice.
- **Input clave:** Propósito del nuevo skill + contexto (frontend, backend, diseño) + nivel de libertad (Alto/Medio/Bajo).
- **Output:** Carpeta `skills/<nombre-skill>/` con `SKILL.md` completo, validado y agnóstico a proyectos.
- **Referencia:** `skills/01-Core-Orchestrator/creador-de-skills/SKILL.md`

---

### `planificacion-pro`
- **Fase:** 3
- **Rol en flujo:** **OBLIGATORIO** en F3
- **Cuándo invocar:** Convertir el concepto ganador de F2 en un plan ejecutable con fases, riesgos y entregables.
- **Input clave:** Concepto ganador + fecha límite o cadencia de trabajo + recursos disponibles.
- **Output:** Plan por fases (máx. 4), matriz de riesgos, checklist final — en HTML A4. TASK.md actualizado.
- **Referencia:** `skills/01-Core-Orchestrator/planificacion-pro/SKILL.md`
- **Entregable obligatorio:** Actualizar `TASK.md` al finalizar la fase.

---

## Categoría 02: Builder Stack

### `design-md`
- **Fase:** 4
- **Rol en flujo:** OPCIONAL — **obligatorio si se usa Stitch para UI**
- **Cuándo invocar:** Antes de generar pantallas en Stitch para extraer y documentar el sistema de diseño.
- **Input clave:** Proyecto Stitch con al menos una pantalla diseñada + acceso al servidor MCP de Stitch.
- **Output:** Archivo `DESIGN.md` con paleta de colores, tipografía, geometría y notas de generación para Stitch.
- **Referencia:** `skills/02-Builder-Stack/design-md/SKILL.md`
- **Dependencia:** Requiere acceso al MCP Server de Stitch. Ejecutar **antes** de `stitch-loop` o `enhance-prompt`.

---

### `doc-to-app`
- **Fase:** 4
- **Rol en flujo:** **OBLIGATORIO** en F4 (si el proyecto nace de un documento)
- **Cuándo invocar:** Transformar PDF, texto denso o notas estructuradas en una mini-app web interactiva.
- **Input clave:** Fuente (PDF/texto) + tipo de app (guía, catálogo, checklist, itinerario) + prioridad (visual o funcional).
- **Output:** Carpeta `miniapp_<tema>_<timestamp>/` con `index.html` + `data.json` + PWA (`manifest.json` + `service-worker.js`).
- **Referencia:** `skills/02-Builder-Stack/doc-to-app/SKILL.md`
- **Entregable obligatorio:** PWA implementada (manifest + service worker). Sin lorem ipsum.

---

### `header-manager`
- **Fase:** 4
- **Rol en flujo:** OPCIONAL — solo si el proyecto comparte el Header Maestro con `project_jacquin`
- **Cuándo invocar:** Al modificar `Header.jsx`, `JamLogo.jsx` o `Navbar.jsx` del ecosistema `project_jacquin`.
- **Input clave:** Archivo modificado + ruta del proyecto `pages/`.
- **Output:** Bundle compilado `public/js/react-header.bundle.js` actualizado. Confirmación de sincronización.
- **Referencia:** `skills/02-Builder-Stack/header-manager/INSTRUCTIONS.md`
- **Nota:** Ejecutar `npm run build:header` después de cada modificación al Header.

---

### `react-components`
- **Fase:** 4
- **Rol en flujo:** OPCIONAL
- **Cuándo invocar:** Crear componentes React reutilizables y type-safe desde diseños Stitch o specs.
- **Input clave:** Descripción del componente + stack (Vite/CRA/Next) + diseño de referencia.
- **Output:** Componente `.tsx` con interfaz `Readonly`, hooks separados en `src/hooks/`, datos en `src/data/mockData.ts`.
- **Referencia:** `skills/02-Builder-Stack/react-components/SKILL.md`

---

### `remotion`
- **Fase:** 4
- **Rol en flujo:** OPCIONAL
- **Cuándo invocar:** Generar videos programáticos de walkthrough a partir de pantallas Stitch o diseños.
- **Input clave:** Pantallas Stitch descargadas + guión de narración + duración objetivo.
- **Output:** Video `.mp4` renderizado con transiciones, zooms y text overlays. Proyecto Remotion configurado.
- **Referencia:** `skills/02-Builder-Stack/remotion/SKILL.md`

---

### `shadcn-ui`
- **Fase:** 4
- **Rol en flujo:** OPCIONAL
- **Cuándo invocar:** Integrar componentes shadcn/ui en proyectos React para UI accesible y personalizable.
- **Input clave:** Lista de componentes necesarios + tema del proyecto (colores, fonts, roundness).
- **Output:** Componentes instalados en `components/ui/`, `components.json` configurado, tema aplicado en CSS variables.
- **Referencia:** `skills/02-Builder-Stack/shadcn-ui/SKILL.md`
- **Nota:** shadcn/ui NO es librería — los componentes viven en tu codebase.

---

### `stitch-loop`
- **Fase:** 4
- **Rol en flujo:** OPCIONAL — **obligatorio si se iteran múltiples pantallas en Stitch**
- **Cuándo invocar:** Generar y coordinar múltiples pantallas de un sitio web en Stitch manteniendo coherencia visual.
- **Input clave:** `DESIGN.md` (del skill `design-md`) + `SITE.md` con visión y roadmap + `next-prompt.md` como baton.
- **Output:** Pantallas `.html` en `site/public/`, `SITE.md` actualizado, `next-prompt.md` preparado para siguiente iteración.
- **Referencia:** `skills/02-Builder-Stack/stitch-loop/SKILL.md`
- **Dependencia:** Ejecutar `design-md` primero para tener `DESIGN.md`.

---

## Categoría 03: Compliance Docs

### `brandbook`
- **Fase:** 1
- **Rol en flujo:** **OBLIGATORIO** en F1
- **Cuándo invocar:** Antes de generar cualquier UI, copy, landing, componente o asset visible al usuario.
- **Input clave:** Nombre del proyecto + activos de marca disponibles (logo, paleta, tipografía).
- **Output:** `recursos/estilo-visual.json` + `recursos/guia-de-textos.md` configurados para el proyecto activo.
- **Referencia:** `skills/03-Compliance-Docs/brandbook/SKILL.md`
- **Entregable obligatorio:** El agente debe poder responder "el color primario es X, la fuente es Y" antes de avanzar a F2.

---

### `compliance-legal`
- **Fase:** 1, 5 (auditoría de entrada y salida)
- **Rol en flujo:** OPCIONAL — **obligatorio si el proyecto maneja datos de usuario**
- **Cuándo invocar:** Proyectos con formularios, bases de datos, autenticación o cualquier recolección de datos personales.
- **Input clave:** Tipos de datos recolectados + país de operación (Colombia por defecto).
- **Output:** Componentes de consentimiento inyectados, avisos de privacidad, ARIA labels verificados.
- **Referencia:** `skills/03-Compliance-Docs/compliance-legal/SKILL.md`
- **Estándares:** Ley 1581 de 2012, GDPR, Resolución 1519 de 2020 (MinTIC) / SIC 2026.

---

### `documentador-tecnico`
- **Fase:** 3, 5 (transversal desde F3)
- **Rol en flujo:** **OBLIGATORIO** al iniciar proyecto (F3) y al cerrar QA (F5)
- **Cuándo invocar:** Inicializar `AI_LOG_CUMPLIMIENTO.md`, crear diagramas ERD, flujos de usuario, bitácoras de construcción.
- **Input clave:** Nombre del proyecto + archivos de código fuente o SQL.
- **Output:** Carpeta `technical/` con 4 archivos base: `BUILD_PROJECT.html`, `ERROR_LOG.html`, `DOC_TECNICO.html`, `MANUAL_USUARIO.html`.
- **Referencia:** `skills/03-Compliance-Docs/documentador-tecnico/SKILL.md`
- **Modos de operación:**
  - `MODO S` — Setup inicial (crear `technical/` y archivos base)
  - `MODO A` — Arquitecto (diagramas Mermaid desde SQL)
  - `MODO B` — Analista (comparar plan vs realidad)
  - `MODO C` — Narrador (casos de uso)
  - `MODO D` — Constructor (Build Logger con ID `ddmmAAAAhhmmXXXX`)

---

## Categoría 04: Optimization Flow

### `enhance-prompt`
- **Fase:** 2, 4 (antes de enviar prompts a Stitch)
- **Rol en flujo:** OPCIONAL — **obligatorio si se usa Stitch**
- **Cuándo invocar:** Pulir prompts vagos para Stitch antes de generar pantallas; mejorar resultados de generación previa.
- **Input clave:** Prompt vago del usuario + `DESIGN.md` del proyecto (si existe).
- **Output:** Prompt estructurado con: descripción en 1 línea, bloque DESIGN SYSTEM, estructura numerada de la página.
- **Referencia:** `skills/04-Optimization-Flow/enhance-prompt/SKILL.md`

---

### `modo-produccion`
- **Fase:** 5
- **Rol en flujo:** **OBLIGATORIO** en F5
- **Cuándo invocar:** Antes de mostrar, grabar demo o publicar cualquier entregable del proyecto.
- **Input clave:** Ruta del archivo principal (`index.html` o ruta del proyecto) + objetivo ("Listo para enseñar" o "Listo para publicar") + restricciones.
- **Output:** Diagnóstico priorizado + cambios aplicados + veredicto final con checklist de 4 secciones (A, B, C, D).
- **Referencia:** `skills/04-Optimization-Flow/modo-produccion/SKILL.md`

---

### `personality_tracker`
- **Fase:** Transversal — actualizar en cada interacción significativa
- **Rol en flujo:** OPCIONAL — recomendado
- **Cuándo invocar:** Al detectar nuevas preferencias, estilos de aprendizaje o decisiones técnicas del usuario no registradas.
- **Input clave:** Observación sobre comportamiento o preferencia del usuario.
- **Output:** Actualización del perfil en `personality_tracker.md` con fecha y observación.
- **Referencia:** `skills/04-Optimization-Flow/personality_tracker/personality_tracker.md`
- **Nota:** Nunca hardcodear marcas. Es una bitácora evolutiva.

---
180: 
181: ## Categoría 05: Auditoría de Software
182: 
183: ### `lider-auditoria`
184: - **Fase:** 1, 5, 6
185: - **Rol en flujo:** OPCIONAL — Recomendado para proyectos de alto impacto.
186: - **Cuándo invocar:** Definir el plan de auditoría, gestionar riesgos y coordinar especialistas.
187: - **Input clave:** Objetivo del proyecto + matriz de riesgos inicial.
188: - **Output:** Audit Charter + Matriz de Riesgo + Plan de Mitigación.
189: - **Referencia:** `skills/05-Auditoria-Software/01-Lider-Auditoria/SKILL.md`
190: 
191: ---
192: 
193: ### `auditor-seguridad`
194: - **Fase:** 5
195: - **Rol en flujo:** OPCIONAL — **Obligatorio para apps productivas.**
196: - **Cuándo invocar:** Pruebas de penetración, escaneo de vulnerabilidades y blindaje.
197: - **Input clave:** Código fuente + URL de staging.
198: - **Output:** Reporte de vulnerabilidades OWASP + Parches aplicados.
199: - **Referencia:** `skills/05-Auditoria-Software/02-Auditor-Seguridad/SKILL.md`
200: 
201: ---
202: 
203: ### `auditor-arquitectura`
204: - **Fase:** 3, 4, 5
205: - **Rol en flujo:** OPCIONAL — Asesor técnico continuo.
206: - **Cuándo invocar:** Validar la robustez del diseño, deuda técnica y escalabilidad.
207: - **Input clave:** Diagramas Mermaid + Estructura de código.
208: - **Output:** Diagnóstico de deuda técnica + Roadmap de refactorización.
209: - **Referencia:** `skills/05-Auditoria-Software/03-Arquitecto-Software/SKILL.md`
210: 
211: ---
212: 
213: ### `auditor-qa`
214: - **Fase:** 4, 5
215: - **Rol en flujo:** OPCIONAL — Asegurador de calidad.
216: - **Cuándo invocar:** Auditar el ciclo de vida (SDLC), pruebas unitarias y cobertura.
217: - **Input clave:** Suite de pruebas + Reporte de bugs.
218: - **Output:** Certificado de calidad + Reporte de cobertura.
219: - **Referencia:** `skills/05-Auditoria-Software/04-Especialista-QA/SKILL.md`
220: 
221: ---
222: 
223: ### `auditor-juridico`
224: - **Fase:** 1, 5
225: - **Rol en flujo:** **OBLIGATORIO** para cumplimiento legal.
226: - **Cuándo invocar:** Privacidad de datos (Ley 1581), licencias software y términos legales.
227: - **Input clave:** Tipos de datos recolectados + dependencias npm/pip.
228: - **Output:** Reporte de cumplimiento SIC/GDPR + Registro de licencias.
229: - **Referencia:** `skills/05-Auditoria-Software/05-Auditor-Juridico-Compliance/SKILL.md`
230: - **Dependencia:** Utiliza estándares definidos en `compliance-legal`.
231: 
232: ---
233: 
234: ### `auditor-infraestructura`
235: - **Fase:** 5, 6
236: - **Rol en flujo:** OPCIONAL — Experto DevSecOps.
237: - **Cuándo invocar:** Auditar configuraciones cloud, seguridad de red y backups.
238: - **Input clave:** Configuración Supabase/AWS/Azure.
239: - **Output:** Reporte de salud cloud + Plan de recuperación ante desastres.
240: - **Referencia:** `skills/05-Auditoria-Software/06-Especialista-Infraestructura/SKILL.md`
241: 
242: ---
243: 
244: ### `auditor-financiero`
245: - **Fase:** 1, 6
246: - **Rol en flujo:** OPCIONAL — Maximización de valor.
247: - **Cuándo invocar:** Valoración del activo, cálculo de ROI y optimización de presupuesto.
248: - **Input clave:** Costos de infraestructura + estimación de horas desarrollo.
249: - **Output:** Reporte de valoración del activo + Análisis de ROI.
250: - **Referencia:** `skills/05-Auditoria-Software/07-Especialista-Financiero/SKILL.md`
251: 
252: ---
253: 
254: ## Tabla de Resumen Rápido

| Skill                | Categoría          | Fase  | OBLIGATORIO | OPCIONAL |
|:---------------------|:-------------------|:-----:|:-----------:|:--------:|
| `brandbook`          | Compliance-Docs    | 1     | ✅          |          |
| `configurador-global`| Core-Orchestrator  | 1,3,6 |             | ✅       |
| `brainstorming-pro`  | Core-Orchestrator  | 2     | ✅          |          |
| `enhance-prompt`     | Optimization-Flow  | 2,4   |             | ✅       |
| `planificacion-pro`  | Core-Orchestrator  | 3     | ✅          |          |
| `creador-de-skills`  | Core-Orchestrator  | 3     |             | ✅       |
| `documentador-tecnico`| Compliance-Docs   | 3,5   | ✅          |          |
| `design-md`          | Builder-Stack      | 4     |             | ✅       |
| `doc-to-app`         | Builder-Stack      | 4     | ✅          |          |
| `header-manager`     | Builder-Stack      | 4     |             | ✅       |
| `react-components`   | Builder-Stack      | 4     |             | ✅       |
| `remotion`           | Builder-Stack      | 4     |             | ✅       |
| `shadcn-ui`          | Builder-Stack      | 4     |             | ✅       |
| `stitch-loop`        | Builder-Stack      | 4     |             | ✅       |
| `compliance-legal`   | Compliance-Docs    | 1,5   |             | ✅       |
| `lider-auditoria`    | Auditoría-Software | ALL   |             | ✅       |
| `auditor-seguridad`  | Auditoría-Software | 5     |             | ✅       |
| `auditor-arquitectura`| Auditoría-Software | 3,4,5 |             | ✅       |
| `auditor-qa`         | Auditoría-Software | 4,5   |             | ✅       |
| `auditor-juridico`   | Auditoría-Software | 1,5   | ✅          |          |
| `auditor-infraestruc`| Auditoría-Software | 5,6   |             | ✅       |
| `auditor-financiero` | Auditoría-Software | 1,6   |             | ✅       |
| `modo-produccion`    | Optimization-Flow  | 5     | ✅          |          |
| `personality_tracker`| Optimization-Flow  | ALL   |             | ✅       |

---

## Cadena de Dependencias

### Cadena OBLIGATORIA (ejecutar en orden)
```
brandbook (F1)
  → brainstorming-pro (F2)
      → planificacion-pro (F3)
          → documentador-tecnico [MODO S] (F3 — inicializa technical/)
              → doc-to-app (F4)
                  → modo-produccion (F5)
```

### Cadenas OPCIONALES (según tipo de proyecto)

**Si se usa Stitch:**
```
design-md → enhance-prompt → stitch-loop
```

**Si el stack es React SPA:**
```
react-components + shadcn-ui
```

**Si se requiere video:**
```
remotion
```

**Si el proyecto comparte el Header Maestro:**
```
header-manager (después de cualquier cambio en Header.jsx)
```

**Si hay datos de usuario:**
```
compliance-legal (F1 al iniciar + F5 en auditoría final)
```
