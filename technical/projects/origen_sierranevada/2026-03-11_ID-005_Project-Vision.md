# 🎯 PROJECT VISION — Origen Sierra Nevada
## MODUS AXON — Acta de Constitución y Visión Estratégica

| Información General | Detalle |
|---|---|
| **Proyecto** | Origen Sierra Nevada SM |
| **ID** | PRJ-OSN-2026 |
| **Líder de Proyecto** | Manuel Pertuz (Pule) |
| **Arquitecto de IA** | MODUS AXON — Antigravity Agent |
| **Fecha de Inicio** | 2026-03-04 |
| **Última Actualización** | 2026-03-11 · Sesión III |
| **Status Actual** | 🟢 Activo — Producción Continua |
| **Versión del Documento** | v2.0.0 |

---

## 🏔️ Declaración de Visión

> *"Transformar la experiencia de compra de café de especialidad colombiano en una vivencia digital de lujo, conectando al consumidor con el origen de cada taza a través de una plataforma e-commerce de alto impacto visual, trazabilidad real y gestión inteligente de inventario."*

---

## 🎯 Objetivos de Negocio

| ID | Objetivo | Indicador de Éxito |
|---|---|---|
| OBJ-01 | Digitalizar el catálogo de Origen Sierra Nevada | 100% de productos disponibles en el visor |
| OBJ-02 | Automatizar el flujo de venta y post-venta | Pedido creado → entregado sin intervención manual |
| OBJ-03 | Transparencia de cadena de valor (trazabilidad) | Historia y datos de finca visibles por producto cafetal |
| OBJ-04 | Gestión multirol (Admin, Proveedor, Cliente) | Paneles diferenciados y funcionales para cada rol |
| OBJ-05 | Cumplimiento normativo colombiano | Facturación, privacidad y taxes implementados |

---

## 🗺️ Alcance del Proyecto

### ✅ Incluido (In-Scope)
- [x] E-commerce de café, accesorios y antojitos con carrito y checkout.
- [x] Visor interactivo de productos (Hero Viewer) con navegación y swipe.
- [x] **Historia y Trazabilidad dinámica** por café activo en el visor.
- [x] Panel de administración: Productos, Pedidos, Usuarios, Contenido, Reportes.
- [x] Panel de proveedores con visualización de ventas.
- [x] Autenticación segura con flujo de aprobación manual de usuarios.
- [x] Control de stock en tiempo real (triggers DB + validación frontend).
- [x] Rastreo de pedidos público sin login.
- [x] Diseño responsivo Mobile/Tablet/Desktop (Bio-Digital Futurism).
- [x] Correo transaccional vía BREVO (bienvenida, recuperación de contraseña).
- [x] CMS propio para historia del sitio, fincas y testimonios.
- [x] Brandbook digital interactivo.

### ❌ Excluido (Out-of-Scope — v1)
- [ ] Integración con pasarela de pagos (PSE/Wompi) — pendiente de contrato.
- [ ] Facturación electrónica DIAN (Fase 2).
- [ ] App móvil nativa (PWA como paso previo).
- [ ] Delivery/logística integrada con operador externo.

---

## 🛠️ Tecnologías Críticas (The DNA)

| Capa | Tecnología |
|---|---|
| **Frontend** | React 18 + Vite 5 + TypeScript 5 + TailwindCSS 3 |
| **Backend** | Supabase (Auth, PostgreSQL, Storage, Edge Functions) |
| **Correo** | Brevo SMTP (ex-Sendinblue) |
| **Control de versiones** | Git + GitHub |
| **Despliegue** | Servidor local (Vite dev server) → Hostin a definir |
| **Diseño** | Bio-Digital Futurism · Paleta: #050806 · #C8AA6E · #141E16 |

---

## ⚠️ Riesgos y Mitigación

| Riesgo | Impacto | Estado | Mitigación |
|---|---|---|---|
| Pasarela de pagos no integrada | Alto | 🟡 Pendiente | Transferencia bancaria manual como interim |
| Facturación DIAN | Alto | 🔴 No iniciado | Programado para Fase 2 |
| SMTP de Brevo en modo prueba | Medio | 🟢 Configurado | BREVO_API_KEY activa en Supabase Secrets |
| Stock inconsistente en carrito | Alto | 🟢 Mitigado | Trigger DB + validación multi-capa |
| Usuarios accediendo sin aprobación | Alto | 🟢 Mitigado | Flujo de estado `pending` → admin aprueba → `active` |

---

## 📅 Hitos Cumplidos

| Fecha | Hito | Responsable |
|---|---|---|
| 2026-03-04 | Creación del proyecto en Supabase | Pule |
| 2026-03-05 | Hero Viewer + Checkout funcional | Antigravity |
| 2026-03-06 | Panel Admin completo (Productos, Pedidos, Usuarios) | Antigravity |
| 2026-03-07 | Brandbook + SiteContentManager | Antigravity |
| 2026-03-08 | Documentación inicial MODUS AXON | Antigravity |
| 2026-03-10 | Migración Resend → BREVO · Hard Delete de usuarios | Antigravity |
| 2026-03-11 | Responsive audit + Historia/Trazabilidad dinámicas | Antigravity |

---
**MODUS AXON** — Cualquier sistema, perfeccionado.
*PRJ-OSN-2026 · v2.0.0 · Bio-Digital Futurism · 2026*
