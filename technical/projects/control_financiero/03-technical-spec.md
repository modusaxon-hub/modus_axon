# 📋 TECHNICAL SPECIFICATION — FamilyFlow
> **Documento:** 02-technical-spec.md  
> **Versión:** 1.0 — MVP Sprint Planning  
> **Fecha:** Marzo 2026  
> **Autor:** MODUS AXON · Product Management  
> **Referencia:** 01-product-vision.md v0.2  
> **Clasificación:** Uso interno — Confidencial

---

## 1. ALCANCE DEL DOCUMENTO

Este documento traduce la visión del producto (Product Vision v0.2) en especificaciones técnicas accionables para el equipo de desarrollo. Cubre la **Fase 1 – MVP**, con User Stories, esquema de base de datos, endpoints/Server Actions, flujos de navegación y criterios de aceptación.

---

## 2. CONFIGURACIÓN DE CUENTA — *Onboarding Flow*

### US-001: Registro y Selección de Modo de Cuenta

**Como** usuario nuevo,  
**Quiero** registrarme y elegir si mi cuenta es Individual o Familiar,  
**Para** que la app se adapte a mi estructura de hogar desde el inicio.

**Criterios de Aceptación:**
- [ ] El formulario de registro solicita: nombre, email, contraseña y foto de perfil (opcional)
- [ ] Tras verificar el email, se muestra un **onboarding de 3 pasos**:
  1. Selección de modo: **Individual** / **Familiar**
  2. Si Familiar: invitar miembros por email o generar código QR de enlace
  3. Configuración inicial: ingresos del hogar y fecha de corte de presupuesto
- [ ] El modo puede cambiarse después desde Configuración

---

### US-002: Gestión de Miembros del Hogar (Modo Familiar)

**Como** administrador de la cuenta familiar,  
**Quiero** agregar miembros, asignarles roles y definir su % de aporte al fondo común,  
**Para** tener un control transparente de quién aporta qué al presupuesto familiar.

**Criterios de Aceptación:**
- [ ] El administrador puede invitar hasta 6 miembros en el MVP
- [ ] Roles disponibles: `admin` (1 por familia) · `miembro` · `visualizador` (solo lectura)
- [ ] Cada miembro configura su aporte: porcentaje fijo (ej: 40% de ingreso) o monto fijo mensual
- [ ] El miembro puede marcar su información financiera como **privada** (no visible para otros miembros, solo para el admin)

---

## 3. USER STORIES POR MÓDULO

### 📅 Compromisos Fijos

#### US-003: Registrar Gasto Recurrente
**Como** usuario,  
**Quiero** registrar un gasto que se repite mensualmente (arriendo, servicios públicos),  
**Para** verlo reflejado automáticamente en mi presupuesto cada mes.

**Criterios de Aceptación:**
- [ ] Campos: descripción, categoría, valor, día de vencimiento, frecuencia (mensual/bimensual/anual)
- [ ] El gasto recurrente se crea como plantilla y genera instancias automáticas
- [ ] Si el vencimiento es en los próximos 5 días y el saldo es suficiente → Nudge de recordatorio

#### US-004: Análisis de Conveniencia de Crédito (Modal)
**Como** usuario que va a comprar algo a cuotas,  
**Quiero** ver un análisis financiero antes de comprometer el crédito,  
**Para** tomar una decisión informada sobre si conviene o no financiar.

**Criterios de Aceptación:**
- [ ] Al activar "Es a cuotas" en un registro, se despliega un **modal de análisis** con:
  - Precio de contado vs. precio total a crédito
  - Interés total pagado (en pesos y en porcentaje)
  - Tiempo estimado para ahorrar y pagarlo de contado
  - Ventajas y desventajas de cada opción
  - Veredicto visual: 🟢 Conveniente / 🔴 No conveniente (basado en ratio cuota/ingreso)
- [ ] El modal muestra el impacto en el "Indicador de Tranquilidad"

---

### 💸 Panel de Gastos Esporádicos

#### US-005: Registrar Gasto Esporádico
**Como** usuario,  
**Quiero** registrar gastos que no son periódicos (regalo, reparación del carro, cena especial),  
**Para** que no distorsionen mi presupuesto mensual base pero sí aparezcan en mis estadísticas reales.

**Criterios de Aceptación:**
- [ ] Campos: descripción, categoría, valor, fecha, tipo (`individual` / `familiar`)
- [ ] Si `tipo = familiar`: el sistema pregunta si se prorratea entre todos los miembros o lo asume un miembro específico
- [ ] Los gastos esporádicos tienen su propia vista/sección separada del dashboard de compromisos fijos

