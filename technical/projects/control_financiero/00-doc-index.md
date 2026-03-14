# 📂 ÍNDICE DE DOCUMENTOS — FamilyFlow · Control Financiero Familiar
> **Proyecto:** FamilyFlow  
> **Ruta base:** `modus_axon/technical/projects/control_financiero/`  
> **Estándar:** MODUS AXON Documentation System  
> **Última actualización:** Marzo 2026

---

## Sistema de Nomenclatura

Los documentos de esta carpeta siguen la convención:

```
[ORDEN]-[tipo]-[descripcion].ext
```

| Segmento | Descripción | Ejemplo |
|---|---|---|
| `[ORDEN]` | Número de 2 dígitos, consecutivo según fecha de creación | `01`, `02`, `03` |
| `[tipo]` | Categoría del documento (ver tabla de tipos) | `product-vision`, `technical-spec` |
| `[descripcion]` | Sufijo descriptivo opcional | `mvp`, `sprint1` |
| `.ext` | Extensión del archivo | `.md`, `.txt`, `.sql` |

### Tipos de Documento Reconocidos

| Tipo | Código | Descripción |
|---|---|---|
| Idea / Notas iniciales | `idea` | Apuntes crudos del ideador o PM |
| Visión de Producto | `product-vision` | Propuesta de valor, módulos y roadmap |
| Especificación Técnica | `technical-spec` | User stories, DB schema, endpoints |
| Especificación Legal | `legal-spec` | Términos, privacidad, compliance |
| Diseño UI/UX | `design-spec` | Wireframes, sistema de diseño |
| AI Compliance | `ai-compliance` | Registro de uso de IA en el proyecto |
| Quotation / Propuesta | `quotation` | Propuesta comercial al cliente |
| Manual de Entorno | `env-manual` | Setup del entorno local/producción |

---

## Registro de Documentos

| # | Nombre del Archivo | Tipo | Versión | Fecha de Creación | Estado |
|---|---|---|---|---|---|
| 01 | [idea-de-negocio.txt](./01-idea-de-negocio.txt) | Idea / Notas | — | 2026-03-13 | ✅ Activo |
| 02 | [02-product-vision.md](./02-product-vision.md) | Visión de Producto | v0.2 | 2026-03-13 | ✅ Activo |
| 03 | [03-technical-spec.md](./03-technical-spec.md) | Especificación Técnica | v1.0 | 2026-03-13 | ✅ Activo |
| 04 | [04-design-spec.md](./04-design-spec.md) | Diseño UI/UX | v1.0 | 2026-03-13 | ✅ Activo |
| 05 | [05-brand-identity.html](./05-brand-identity.html) | Identidad de Marca | v1.0 | 2026-03-13 | ✅ Activo |
| 06 | [06-evolved-vision.html](./06-evolved-vision.html) | Visión Estratégica v2.0 | v2.0 | 2026-03-13 | ✅ Activo |
| 07 | [07-local-setup-guide.html](./07-local-setup-guide.html) | Manual de Entorno | v1.0 | 2026-03-13 | ✅ Activo |
| 08 | [08-backend-architecture.html](./08-backend-architecture.html) | Arquitectura Backend | v1.0 | 2026-03-13 | ✅ Activo |
| 09 | [09-ai-compliance-log.html](./09-ai-compliance-log.html) | AI Compliance Log | v1.0 | 2026-03-13 | ✅ Activo |
| 10 | [10-legal-spec.html](./10-legal-spec.html) | Legal & Privacidad | v1.0 | 2026-03-13 | ✅ Activo |
| 11 | [11-commercial-quotation.html](./11-commercial-quotation.html) | Propuesta Comercial | v1.0 | 2026-03-13 | ✅ Activo |

> **Estándar de Documentación:** A partir del documento #05, toda la documentación de calidad (Brand, UI, Manuales) se generará en formatos web (**HTML, CSS, JS**) para garantizar una visualización interactiva y de alta fidelidad, cumpliendo con la nueva regla de **MODUS AXON**.

> **Nota:** El archivo `idea-de-negocio.txt` es el documento semilla (#01) y permanece sin prefijo numérico para conservar su naturaleza de notas de trabajo. Los documentos formales adoptan el prefijo desde `01-`.

---

## Reglas del Sistema de Documentos

1. **Nunca eliminar** un documento del registro; si queda obsoleto, cambiar el estado a `🗄️ Archivado`
2. **Siempre actualizar** el Changelog en el encabezado del documento al modificarlo
3. **El número de orden es permanente**: si se inserta un documento entre dos existentes, se agrega al final con el siguiente número disponible y se anota la referencia lógica
4. **Formatos permitidos:** `.md` para documentación · `.sql` para scripts de base de datos · `.txt` para notas · `.pdf` para versiones finales selladas

---

## Propuesta de Documentos Siguientes

| # Propuesto | Tipo | Descripción | Prioridad |
|---|---|---|---|
| 04 | `design-spec` | Sistema de diseño: paleta de colores, tipografía, componentes Mobile-First | Alta |
| 05 | `legal-spec` | Política de privacidad (Ley 1581/2012 Colombia) y Términos de Uso | Alta |
| 06 | `ai-compliance` | Registro de uso de IA Generativa en el proyecto | Media |
| 07 | `env-manual` | Manual de entorno local: Next.js + Supabase + PWA | Media |
| 08 | `quotation` | Propuesta comercial inicial si el proyecto se desarrolla con cliente | Baja |

---

*Documento generado bajo los estándares de documentación técnica **MODUS AXON** · Uso interno · Todos los derechos reservados*
