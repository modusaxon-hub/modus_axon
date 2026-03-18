# 🛡️ AI Compliance & Decision Log
## MODUS AXON — Protocolo de Trazabilidad Ética y Legal

| Atributo | Detalle |
|---|---|
| **Proyecto** | Origen Sierra Nevada SM |
| **ID** | PRJ-OSN-2026 |
| **Versión de Protocolo** | v3.3.0 |
| **Jurisdicción Principal** | Colombia (Ley 1581 de 2012) |
| **Cumplimiento Global** | GDPR (UE), MinTIC Res. 1519/2020 |
| **Última Actualización** | 2026-03-17 · Sesión II |

---

## 📝 Registro de Decisiones de Arquitectura e IA

### Historial de Trazabilidad

| Build ID | Fecha | Instrucción del Líder | Acción de la IA | Justificación |
|---|---|---|---|---|
| `OSN-AI-001` | 2026-03-04 | "Inicializar proyecto de e-commerce de café" | Creación de estructura React + Vite + Supabase | Stack estándar MODUS AXON para e-commerce |
| `OSN-AI-002` | 2026-03-05 | "Implementar Hero Viewer y Checkout" | Visor multi-categoría + carrito + validación stock | Requisito de core de negocio |
| `OSN-AI-003` | 2026-03-06 | "Crear panel administrativo completo" | ProductManager, OrderManager, UserManager | Gestión operativa del negocio |
| `OSN-AI-004` | 2026-03-09 | "Resolver flasheo y errores de rendimiento" | Lazy loading, paginación, optimización de queries | Impacto directo en UX y retención |
| `OSN-AI-005` | 2026-03-10 | "Migrar correo a BREVO y gestión de usuarios" | Edge Function manage-users + BREVO SMTP | Resend no disponible para producción en Colombia |
| `OSN-AI-006` | 2026-03-10 | "Implementar estados de pedido y modales" | Flujo pending → paid → shipped → delivered + modales institucionales | Estándar de UX y comunicación institucional |
| `OSN-AI-007` | 2026-03-11 | "Audit responsivo mobile/tablet" | Refactor MobileNav + padding auth pages + logo deduplication | Accesibilidad y UX en dispositivos móviles |
| `OSN-AI-008` | 2026-03-11 | "Historia y Trazabilidad dinámicas por café activo" | Columna `traceability` en DB + props en HistoriaSection/MapaOrigenSection + campos en ProductManager | Requisito de diferenciación de marca y trazabilidad real de origen |
| `OSN-AI-009` | 2026-03-17 | "Optimizar carga de productos y variantes" | Refactor `getAllProducts` a query única con JOIN | Reducción de latencia N+1 (Critical UX Path) |
| `OSN-AI-010` | 2026-03-17 | "Resolver bloqueo de spinner inicial (Auth)" | Init explícito de sesión + Fail-safe timeout 4.5s | Prevención de abandono por carga lenta vía túneles |
| `OSN-AI-011` | 2026-03-17 | "Corregir errores de hidratación y red 406" | Refactor Logo (avoid nested links) + Init `site_configs` | Calidad de SEO, UX y estabilidad de red |
| `OSN-AI-012` | 2026-03-17 | "No puedo cerrar sesión, la sesión persiste" | Refactor completo de signOut: listener-first, Promise.race timeout, limpieza storage, hard reload en 8 componentes | Race condition entre Web Lock de Supabase y listener que restauraba sesión |
| `OSN-AI-013` | 2026-03-17 | "Eliminar AbortError: Lock broken by 'steal'" | AuthContext usa solo `onAuthStateChange` (eliminar `getSession()` separado) | Web Lock contention entre dos operaciones auth simultáneas |
| `OSN-AI-014` | 2026-03-17 | "Factura redirige a login desde panel admin" | InvoicePage con polling de sesión (8s), sin auto-redirect + Modal inline en OrderManager | Nueva pestaña no hereda auth state inmediatamente |
| `OSN-AI-015` | 2026-03-17 | "Quitar S.A.S. del nombre en factura" | InvoicePrototype: "ORIGEN SIERRA NEVADA" | Corrección de razón social por indicación del líder |

---

## ⚖️ Marco de Cumplimiento