#### US-006: Registrar y Evaluar Suscripción de IA / Herramienta Digital
**Como** usuario de herramientas digitales,  
**Quiero** registrar mis suscripciones a servicios como ChatGPT, Canva o Adobe,  
**Para** saber cuánto gasto mensualmente y si las estoy aprovechando.

**Criterios de Aceptación:**
- [ ] Campos: nombre del servicio, proveedor, plan (mensual/anual), monto, fecha de facturación, último uso
- [ ] El sistema normaliza el costo anual a mensual para comparaciones justas
- [ ] Si `último uso` no se actualiza en 30 días → Nudge de suscripción zombie
- [ ] Vista de resumen: total mensual en herramientas digitales y % del ingreso que representa

---

### 💰 Mi Reserva de Tranquilidad

#### US-007: Crear Meta de Ahorro (Individual o Compartida)
**Como** usuario (o familia),  
**Quiero** crear una meta de ahorro con nombre, monto objetivo y fecha límite,  
**Para** visualizar mi progreso y recibir sugerencias de aporte sin romper el presupuesto.

**Criterios de Aceptación:**
- [ ] Tipos de meta: `individual` (solo el usuario) / `compartida` (seleccionar participantes del hogar)
- [ ] Si la meta es compartida, cada participante ve su aporte proyectado y el progreso colectivo en tiempo real
- [ ] La app calcula el aporte mensual mínimo necesario para alcanzar la meta en la fecha definida
- [ ] Ejemplos de metas con sugerencias predefinidas: Fondo de emergencia · Viaje · Electrodoméstico · Vehículo

---

### 📉 Plan de Desendeudamiento

#### US-008: Registrar Crédito Activo y Ver Amortización
**Como** usuario con deudas activas,  
**Quiero** registrar mis créditos y ver cuánto de mi cuota va a capital vs. intereses,  
**Para** entender el costo real de mis deudas y planear pagos extraordinarios.

**Criterios de Aceptación:**
- [ ] Campos: tipo de crédito (libre inversión/hipotecario/educativo/tarjeta), entidad, saldo capital, tasa EA, plazo restante, cuota mensual
- [ ] El sistema genera la tabla de amortización completa mes a mes
- [ ] Simulador: "¿Qué pasa si abono $X extra este mes?" → muestra reducción en plazo e intereses
- [ ] Vista: estrategia Bola de Nieve vs. Avalancha con comparativa de fechas de liquidación

---

## 4. ESQUEMA DE BASE DE DATOS — *PostgreSQL / Supabase*

