# 🏗️ TECHNICAL SPEC — Origen Sierra Nevada
## Arquitectura de Sistema y Especificación Técnica

| Atributo | Detalle |
|---|---|
| **Proyecto** | Origen Sierra Nevada SM |
| **ID** | PRJ-OSN-2026 |
| **MODUS AXON Hub** | [modus_axon](../../../) |
| **Arquitecto de IA** | MODUS AXON — Antigravity Agent |
| **Última Actualización** | 2026-03-17 · Sesión II |
| **Versión del Documento** | v2.3.0 |
| **Estado del Proyecto** | 🟢 Activo — Estabilización Auth + Facturación |

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
| `/invoice/:orderId` | `InvoicePage` | Autenticado (polling sesión) |
| `/catalog` | `CatalogPage` | Público |
| `/contact` | `ContactPage` | Público |
| `/terms` | `TermsPage` | Público |
| `/subscription` | `SubscriptionPage` | Autenticado |

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
| **RLS en `invoices`** | `view_own_invoices` (owner) + `admin_all_invoices` (admin full access) |
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

## 📋 Observaciones de Implementación (17-03-2026)

### Optimización de Performance (Data Fetching)
- **N+1 Query Resolution**: Se refactorizó `productService.ts` para cargar productos y variantes en una sola transacción mediante un `JOIN` de Supabase (`select('*, variants:product_variants(*)')`).
- **Auth Boot Optimization**: Implementado `initAuth` paralelo al listener de Supabase para reducir el tiempo de bloqueo inicial. 
- **Fail-safe Loading**: Añadido temporizador de seguridad de 5s en `HomePage` y 4.5s en `AuthContext` para forzar la visualización del contenido en condiciones de alta latencia (túneles remotos).

### Calidad de Código y SEO
- **Hydration Error Fix**: El componente `Logo` fue refactorizado para aceptar una prop `asDiv`, eliminando la anidación de etiquetas `<a>` detectada en `Header` y `Footer`.
- **Network Stability**: Inicialización manual de la tabla `site_configs` para evitar errores 406 al consultar `testimonios` y `fincas`.

---

## 📋 Observaciones de Implementación (17-03-2026 · Sesión II)

### Estabilización de Autenticación (Critical Fix)
- **Web Lock Contention Eliminada**: `AuthContext` refactorizado para usar **exclusivamente** `onAuthStateChange` como fuente de verdad. Se eliminó la llamada separada a `getSession()` que causaba `AbortError: Lock broken by another request with the 'steal' option`.
- **signOut() Robusto**: Nuevo flujo de cierre de sesión en 5 pasos:
  1. Desuscribir auth listener **primero** (previene restauración de sesión)
  2. Remover suscripción de perfil Realtime
  3. `supabase.auth.signOut()` con `Promise.race` timeout de 2s (previene hang por Web Lock)
  4. Limpieza manual de `localStorage` + `sessionStorage` (claves `sb-*`, `supabase*`, `auth*`)
  5. Reset de estado React
- **Hard Reload Universal**: Los 8 componentes con logout (`AdminHeader`, `UserDropdown`, `MobileMenuDrawer`, `ProtectedRoute`, `AdminDashboard`, `Brandbook`, `ProveedorDashboard`, `UserDashboard`) ahora usan `window.location.reload()` para destruir completamente el árbol React y prevenir restauración de sesión en memoria.

### Facturación Electrónica
- **Modal Inline**: La factura ahora se abre en un modal overlay dentro de `OrderManager` en lugar de una nueva pestaña. Usa `InvoicePrototype` directamente con datos cargados via Supabase.
- **InvoicePage Resiliente**: Para acceso directo por URL (`/#/invoice/:orderId`), la página ahora hace polling de sesión cada 500ms hasta 8s (tolerante a latencia de nueva pestaña) sin redirigir a login.
- **Razón Social Corregida**: Factura muestra "ORIGEN SIERRA NEVADA" (sin S.A.S.).
- **RLS Verificado**: Tabla `invoices` tiene políticas `view_own_invoices` (owner) y `admin_all_invoices` (admin) correctamente configuradas.

### CSP (Content Security Policy)
- `wss://*.supabase.co` agregado a `connect-src` para permitir WebSocket de Supabase Realtime.
- `https://generativelanguage.googleapis.com` agregado para Google Gemini AI (ChatWidget).

---
**MODUS AXON** — Cualquier sistema, perfeccionado.
*PRJ-OSN-2026 · v2.3.0 · Bio-Digital Futurism · 2026*
