---
name: creador-de-skills
description: Experto en diseñar Skills predecibles, reutilizables y estructurados para el entorno de Antigravity. Define rutas, lógica y reglas de ejecución.
---

# Creador de Skills para Antigravity

## Cuándo usar este skill
- Cuando el usuario pida crear un skill nuevo.
- Cuando el usuario pida automatizar o sistematizar un proceso repetitivo.
- Cuando se necesite un estándar de formato para tareas específicas.
- Cuando haya que convertir un prompt largo o complejo en un procedimiento ejecutable y reutilizable.

## Inputs necesarios
- **Propósito**: Qué debe lograr el skill.
- **Nombre**: Nombre sugerido o palabras clave.
- **Contexto**: Entorno donde se aplicará (frontend, backend, diseño, etc.).
- **Nivel de Libertad**: Alta (heurísticas), Media (plantillas) o Baja (pasos exactos).

## Workflow
### Fase 1: Planificación y Contexto
1. Definir el nombre técnico del skill (minúsculas, guiones, máx 40 caracteres).
2. **Contexto del Proyecto**: El skill debe ser capaz de operar en cualquier proyecto.
   - **Regla de Bootstrapping**: Instruye al agente para que verifique si existe `.agent/skills/<nombre-del-skill>/` en el proyecto objetivo. Si no existe, debe crearlo antes de guardar archivos.

### Fase 2: Estructura del Content (SKILL.md)
1. Generar **Frontmatter YAML** con `name` y `description` operativa.
2. Definir **Triggers** claros de activación.
3. Listar **Inputs** críticos.
4. Diseñar el **Workflow** agnóstico (usar `{{ProjectName}}` en lugar de nombres fijos).
5. Especificar el **Output** exacto.

### Fase 3: Validación y Creación
1. Revisar que no haya "marketing" o relleno innecesario.
2. Evitar hardcodear marcas (ej. "Origen Sierra Nevada"). Usar variables o "Marca del Proyecto".
3. Verificar la consistencia de las instrucciones.

## Checklist de Calidad
- [ ] ¿El nombre es corto y descriptivo?
- [ ] ¿La descripción está en español y tercera persona?
- [ ] ¿El workflow es ejecutable sin ambigüedades?
- [ ] ¿Se especificó el formato de salida exacto?
- [ ] ¿Se incluyó la regla de **Bootstrapping** (crear carpeta si falta)?
- [ ] ¿Es agnóstico al proyecto (sin marcas hardcodeadas)?
- [ ] ¿Se incluyó el estándar de documentación imprimible (HTML A4) si aplica?

## Estándar Global de Documentación (A4 Printing)
Si el skill genera documentos para el usuario final (informes, planes, diagramas, manuales):
- Debe entregar un **HTML Autocontenido** con CSS embebido.
- Debe optimizarse para impresión **A4** (`@media print`).
- **Branding Dinámico**: No usar colores fijos de una sola marca. Permitir que el agente detecte o pregunte por los colores del proyecto (ej. `var(--brand-color)`).

## Instrucciones y Reglas
1. **Sin Relleno**: El skill es un manual de ejecución, no un artículo de blog.
2. **Bootstrapping**: Siempre incluye el paso: "Verificar existencia de directorios en el proyecto destino".
3. **Salida Estandarizada**: Define siempre qué formato devuelve el skill (tabla, JSON, markdown, etc.).
4. **Manejo de Errores**: Si el usuario no proporciona inputs críticos, el skill debe preguntar antes de proceder.

## Output (Formato de Respuesta)
Al crear un skill, la respuesta debe seguir esta estructura:

### Carpeta
`agent/skills/<nombre-del-skill>/` (Crear si no existe en el proyecto objetivo)

### SKILL.md
```markdown
---
name: <nombre-del-skill>
description: <descripción breve>
---
# <Título del Skill>
## Cuándo usar este skill
...
## Inputs necesarios
...
## Workflow
...
## Instrucciones
...
## Output (formato exacto)
...
```

### Recursos (si aplica)
- `recursos/<archivo>.md`
- `scripts/<archivo>.sh`