```sql
-- =============================================
-- TABLA: familias
-- =============================================
CREATE TABLE familias (
  id            UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  nombre        TEXT NOT NULL,
  tipo_cuenta   TEXT NOT NULL CHECK (tipo_cuenta IN ('individual', 'familiar')),
  codigo_invite TEXT UNIQUE,                   -- código QR para unirse
  created_at    TIMESTAMPTZ DEFAULT NOW()
);

-- =============================================
-- TABLA: miembros_familia
-- =============================================
CREATE TABLE miembros_familia (
  id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  familia_id      UUID REFERENCES familias(id) ON DELETE CASCADE,
  usuario_id      UUID REFERENCES auth.users(id) ON DELETE CASCADE,
  rol             TEXT NOT NULL CHECK (rol IN ('admin', 'miembro', 'visualizador')),
  aporte_tipo     TEXT CHECK (aporte_tipo IN ('porcentaje', 'monto_fijo')),
  aporte_valor    NUMERIC(12,2),               -- % o monto según aporte_tipo
  datos_privados  BOOLEAN DEFAULT FALSE,       -- ocultar balance al resto de la familia
  created_at      TIMESTAMPTZ DEFAULT NOW(),
  UNIQUE (familia_id, usuario_id)
);

-- =============================================
-- TABLA: gastos
-- =============================================
CREATE TABLE gastos (
  id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  familia_id      UUID REFERENCES familias(id),
  miembro_id      UUID REFERENCES miembros_familia(id),   -- quién registró
  descripcion     TEXT NOT NULL,
  categoria       TEXT NOT NULL,
  monto           NUMERIC(12,2) NOT NULL,
  fecha           DATE NOT NULL,
  tipo_gasto      TEXT NOT NULL CHECK (tipo_gasto IN ('recurrente', 'esporadico', 'credito')),
  ambito          TEXT CHECK (ambito IN ('individual', 'familiar')),
  es_cuota        BOOLEAN DEFAULT FALSE,
  num_cuotas      INT,
  valor_cuota     NUMERIC(12,2),
  valor_contado   NUMERIC(12,2),
  created_at      TIMESTAMPTZ DEFAULT NOW()
);

-- =============================================
-- TABLA: suscripciones_ia
-- =============================================
CREATE TABLE suscripciones_ia (
  id                UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  miembro_id        UUID REFERENCES miembros_familia(id),
  nombre_plan       TEXT NOT NULL,
  proveedor         TEXT NOT NULL,              -- ChatGPT, Canva, Adobe, Notion...
  tipo_plan         TEXT CHECK (tipo_plan IN ('mensual', 'anual')),
  monto             NUMERIC(12,2) NOT NULL,
  fecha_facturacion DATE,
  ultima_fecha_uso  DATE,                       -- para el detector zombie
  activa            BOOLEAN DEFAULT TRUE,
  created_at        TIMESTAMPTZ DEFAULT NOW()
);

-- =============================================
-- TABLA: metas
-- =============================================
CREATE TABLE metas (
  id               UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  familia_id       UUID REFERENCES familias(id),
  nombre           TEXT NOT NULL,
  descripcion      TEXT,
  monto_objetivo   NUMERIC(12,2) NOT NULL,
  progreso_actual  NUMERIC(12,2) DEFAULT 0,
  fecha_limite     DATE,
  tipo_meta        TEXT CHECK (tipo_meta IN ('individual', 'compartida')),
  participantes    UUID[],                      -- array de miembro_ids
  created_at       TIMESTAMPTZ DEFAULT NOW()
);

-- =============================================
-- TABLA: creditos
-- =============================================
CREATE TABLE creditos (
  id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  familia_id      UUID REFERENCES familias(id),
  tipo            TEXT CHECK (tipo IN ('libre_inversion', 'hipotecario', 'educativo', 'tarjeta')),
  entidad         TEXT NOT NULL,
  saldo_capital   NUMERIC(14,2) NOT NULL,
  tasa_ea         NUMERIC(6,4) NOT NULL,        -- tasa efectiva anual
  plazo_meses     INT NOT NULL,
  cuota_mensual   NUMERIC(12,2) NOT NULL,
  fecha_inicio    DATE,
  fecha_fin       DATE,
  activo          BOOLEAN DEFAULT TRUE,
  created_at      TIMESTAMPTZ DEFAULT NOW()
);

-- =============================================
-- TABLA: alertas_precio  (Fase 2)
-- =============================================
CREATE TABLE alertas_precio (
  id              UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  producto_id     UUID,                         -- referencia a tabla productos (Fase 2)
  precio_actual   NUMERIC(10,2),
  precio_ref      NUMERIC(10,2),
  tienda          TEXT,
  porcentaje_var  NUMERIC(5,2),                 -- variación % respecto al precio referencia
  fecha_deteccion TIMESTAMPTZ DEFAULT NOW()
);

-- =============================================
-- TABLA: nudge_log  (trazabilidad del motor)
-- =============================================
CREATE TABLE nudge_log (
  id            UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  familia_id    UUID REFERENCES familias(id),
  miembro_id    UUID REFERENCES miembros_familia(id),
  tipo_nudge    TEXT CHECK (tipo_nudge IN ('ahorro', 'precio', 'limpieza', 'pago', 'celebracion')),
  mensaje       TEXT,
  aceptado      BOOLEAN,                        -- NULL = no respondido
  enviado_at    TIMESTAMPTZ DEFAULT NOW()
);

-- Row Level Security: cada familia solo ve sus propios datos
ALTER TABLE familias ENABLE ROW LEVEL SECURITY;
ALTER TABLE gastos ENABLE ROW LEVEL SECURITY;
ALTER TABLE metas ENABLE ROW LEVEL SECURITY;
ALTER TABLE creditos ENABLE ROW LEVEL SECURITY;
ALTER TABLE suscripciones_ia ENABLE ROW LEVEL SECURITY;
```

---

## 5. SERVER ACTIONS / ENDPOINTS — *Next.js App Router*

