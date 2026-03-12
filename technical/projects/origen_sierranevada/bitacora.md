# Bitácora de Proyecto: Origen Sierra Nevada
ID: PRJ-OSN-2026

## Cronología de Documentación

| ID | Fecha | Sesión | Asunto | Referencia |
|----|-------|--------|--------|------------|
| 001 | 2026-03-11 | I | Auditoría Inicial y Hallazgos Críticos | Conversación 9994309e |
| 002 | 2026-03-11 | I | Corrección de Seguridad y Legal | Conversación 9994309e |
| 003 | 2026-03-11 | I | Reestructuración Maestra MODUS AXON | `LOG_INIT` |
| 004 | 2026-03-11 | I | Compliance & Legal Matrix | [OSN-LEG-001](./2026-03-11_ID-004_Compliance-Legal.md) |
| 005 | 2026-03-11 | I | Project Vision Matrix | [OSN-VIS-002](./2026-03-11_ID-005_Project-Vision.md) |
| 006 | 2026-03-11 | I | Technical Spec Matrix | [OSN-TEC-003](./2026-03-11_ID-006_Technical-Spec.md) |
| 007 | 2026-03-11 | I | AI Compliance Log Matrix | [OSN-AI-007](./2026-03-11_ID-007_AI-Compliance.md) |
| 008 | 2026-03-11 | I | Local Environment Manual | [OSN-LOC-008](./2026-03-11_ID-008_Local-Manual.md) |
| 009 | 2026-03-11 | I | Legal Terms & Privacy | [OSN-LEG-009](./2026-03-11_ID-009_Legal-Terms.md) |
| 010 | 2026-03-11 | I | Commercial Proposal | [OSN-COM-010](./2026-03-11_ID-010_Commercial-Proposal.md) |
| 011 | 2026-03-11 | I | Hotfix: Auth Import Error | `FIX_AUTH_IMPORT` |
| 012 | 2026-03-11 | II | Audit Responsivo Mobile/Tablet | MobileNav · Auth Pages · MobileMenuDrawer |
| 013 | 2026-03-11 | II | Refactor MobileNav → barra única compacta | `MobileNav.tsx` · `MobileMenuDrawer.tsx` |
| 014 | 2026-03-11 | II | Fix logo duplicado en Login/Register | `LoginPage.tsx` · `RegisterPage.tsx` |
| 015 | 2026-03-11 | II | Padding corregido en páginas auth | `ForgotPasswordPage.tsx` · `ResetPasswordPage.tsx` |
| 016 | 2026-03-11 | III | Historia & Trazabilidad dinámicas | `HistoriaSection.tsx` · `MapaOrigenSection.tsx` · `HomePage.tsx` |
| 017 | 2026-03-11 | III | Columna `traceability` en Supabase | Migration `add_traceability_to_products` |
| 018 | 2026-03-11 | III | Campos historia/trazabilidad en ProductManager | Solo visibles para categoría `cafetal` |
| 019 | 2026-03-11 | III | Eliminada opción "Todas" del selector de despensa | `ProductManager.tsx` — form de creación |
| 020 | 2026-03-11 | III | Documentación técnica completa actualizada | Docs 005–008 regenerados v2 |

---

## Próximos Pasos (Backlog)

| Prioridad | Tarea |
|---|---|
| 🔴 Alta | Recuperación de contraseña tras 5 intentos fallidos |
| 🔴 Alta | Correo de bienvenida al registrarse (BREVO Site URL) |
| 🟡 Media | Filtro en ProductManager por proveedor, marca, peso, tipo de grano |
| 🟡 Media | Presentaciones: campo "otros" para tipo personalizado |
| 🟡 Media | Catálogo de suscripción (solo para usuarios registrados) |
| 🟡 Media | Guía y catálogo con candado para usuarios no autenticados |
| 🟢 Baja | Imagen con tamaño de tarjeta contenedora en accesorios |
| 🟢 Baja | Panel de proveedores: indicador de tipo de pago (inventario vs. comisión) |

---
*Sincronizado con MODUS AXON Master Flow · Última actualización: 2026-03-11 · Sesión III*