### 1. Protección de Datos — Ley 1581/2012 · GDPR

| Control | Estado | Evidencia |
|---|---|---|
| Anonimización de logs | ✅ | No se loguean passwords ni tokens en consola |
| Enmascaramiento de datos sensibles | ✅ | Campos de seguridad visibles solo para rol Admin |
| Consentimiento en registro | ✅ | Checkbox de T&C en `RegisterPage` |
| Política de Privacidad publicada | ✅ | Ruta `/privacy` con `PrivacyPolicyPage` |
| Eliminación de datos (Hard Delete) | ✅ | Edge Function `manage-users` elimina de Auth + Profiles |
| RLS (Row Level Security) | ✅ | Activado en tablas `products`, `orders`, `profiles` |

### 2. Facturación e Impuestos — DIAN

| Control | Estado | Nota |
|---|---|---|
| Cálculo de IVA | ⚠️ Pendiente | Previsto para Fase 2 (integración DIAN) |
| Tiquete POS electrónico | ⚠️ Pendiente | Requiere proveedor certificado DIAN |
| Trazabilidad de transacciones | ✅ | Cada orden tiene `id` UUID + `tracking_code` único |

### 3. Accesibilidad — Res. 1519/2020 MinTIC / WCAG 2.1

| Control | Estado | Nota |
|---|---|---|
| Contraste de color | ✅ | Paleta oscura con texto claro → ratio > 4.5:1 |
| Estructura semántica | ✅ | `<h1>` único por página, uso correcto de landmarks |
| Diseño responsivo | ✅ | Mobile-first, audit completado 11-03-2026 |
| Textos alternativos | ⚠️ Parcial | Imágenes de producto requieren `alt` descriptivos |

### 4. Seguridad — OWASP Top 10

| Control | Estado | Implementación |
|---|---|---|
| Inyección SQL | ✅ | Supabase SDK usa parámetros tipados (Typed Client) |
| Autenticación rota | ✅ | JWT PKCE + verificación de JWT en Edge Functions |
| Exposición de datos sensibles | ✅ | Datos de proveedor solo cargados en contexto Admin |
| Control de acceso | ✅ | RBAC por `role_name` en `profiles` + RLS en DB |
| Throttling de login | ✅ | Hook `useSubmitThrottle` en páginas de auth |

---

## 🔒 Auditoría de Seguridad — 2026-03-11

| Hallazgo | Severidad | Estado |
|---|---|---|
| Usuarios `banned` no aparecían en lista de pendientes | Media | ✅ Corregido (Filtro por `status = pending`) |
| Hard delete dejaba usuarios en `auth.users` | Alta | ✅ Corregido (Edge Function elimina de Auth + DB) |
| Stock no se validaba en tiempo real en checkout | Alta | ✅ Corregido (Trigger DB + validación multi-capa) |
| Logo duplicado en MobileNav | Baja | ✅ Corregido (Refactor a barra única) |
| Errores 406 (Not Acceptable) en config inicial | Baja | ✅ Corregido (Poblado de `site_configs` en Supabase) |
| Spinner inicial bloqueado por Auth Latency | Alta | ✅ Corregido (Async Fast-Init + Timeout fail-safe) |
| Hydration Error: `<a>` descendant of `<a>` | Media | ✅ Corregido (Refactor semántico de Componente Logo) |
| AbortError: Web Lock contention en auth | Alta | ✅ Corregido (Solo `onAuthStateChange`, sin `getSession()`) |
| signOut() no cierra sesión (listener restaura) | Crítica | ✅ Corregido (Listener-first teardown + Promise.race 2s + hard reload) |
| `window.location.href` no recarga con HashRouter | Alta | ✅ Corregido (`window.location.reload()` en 8 componentes) |
| Factura redirige a login en nueva pestaña | Alta | ✅ Corregido (Polling de sesión 8s + modal inline) |
| CSP bloquea WebSocket Supabase Realtime | Media | ✅ Corregido (`wss://*.supabase.co` en connect-src) |

---
**MODUS AXON** — Cualquier sistema, perfeccionado.
*PRJ-OSN-2026 · v3.4.0 · Bio-Digital Futurism · 2026*
