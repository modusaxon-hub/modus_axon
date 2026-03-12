# 🏗️ TECHNICAL SPEC — Origen Sierra Nevada
## Arquitectura de Sistema y Especificación Técnica

| Atributo | Detalle |
|---|---|
| **Proyecto** | Origen Sierra Nevada SM |
| **ID** | PRJ-OSN-2026 |
| **MODUS AXON Hub** | [modus_axon](../../../) |
| **Arquitecto de IA** | MODUS AXON — Antigravity Agent |
| **Última Actualización** | 2026-03-11 · Sesión III |
| **Versión del Documento** | v2.1.0 |
| **Estado del Proyecto** | 🟢 Activo — Fase de Producción Continua |

---

## 🏛️ Vista General de la Arquitectura

```
┌─────────────────────────────────────────────────────────────┐
│                     CLIENTE (Browser/PWA)                   │
│           React + Vite · TailwindCSS · TypeScript           │
└────────────────────┬────────────────────┬───────────────────┘
                     │                    │
              REST/JS SDK          Edge Functions
                     ↓                    ↓
┌─────────────────────────────────────────────────────────────┐
│                   SUPABASE CLOUD (BaaS)                     │
│  ┌──────────────┐  ┌──────────────┐  ┌───────────────────┐  │
│  │  Auth (JWT)  │  │  PostgreSQL  │  │   Storage (CDN)   │  │
│  │  PKCE + OTP  │  │  Row-Level   │  │  product-images   │  │
│  │              │  │  Security    │  │                   │  │
│  └──────────────┘  └──────────────┘  └───────────────────┘  │
│  ┌──────────────────────────────────────────────────────┐    │
│  │            Edge Functions (Deno / TypeScript)        │    │
│  │  send-welcome-email · manage-users · stock-guard     │    │
│  └──────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────┘
                             │
                      Correo Transaccional
                             ↓
                    ┌─────────────────┐
                    │   BREVO SMTP    │
                    │ (ex-Sendinblue) │
                    └─────────────────┘
```

---

## 📊 Modelo de Datos (ERD Simplificado)

### Tabla: `products`
| Columna | Tipo | Descripción |
|---|---|---|
| `id` | UUID | PK auto-generado |
| `category` | TEXT | `cafetal` \| `accesorios` \| `antojitos` |
| `name` | JSONB | `{es: "", en: ""}` multilingual |
| `description` | JSONB | `{es: "", en: ""}` multilingual |
| `story` | JSONB | Historia del producto `{es, en}` — usada en `HistoriaSection` |
| `traceability` | JSONB | **[NUEVO 11-03-26]** Datos de finca, altitud, proceso `{es, en}` |
| `price` | NUMERIC | Precio base COP |
| `stock` | INTEGER | Stock agregado (auto-sincronizado con variantes) |
| `image_url` | TEXT | URL pública (Supabase Storage) |
| `origin` | TEXT | Origen geográfico (ej: "Sierra Nevada, Magdalena") |
| `available` | BOOLEAN | Calculado automáticamente (trigger DB) |
| `variants` | JSONB | Array de presentaciones con precio, stock y tipo de molienda |
| `intrinsics` | JSONB | Personalidad, carácter, arquetipo, mood |
| `supplier` | JSONB | Datos internos del proveedor (solo panel admin) |
| `color` | TEXT | Color representativo en HEX para el visor |
| `mask_type` | TEXT | `pop` \| `static` — efecto de imagen en el viewer |

### Tabla: `profiles`
| Columna | Tipo | Descripción |
|---|---|---|
| `id` | UUID | FK → `auth.users.id` |
| `role_name` | TEXT | `Administrador` \| `Usuario` \| `Colaborador` \| `Proveedor` |
| `status` | TEXT | `active` \| `pending` \| `banned` \| `deleted` |
| `security_flag` | TEXT | Motivo de restricción ética |

### Tabla: `orders`
| Columna | Tipo | Descripción |
|---|---|---|
| `id` | UUID | PK |
| `user_id` | UUID | FK → `profiles.id` (nullable para guest) |
| `status` | TEXT | `pending` \| `pending_payment` \| `paid` \| `shipped` \| `delivered` |
| `items` | JSONB | Array de líneas de pedido |
| `total_amount` | NUMERIC | Total COP |
| `tracking_code` | TEXT | Código de rastreo único (base62) |

