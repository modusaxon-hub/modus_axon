# 🎨 DESIGN SPEC — FamilyFlow · Sistema de Diseño
> **Documento:** 04-design-spec.md  
> **Versión:** 1.0  
> **Fecha:** Marzo 2026  
> **Autor:** MODUS AXON · UI/UX Design  
> **Referencia:** 02-product-vision.md v0.2 · 03-technical-spec.md v1.0  
> **Clasificación:** Uso interno — Confidencial

---

## 1. ADN VISUAL — *Brand Personality*

| Adjetivo | Significado | Se ve como... |
|---|---|---|
| **Familiar** | Cálido, inclusivo, accesible | Bordes redondeados, íconos amigables, lenguaje cercano |
| **Limpio** | Sin ruido, jerarquía clara | Espaciado generoso, fondos suaves, tipografía legible |
| **Confiable** | Seguro, financiero, profesional | Azules profundos, indicadores numéricos claros, consistencia |

> **Principio rector:** *La app debe sentirse como un asesor financiero de confianza que te habla como un amigo, no como un banco.*

---

## 2. PALETA DE COLORES

### 2.1 Colores Principales

| Rol | Nombre | Hex | HSL | Uso |
|---|---|---|---|---|
| **Primario** | Deep Navy | `#1B2A4A` | `218 46% 20%` | Headers, navegación, CTAs principales |
| **Primario Light** | Slate Blue | `#2D4A7A` | `216 45% 33%` | Hover states, bordes activos |
| **Secundario** | Emerald | `#10B981` | `160 84% 39%` | Ahorro, metas cumplidas, positivo |
| **Secundario Light** | Mint | `#D1FAE5` | `149 80% 90%` | Backgrounds de éxito, badges |
| **Acento Cálido** | Amber | `#F59E0B` | `38 95% 50%` | Alertas, nudges, pendientes |
| **Acento Alerta** | Coral | `#EF4444` | `0 84% 60%` | Gastos altos, deudas, eliminar |

### 2.2 Semánticos

| Estado | Color | Hex | Uso |
|---|---|---|---|
| Éxito | Green 500 | `#22C55E` | Meta alcanzada, pago confirmado |
| Warning | Amber 500 | `#F59E0B` | Vencimiento próximo, suscripción zombie |
| Error | Red 500 | `#EF4444` | Saldo insuficiente, crédito no conv. |
| Info | Blue 400 | `#60A5FA` | Tips, nudges informativos |

### 2.3 Neutros (Modo Claro / Modo Oscuro)

| Rol | Light Mode | Dark Mode | Uso |
|---|---|---|---|
| Background | `#F8FAFC` | `#0F172A` | Fondo de app |
| Surface | `#FFFFFF` | `#1E293B` | Cards, modales |
| Surface Elevated | `#F1F5F9` | `#334155` | Inputs, dropdowns |
| Text Primary | `#0F172A` | `#F1F5F9` | Títulos, valores |
| Text Secondary | `#64748B` | `#94A3B8` | Descripciones, labels |
| Border | `#E2E8F0` | `#334155` | Líneas divisorias |

---

## 3. TIPOGRAFÍA

### Fuentes (Google Fonts)

| Contexto | Font Family | Weights | Fallback |
|---|---|---|---|
| **Headings** | `Outfit` | 500 (Medium), 600 (SemiBold), 700 (Bold) | `system-ui, sans-serif` |
| **Body** | `Inter` | 400 (Regular), 500 (Medium), 600 (SemiBold) | `system-ui, sans-serif` |
| **Monospace** | `JetBrains Mono` | 400 | `monospace` |

### Escala Tipográfica (Mobile → Desktop)

| Token | Mobile | Desktop | Weight | Uso |
|---|---|---|---|---|
| `--text-h1` | 24px / 1.2 | 32px / 1.2 | Outfit 700 | Títulos de página |
| `--text-h2` | 20px / 1.3 | 24px / 1.3 | Outfit 600 | Títulos de sección |
| `--text-h3` | 16px / 1.4 | 18px / 1.4 | Outfit 500 | Subtítulos, card titles |
| `--text-body` | 14px / 1.6 | 16px / 1.6 | Inter 400 | Texto general |
| `--text-sm` | 12px / 1.5 | 14px / 1.5 | Inter 400 | Labels, captions |
| `--text-xs` | 10px / 1.4 | 12px / 1.4 | Inter 500 | Badges, etiquetas |
| `--text-money` | 20px / 1.2 | 28px / 1.2 | Outfit 700 | Valores monetarios |

---

## 4. ESPACIADO Y LAYOUT

### Sistema de Espaciado (4px base)

