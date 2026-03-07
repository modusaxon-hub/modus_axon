# 📚 Guía Maestra de Documentación Técnica MODUS AXON
## Estándar de Gestión de Información y Trazabilidad v3.1

Esta guía establece el "Dónde" y el "Cómo" de toda la documentación técnica generada bajo el ecosistema **MODUS AXON**. Este estándar es OBLIGATORIO para todos los proyectos del hub.

---

## 📂 1. Dónde reside la documentación
Cada proyecto DEBE seguir esta estructura de carpetas en su raíz:

```text
/PROJECT_ROOT/
├── /documentation/          # Documentación general y de negocio (Branding, Legal)
└── /technical/              # DOCUMENTACIÓN TÉCNICA PRINCIPAL (CARPETA CLAVE)
    ├── /models/             # Biblioteca de modelos operativos (templates)
    ├── /specs/              # Especificaciones detalladas (Markdown/HTML)
    ├── /diagrams/           # Archivos Mermaid, SVG, PNG
    └── /manuals/            # Manuales de usuario y experto
```

### Reglas de Ubicación:
- **Punto de Entrada**: Todo proyecto debe tener un `README.md` que enlace a `/technical/` y `/documentation/`.
- **Raíz del Proyecto**: Los archivos `AI_LOG_CUMPLIMIENTO.md` y `MANUAL_ENTORNO_LOCAL.md` residen **OBLIGATORIAMENTE** en la raíz del proyecto para visibilidad inmediata de los Agentes y Desarrolladores.

---

## 🛠️ 2. Modelos de Documento (Templates)
Los modelos oficiales están centralizados en nuestra infraestructura central:  
`modus_axon/technical/models/`

El uso de estos modelos asegura:
1. **Identidad Visual**: Consistencia con la marca MODUS AXON.
2. **Trazabilidad Legal**: Cumplimiento automático con leyes colombianas y globales.
3. **Claridad para la IA**: Los agentes pueden leer y actualizar documentos si siguen este formato.

---

## 🚀 3. Protocolo de Generación (Para Agentes)
Cuando inicies un nuevo proyecto o audites uno existente:

1. **Bootstrap**: Crea la carpeta `technical` si no existe.
2. **Initialize**: Copia e inicializa `AI_LOG_CUMPLIMIENTO.md` y `MANUAL_ENTORNO_LOCAL.md` en la raíz.
3. **Audit**: Verifica que `PROJECT_VISION.md` y `TECHNICAL_SPEC.md` existan en `/technical/specs/`.
4. **Publish**: Genera versiones finales en **HTML** usando el `04-HTML_TEMPLATE.html` para entrega al cliente.

---

## 📋 4. Listado de Modelos Disponibles
- `00-AI_LOG_CUMPLIMIENTO.md`: Trazabilidad legal y ética.
- `01-MANUAL_ENTORNO_LOCAL.md`: Guía de despliegue local.
- `02-PROJECT_VISION.md`: Acta de constitución y visión.
- `03-TECHNICAL_SPEC.md`: Arquitectura, DB y API.
- `04-HTML_TEMPLATE.html`: Plantilla visual corporativa (A4 Ready).
- `05-BUILD_PROJECT.html`: Bitácora ejecutiva de **Prompts e Instrucciones del Líder**.
- `06-CONTRATO_TERMINOS_PRIVACIDAD.md`: MSA, T&C y Política de Tratamiento de Datos (Ley 1581).
- `07-PROPUESTA_COMERCIAL_COTIZACION.md`: Cotización, hitos y cronograma comercial.

---
**MODUS AXON** — Cualquier sistema, perfeccionado.
*v3.1.0 · Bio-Digital Futurism · 2026*
