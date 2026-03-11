# Plan de Implementación: Módulo de Auditoría de Software

Este plan organiza la creación del equipo especializado de auditoría de software, asegurando cumplimiento legal y transversalidad en el asesoramiento técnico.

## User Review Required

> [!IMPORTANT]
> Se creará una nueva categoría `05-Auditoria-Software` en la carpeta `skills`.
> Se integrará un **Especialista Financiero** como nueva especialidad.
> Los agentes tendrán un rol dual: Auditoría (control) y Asesoría (acompañamiento en construcción).

## Proposed Changes

### [Component] Agentes de Auditoría (skills/05-Auditoria-Software)

#### [NEW] Carpeta y subcarpetas para especialidades
- `skills/05-Auditoria-Software/01-Lider-Auditoria/SKILL.md`
- `skills/05-Auditoria-Software/02-Auditor-Seguridad/SKILL.md`
- `skills/05-Auditoria-Software/03-Arquitecto-Software/SKILL.md`
- `skills/05-Auditoria-Software/04-Especialista-QA/SKILL.md`
- `skills/05-Auditoria-Software/05-Auditor-Juridico-Compliance/SKILL.md`
- `skills/05-Auditoria-Software/06-Especialista-Infraestructura/SKILL.md`
- `skills/05-Auditoria-Software/07-Especialista-Financiero/SKILL.md`

#### [MODIFY] [SKILL-INDEX.md](file:///d:/Documentos/Proyectos%20ADSO/agent/SKILL-INDEX.md)
- Añadir la nueva categoría 05 y sus skills al índice global.

## Verification Plan

### Automated Tests
- Verificar la existencia de todos los archivos `SKILL.md`.
- Validar que no haya enlaces rotos en el [SKILL-INDEX.md](file:///d:/Documentos/Proyectos%20ADSO/agent/SKILL-INDEX.md).

### Manual Verification
- Revisar que cada `SKILL.md` contenga la sección de "Asesoría en Construcción".
- Confirmar que la investigación de NotebookLM se haya integrado en el Auditor Jurídico.