| Token | Valor | Uso |
|---|---|---|
| `--space-1` | 4px | Gaps mínimos, padding de badges |
| `--space-2` | 8px | Padding interno de inputs |
| `--space-3` | 12px | Gap entre elementos en lista |
| `--space-4` | 16px | Padding de cards, margin de secciones |
| `--space-5` | 20px | Separación de módulos |
| `--space-6` | 24px | Padding lateral de la app |
| `--space-8` | 32px | Separación de secciones principales |
| `--space-10` | 40px | Margin top/bottom de página |
| `--space-12` | 48px | Espaciado vertical grande |

### Breakpoints Mobile-First

| Breakpoint | Valor | Dispositivo | Layout |
|---|---|---|---|
| Base | `0px` | iPhone SE, móviles pequeños | 1 columna + bottom nav |
| `sm` | `640px` | Tablets portrait | 1–2 columnas |
| `lg` | `1024px` | Desktop / Tablets landscape | 2–3 columnas + sidebar |
| `xl` | `1280px` | Desktop grande | Contenido centrado max-width |

### Contenedor Principal

```css
.app-container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 var(--space-6);
}
```

---

## 5. COMPONENTES CORE

### 5.1 Header (React Component: `<AppHeader />`)

```
┌─────────────────────────────────────────────┐
│  [Logo Placeholder]    FamilyFlow     [👤]  │
│  40px height                                │
└─────────────────────────────────────────────┘
```

- **Fondo:** `--color-primary` (Deep Navy)
- **Texto:** blanco `#FFFFFF`
- **Altura:** 56px mobile · 64px desktop
- **Logo:** Espacio reservado a la izquierda (48x48px mobile, 56x56px desktop)
- **Elementos:** Logo placeholder · Nombre de la app · Avatar/iniciales del usuario
- **Sticky:** `position: sticky; top: 0; z-index: 50`
- **Implementación:** Componente React reutilizable `<AppHeader />`

### 5.2 Footer (React Component: `<AppFooter />`)

```
┌─────────────────────────────────────────────┐
│  [Logo]  © 2026 FamilyFlow · MODUS AXON     │
│  Términos · Privacidad · Contacto            │
└─────────────────────────────────────────────┘
```

- **Fondo:** `--color-surface` con borde superior `--color-border`
- **Altura:** Auto, padding `--space-6` vertical
- **Logo:** Espacio reservado (versión reducida)
- **Links:** Términos de uso, Política de privacidad, Contacto
- **Solo visible en:** Páginas de auth, onboarding y configuración (no en la app principal donde hay bottom nav)
- **Implementación:** Componente React reutilizable `<AppFooter />`

### 5.3 Bottom Navigation (React Component: `<BottomNav />`)

```
┌───────┬───────┬───────┬───────┬───────┐
│  🏠   │  📅   │  💸   │  💰   │  📉   │
│ Inicio│Comprom│Gastos │Reserva│Deudas │
└───────┴───────┴───────┴───────┴───────┘
```

- **Solo mobile:** visible hasta `lg` breakpoint
- **Desktop:** se reemplaza por Sidebar lateral
- **Altura:** 64px + safe-area bottom
- **Fondo:** `--color-surface` con `backdrop-filter: blur(12px)`
- **Activo:** ícono + label en `--color-primary`, indicador superior azul
- **Inactivo:** ícono en `--color-text-secondary`

### 5.4 Cards (`<Card />`)

| Variante | Uso | Estilo |
|---|---|---|
| `default` | Contenedor general | Surface + border + shadow-sm |
| `module` | Tarjeta de módulo en dashboard | Surface + ícono grande + gradient sutil |
| `stat` | Indicador numérico | Surface + valor destacado en `--text-money` |
| `nudge` | Sugerencia del motor | Amber/Green/Blue bg suave + ícono + acción |

```css
.card {
  background: var(--color-surface);
  border: 1px solid var(--color-border);
  border-radius: 16px;
  padding: var(--space-4);
  box-shadow: 0 1px 3px rgba(0,0,0,0.06);
  transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
```

### 5.5 Botones (`<Button />`)

| Variante | Estilo |
|---|---|
| `primary` | bg Deep Navy, text white, rounded-xl |
| `secondary` | bg transparent, border Deep Navy, text Deep Navy |
| `success` | bg Emerald, text white |
| `danger` | bg Coral, text white |
| `ghost` | bg transparent, text primary, hover: surface |

```css
.btn {
  font-family: var(--font-body);
  font-weight: 600;
  font-size: 14px;
  padding: 12px 24px;
  border-radius: 12px;
  transition: all 0.2s ease;
  cursor: pointer;
}
```

### 5.6 Modal de Conveniencia de Crédito (`<CreditAnalysisModal />`)