| Módulo | Action / Route | Descripción |
|---|---|---|
| Auth | `POST /api/auth/register` | Registro + envío de email de verificación |
| Auth | `POST /api/auth/onboarding` | Guarda modo Individual/Familiar y datos iniciales |
| Familia | `POST /actions/familia/crear` | Crea familia y asigna rol admin al usuario |
| Familia | `POST /actions/familia/invitar` | Envía invitación por email o genera código QR |
| Miembros | `PATCH /actions/miembro/aporte` | Actualiza % o monto de aporte del miembro |
| Gastos | `POST /actions/gasto/registrar` | Crea gasto (recurrente, esporádico o crédito) |
| Gastos | `GET /actions/gasto/resumen-mes` | Consolida gastos del mes por categoría y ámbito |
| Créditos | `POST /actions/credito/nuevo` | Registra crédito y calcula tabla de amortización inicial |
| Créditos | `GET /actions/credito/amortizacion` | Retorna tabla completa + simulación de abono extra |
| Metas | `POST /actions/meta/crear` | Crea meta individual o compartida |
| Metas | `PATCH /actions/meta/abonar` | Registra aporte a meta y actualiza progreso |
| Suscripciones | `POST /actions/suscripcion-ia/nueva` | Registra suscripción digital |
| Suscripciones | `GET /actions/suscripcion-ia/resumen` | Calcula gasto mensual total en herramientas |
| Nudges | `POST /actions/nudge/evaluar` | Cron job: evalúa condiciones y genera nudges pendientes |
| Nudges | `PATCH /actions/nudge/responder` | Registra si el usuario aceptó o rechazó el nudge |

---

## 6. FLUJO DE NAVEGACIÓN — *Estructura de Rutas*

```
app/
├── (auth)/
│   ├── login/
│   ├── registro/
│   └── onboarding/
│       ├── modo/          → Individual o Familiar
│       ├── miembros/      → Invitar integrantes
│       └── presupuesto/   → Setup inicial de ingresos
│
├── (app)/
│   ├── dashboard/         → Vista consolidada del hogar
│   │   ├── [miembro_id]/  → Vista individual por miembro
│   │   └── familia/       → Vista del núcleo familiar completo
│   │
│   ├── compromisos-fijos/
│   │   ├── page.tsx       → Listado de gastos recurrentes
│   │   └── nuevo/         → Formulario + modal de conveniencia de crédito
│   │
│   ├── gastos-esporadicos/
│   │   ├── page.tsx       → Listado de gastos no periódicos
│   │   ├── nuevo/
│   │   └── suscripciones-ia/  → Subpanel de herramientas digitales
│   │
│   ├── reserva/
│   │   ├── page.tsx       → Dashboard de metas activas
│   │   ├── nueva-meta/
│   │   └── [meta_id]/     → Detalle + progreso de meta
│   │
│   ├── deudas/
│   │   ├── page.tsx       → Listado de créditos activos
│   │   ├── nuevo/
│   │   └── [credito_id]/  → Amortización + simulador
│   │
│   ├── familia/
│   │   ├── page.tsx       → Panel de miembros y aportes
│   │   └── invitar/
│   │
│   └── configuracion/
│
├── layout.tsx             → Shell PWA + service worker
└── manifest.json          → Config instalación PWA
```

---

## 7. CRITERIOS TÉCNICOS TRANSVERSALES

### Seguridad
- **RLS activo** en todas las tablas: un usuario solo puede leer/escribir datos de las familias donde es miembro
- **JWT + Supabase Auth**: sesiones con refresh token automático
- **Validación de esquema**: Zod en todos los Server Actions antes de tocar la DB

### Performance
- **ISR (Incremental Static Regeneration)**: páginas de dashboard con revalidación cada 60s
- **Optimistic UI**: el registro de gastos actualiza el balance visualmente antes de confirmar con el servidor
- **Service Worker**: cacheo de última vista de presupuesto para acceso offline

### Mobile-First
- Diseño base en `375px` (iPhone SE), breakpoints en `640px` y `1024px`
- Formularios con `inputmode="decimal"` para teclado numérico en móvil
- Gestos: swipe para marcar gasto como pagado en listas

---

## 8. ENTORNOS Y VARIABLES DE ENTORNO

```env
# Supabase
NEXT_PUBLIC_SUPABASE_URL=
NEXT_PUBLIC_SUPABASE_ANON_KEY=
SUPABASE_SERVICE_ROLE_KEY=

# App
NEXT_PUBLIC_APP_URL=
NEXT_PUBLIC_APP_NAME="FamilyFlow"

# Nudge Engine (Cron - Fase 1)
CRON_SECRET=

# APIs Externas (Fase 2)
PRECIO_API_KEY=
OPEN_BANKING_CLIENT_ID=
```

---

*Documento generado bajo los estándares de documentación técnica **MODUS AXON** · Uso interno · Todos los derechos reservados*