### Tabla: `site_configs`
| Columna | Tipo | Descripción |
|---|---|---|
| `id` | TEXT | PK (ej: `historia`, `fincas`, `testimonios`) |
| `data` | JSONB | Contenido editable del sitio (CMS propio) |

---

## 🔗 Rutas del Frontend (React Router v6)

| Ruta | Componente | Acceso |
|---|---|---|
| `/` | `HomePage` | Público |
| `/login` | `LoginPage` | Público |
| `/register` | `RegisterPage` | Público |
| `/forgot-password` | `ForgotPasswordPage` | Público |
| `/reset-password` | `ResetPasswordPage` | Público |
| `/my-orders` | `MyOrdersPage` | Autenticado |
| `/checkout` | `CheckoutPage` | Autenticado |
| `/track-order` | `TrackOrderPage` | Público |
| `/brewing-guide` | `BrewingGuidePage` | Autenticado |
| `/ai-lab` | `AiLabPage` | Autenticado |
| `/admin` | `AdminDashboard` | Solo Admin |
| `/admin/products` | `ProductManager` | Solo Admin |
| `/admin/orders` | `OrderManager` | Solo Admin |
| `/admin/users` | `UserManager` | Solo Admin |
| `/admin/content` | `SiteContentManager` | Solo Admin |
| `/admin/reports` | `SalesReports` | Solo Admin |
| `/proveedor` | `ProveedorDashboard` | Solo Proveedor |
| `/brandbook` | `Brandbook` | Autenticado |

---

## ⚙️ Edge Functions Desplegadas

| Slug | Propósito | JWT |
|---|---|---|
| `send-welcome-email` | Envío de correo de bienvenida vía BREVO | ✅ |
| `manage-users` | Eliminación hard-delete de usuarios en Auth + Profiles | ✅ |

---

## 🔒 Seguridad: RLS + Triggers

| Mecanismo | Descripción |
|---|---|
| **RLS en `products`** | Solo admins pueden INSERT/UPDATE/DELETE |
| **RLS en `orders`** | Solo el dueño o admin puede ver el pedido |
| **Trigger `validate_order_stock`** | Revierte la transacción si stock insuficiente |
| **JWT verificado** | Todas las Edge Functions requieren token válido |
| **PKCE auth flow** | Flujo seguro de auth con code verifier |

---

## 🛠️ Stack Tecnológico Detallado

| Capa | Tecnología | Versión |
|---|---|---|
| Frontend Framework | React | 18.x |
| Build Tool | Vite | 5.x |
| Lenguaje | TypeScript | 5.x |
| Estilos | TailwindCSS | 3.x |
| Iconos | Lucide React + Material Icons | — |
| Routing | React Router DOM | v6 |
| Estado Global | Context API (Auth, Cart, Language) | — |
| BaaS | Supabase (Auth + DB + Storage + Functions) | — |
| DB | PostgreSQL | 17.6 |
| Correo | Brevo SMTP API | — |
| Despliegue | Local (Vite dev server port 5000) | — |

---

## 📋 Observaciones de Implementación (11-03-2026)

### Historia y Trazabilidad Dinámicas
- Sesión III implementó la lógica de **visualización condicional** de `HistoriaSection` y `MapaOrigenSection`.
- Ahora se muestran **únicamente** cuando la despensa activa es **Cafetal**.
- El contenido cambia **dinámicamente** al navegar entre cafés en el Hero viewer.
- El administrador gestiona estos datos desde `ProductManager` → pestaña "Información Básica" → campo "Historia del Café" + bloque condicional "Trazabilidad" (solo visible para category = cafetal).

### Responsive Design
- `MobileNav` consolidada en una sola barra compacta (eliminado el "Tier 1" con logo grande).
- Formularios auth con `hidden lg:block` para ocultar logo en mobile/tablet.
- `MobileMenuDrawer` ajustado a `pt-[64px]` para alineación correcta.

---
**MODUS AXON** — Cualquier sistema, perfeccionado.
*PRJ-OSN-2026 · v2.1.0 · Bio-Digital Futurism · 2026*