```
┌─────────────────────────────────────┐
│  ❌                                 │
│  📊 Análisis de Conveniencia        │
│                                     │
│  Precio contado      $1,200,000     │
│  Precio a crédito    $1,450,000     │
│  ────────────────────────────────   │
│  Interés total       $250,000 (21%) │
│  Ahorro p/ contado   8 meses       │
│                                     │
│  🟢 Conveniente / 🔴 No conveniente│
│                                     │
│  Impacto en Tranquilidad: 72→ 65   │
│                                     │
│  [Proceder]        [Reconsiderar]   │
└─────────────────────────────────────┘
```

- **Overlay:** `rgba(0,0,0,0.5)` con `backdrop-filter: blur(4px)`
- **Card:** Surface, border-radius 24px, max-width 420px
- **Animación:** Slide-up desde abajo en mobile

### 5.7 Indicador de Tranquilidad (`<TranquilityGauge />`)

- Gauge semicircular (0–100)
- Colores: 0–30 Rojo · 30–60 Ámbar · 60–100 Verde
- Número central grande en `--text-money`
- Etiqueta debajo: "Tu Pulso Financiero"

### 5.8 Nudge Toast (`<NudgeToast />`)

```
┌──────────────────────────────────────┐
│ 💡 Tienes $120K extra este período.  │
│    ¿Los muevo a tu Reserva?          │
│              [Sí, moverlos] [Ahora no]│
└──────────────────────────────────────┘
```

- Aparece desde abajo, sobre el bottom nav
- Auto-dismiss en 10s si no se interactúa
- Máximo 1 visible a la vez

---

## 6. TOKENS CSS — *Variables Globales*

```css
:root {
  /* Colors — Primary */
  --color-primary: #1B2A4A;
  --color-primary-light: #2D4A7A;
  --color-secondary: #10B981;
  --color-secondary-light: #D1FAE5;
  --color-accent-warm: #F59E0B;
  --color-accent-alert: #EF4444;

  /* Colors — Semantic */
  --color-success: #22C55E;
  --color-warning: #F59E0B;
  --color-error: #EF4444;
  --color-info: #60A5FA;

  /* Colors — Neutral (Light Mode) */
  --color-bg: #F8FAFC;
  --color-surface: #FFFFFF;
  --color-surface-elevated: #F1F5F9;
  --color-text: #0F172A;
  --color-text-secondary: #64748B;
  --color-border: #E2E8F0;

  /* Typography */
  --font-heading: 'Outfit', system-ui, sans-serif;
  --font-body: 'Inter', system-ui, sans-serif;
  --font-mono: 'JetBrains Mono', monospace;

  /* Spacing (4px base) */
  --space-1: 4px;
  --space-2: 8px;
  --space-3: 12px;
  --space-4: 16px;
  --space-5: 20px;
  --space-6: 24px;
  --space-8: 32px;
  --space-10: 40px;
  --space-12: 48px;

  /* Radii */
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 24px;
  --radius-full: 9999px;

  /* Shadows */
  --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
  --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
  --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);

  /* Z-Index */
  --z-nav: 40;
  --z-header: 50;
  --z-modal-overlay: 60;
  --z-modal: 70;
  --z-toast: 80;
}

/* Dark Mode */
[data-theme="dark"] {
  --color-bg: #0F172A;
  --color-surface: #1E293B;
  --color-surface-elevated: #334155;
  --color-text: #F1F5F9;
  --color-text-secondary: #94A3B8;
  --color-border: #334155;
}
```

---

## 7. ICONOGRAFÍA

| Módulo | Ícono (Lucide React) | Significado |
|---|---|---|
| Dashboard | `LayoutDashboard` | Vista general |
| Compromisos Fijos | `CalendarClock` | Gastos recurrentes en el tiempo |
| Gastos Esporádicos | `Receipt` | Comprobante de gasto |
| Mi Reserva | `PiggyBank` | Alcancía, ahorro |
| Deudas | `TrendingDown` | Disminución de deuda |
| Familia | `Users` | Grupo familiar |
| Configuración | `Settings` | Ajustes |
| Nudge | `Lightbulb` | Idea, sugerencia |

> **Librería:** `lucide-react` — íconos outline consistentes, 24px base, stroke-width 1.75

---

## 8. ANIMACIONES Y MICRO-INTERACCIONES

| Interacción | Duración | Easing | Detalle |
|---|---|---|---|
| Hover en card | 150ms | `ease` | `translateY(-2px)` + shadow |
| Transición de ruta | 200ms | `ease-in-out` | Fade + slide lateral |
| Modal entrada | 300ms | `cubic-bezier(0.16,1,0.3,1)` | Slide-up + fade overlay |
| Nudge toast | 400ms | `spring` | Slide-up desde bottom nav |
| Barra de progreso meta | 600ms | `ease-out` | Grow desde left |
| Indicador tranquilidad | 800ms | `ease-out` | Needle sweep animado |

---

*Documento generado bajo los estándares de documentación técnica **MODUS AXON** · Uso interno · Todos los derechos reservados*
