# 📱 PRODUCTO: FamilyFlow — Control Financiero Familiar Inteligente
> **Versión:** 0.2 — Product Vision Document *(Iteración 2)*  
> **Fecha:** Marzo 2026  
> **Autor:** MODUS AXON · Product Management  
> **Clasificación:** Uso interno — Confidencial  
> **Changelog:** v0.2 — Añadidos: Panel de Gastos Esporádicos · Sistema de Cuentas Individual/Familiar · Subpaneles por Miembro · Metas de Bienes/Viajes

---

## 1. PROPUESTA DE VALOR — *The Pitch*

**FamilyFlow** no es una hoja de cálculo con botones bonitos. Es el primer copiloto financiero diseñado para la realidad de las familias latinoamericanas: ingresos variables, compromisos legales, deudas en cuotas y la presión diaria de que el mercado suba. A diferencia de un presupuesto estático, FamilyFlow **aprende cómo gasta tu familia, compara precios en tiempo real del mercado local, identifica cuánto estás pagando de más y te propone micro-decisiones de ahorro en el momento justo, sin leccionarte ni agobiarte**. La diferencia está en el *cuándo* y el *cómo*: no cuando tú lo recuerdas, sino cuando el sistema detecta que tienes capacidad real de actuar. Una app que no solo registra: **te organiza, te protege y te impulsa a crecer**.

---

## 2. ARQUITECTURA DE SECCIONES — *Sitemap Funcional*

### 🛒 2.1 Gestión de Despensa
*Centro de inteligencia de consumo del hogar*

| # | Función Crítica | Descripción |
|---|---|---|
| 1 | **Inventario de Productos** | Registro de productos del hogar con cantidad, unidad de medida y fecha de caducidad. Alerta cuando un producto está por agotarse o vencer. |
| 2 | **Comparador de Precios** | Scraping / API de precios de supermercados locales (Éxito, Jumbo, D1, Ara). El usuario escanea o busca un producto y ve dónde está más barato esta semana. |
| 3 | **Historial de Compras y Tendencias** | Registro cronológico de compras por categoría. Detecta inflación personal (cuánto más caro compras hoy vs. hace 3 meses) y sugiere marcas blancas o sustitutos equivalentes. |

---

### 📡 2.2 Conectividad y Suscripciones
*Dashboard unificado de servicios digitales y servicios públicos*

| # | Función Crítica | Descripción |
|---|---|---|
| 1 | **Panel de Suscripciones Activas** | Listado de streaming (Netflix, Spotify, etc.), internet, telefonía e indicadores como "¿lo usaste este mes?" para justificar su vigencia. |
| 2 | **Servicios Públicos Inteligentes** | Registro de facturas de agua, luz y gas con gráficas de consumo mes a mes y alertas de consumo atípico (estrato, temporada). |
| 3 | **Detector de Suscripciones Zombie** | Identifica servicios que no se usan en más de 30 días y propone cancelarlos con un estimado de ahorro anual. |

---

### 📅 2.3 Compromisos Fijos
*Gestión de gastos legales, cuotas y manutención*

| # | Función Crítica | Descripción |
|---|---|---|
| 1 | **Cuotas de Manutención y Pensiones** | Registro de compromisos de pago periódico derivados de acuerdos legales o familiares, con seguimiento de cumplimiento. |
| 2 | **Análisis de Conveniencia de Crédito** | Cuando el usuario registra un gasto a cuotas, el sistema genera un modal con: valor real del producto, interés total pagado, cuánto tiempo tomaría ahorrar para pagarlo de contado, y un veredicto *Conveniente / No Conveniente*. |
| 3 | **Calendario de Compromisos** | Vista mensual con todos los vencimientos de cuotas y compromisos fijos. Genera alertas 5 días antes del vencimiento. |

---

### 💰 2.4 Mi Reserva de Tranquilidad
*Sistema de ahorro no invasivo con metas familiares*

| # | Función Crítica | Descripción |
|---|---|---|
| 1 | **Metas de Ahorro Familiares** | El usuario define metas (vacaciones, fondo de emergencia, compra de electrodoméstico) con fecha objetivo. La app calcula el aporte mensual necesario sin romper el presupuesto. |
| 2 | **Ahorro Automático por Excedente** | Al final de cada quincena, si el saldo disponible es positivo frente al presupuesto definido, el sistema sugiere mover un porcentaje configurable (ej: 30%) a la reserva. El usuario decide con un solo toque. |
| 3 | **Indicador de Tranquilidad** | Métrica visual (de 0 a 100) que combina: meses de fondo de emergencia cubiertos, cumplimiento de metas activas y ratio deuda/ingreso. Es el "pulso de salud financiera" de la familia. |

---

### 📉 2.5 Plan de Desendeudamiento
*Visualización clara de créditos, amortizaciones y estrategia de salida*

| # | Función Crítica | Descripción |
|---|---|---|
| 1 | **Registro de Créditos Activos** | Ingreso de créditos (libre inversión, hipotecario, educativo, tarjeta) con tasa de interés, plazo, saldo actual y cuota mensual. |
| 2 | **Tabla de Amortización Dinámica** | Visualización de cuánto del pago mensual va a capital vs. intereses. Muestra el efecto de realizar abonos extraordinarios en la reducción del plazo y del interés total pagado. |
| 3 | **Estrategia de Bola de Nieve / Avalancha** | El sistema sugiere un orden óptimo para liquidar deudas (menor saldo primero = bola de nieve / mayor tasa primero = avalancha) y proyecta la fecha estimada de liberación de todas las deudas. |

---

### 💸 2.6 Panel de Gastos Esporádicos
*Registro flexible de gastos no previstos, suscripciones variables y herramientas digitales*

| # | Función Crítica | Descripción |
|---|---|---|
| 1 | **Registro de Gasto Esporádico** | Captura de gastos no periódicos con descripción, categoría (ocio, educación, salud, tecnología) y fecha. Diferenciado del gasto recurrente para no distorsionar el presupuesto base. |
| 2 | **Control de Suscripciones de IA y Herramientas Digitales** | Subpanel específico para planes anuales o mensuales de servicios como ChatGPT, Notion AI, Canva Pro, Adobe, etc. Calcula cuánto se gasta mensualmente en herramientas de productividad y evalúa su ROI de uso. |
| 3 | **Clasificación Individual o Familiar** | Cada gasto esporádico puede marcarse como *personal* (solo afecta el balance del miembro) o *familiar* (se prorratea entre el núcleo). Define con precisión quién pagó qué y por qué. |

---

### 👨‍👩‍👧‍👦 2.7 Sistema de Cuentas: Individual vs. Familiar
*Núcleo de personalización: la app se adapta a cómo vive la familia, no al revés*

| # | Función Crítica | Descripción |
|---|---|---|
| 1 | **Modo Individual** | Cuenta personal donde el usuario lleva sus finanzas de forma privada. Puede existir de forma autónoma o como parte de un núcleo familiar. Ideal para registrar ingresos, gastos y metas propias sin mezclarlos con los del hogar. |
| 2 | **Modo Familiar con Subpaneles por Miembro** | Cuando se activa la cuenta familiar, cada integrante tiene su propio panel de control (ingresos, gastos, ahorros). El administrador puede ver el consolidado del hogar. Cada miembro decide qué porcentaje de su ingreso o excedente aporta al fondo familiar común. |
| 3 | **Metas Compartidas: Viajes y Bienes de Mayor Valor** | Los miembros del hogar definen metas colectivas (viaje familiar, TV, vehículo, computador). La app calcula el aporte proporcional de cada miembro según su capacidad, proyecta la fecha de alcance y muestra el avance en tiempo real mediante una barra de progreso compartida. |

---

## 3. ALGORITMO DE SUGERENCIA NO INVASIVA — *Nudge Engine*

> **Filosofía:** La app aconseja cuando el usuario *puede* actuar, no cuando el sistema *quiere* que actúe.

### Lógica de Activación de Nudges

```
IF saldo_disponible_quincena > presupuesto_proyectado * 1.10 THEN
    → Nudge de Ahorro: "Tienes $X de más este período. ¿Los muevo a tu Reserva?"

IF producto_despensa.precio_actual > precio_historico_promedio * 1.15 THEN
    → Nudge de Precio: "El aceite está 18% más caro. D1 lo tiene a $X esta semana."

IF suscripcion.dias_sin_uso > 30 THEN
    → Nudge de Limpieza: "No usas [Servicio] hace 30 días. Podrías ahorrar $X/año cancelándolo."

IF cuota_credito_proximo_vencimiento <= 5_dias AND saldo_disponible >= cuota THEN
    → Nudge de Pago: "Tu cuota de [Crédito] vence en 5 días y tienes saldo suficiente. ¿La registramos como pagada?"

IF balance_mes_anterior.ahorro > meta_ahorro_mes THEN
    → Nudge de Celebración: "¡Cumpliste tu meta de ahorro! ¿Subimos $X el objetivo del próximo mes?"
```

### Políticas Anti-Spam del Motor de Nudges

| Política | Regla |
|---|---|
| **Silencio Nocturno** | Sin notificaciones entre 10 PM y 7 AM |
| **Máximo Diario** | No más de 2 nudges por día |
| **Prioridad** | Orden: Pago > Precio > Ahorro > Limpieza > Celebración |
| **Cooldown** | El mismo tipo de nudge no se repite en menos de 5 días |
| **Modo Foco** | El usuario puede silenciar todos los nudges por períodos definidos |

---

## 4. MODELO DE DATOS INICIAL — *MVP Data Model*

```
┌─────────────┐       ┌──────────────┐       ┌────────────────┐
│   USUARIO   │──────▶│    FAMILIA   │──────▶│  PRESUPUESTO   │
│  id, nombre │  1:N  │ id, nombre   │  1:1  │ id, mes, año   │
│  email, rol │       │ tipo_cuenta  │       │ ingresos_total │
│  modo_cuenta│       │ (individual/ │       │ gastos_total   │
│  (ind/fam)  │       │  familiar)   │       └────────────────┘
└─────────────┘       └──────────────┘
                              │
       ┌──────────────────────┼──────────────────────┐
       ▼                      ▼                      ▼
┌────────────────┐   ┌────────────┐   ┌──────────────────┐
│MIEMBRO_FAMILIA │   │   GASTO    │   │       META       │
│ id, fk_familia │   │ id, monto  │   │ id, tipo         │
│ fk_usuario     │   │ tipo       │   │ (individual/     │
│ rol (admin/    │   │ (recurrente│   │  compartida)     │
│   miembro)     │   │ /esporádico│   │ monto_obj.       │
│ aporte_%       │   │ /familiar) │   │ fecha_lim.       │
│ visible_global │   │ fk_miembro │   │ participantes[]  │
└────────────────┘   │ fk_familia │   │ progreso_total   │
                     └────────────┘   └──────────────────┘
       │
       ├──────────────────────┐
       ▼                      ▼
┌──────────┐       ┌───────────────────┐
│ PRODUCTO │       │  SUSCRIPCION_IA   │
│ id, nom. │       │ id, nombre_plan   │
│ categoría│       │ proveedor (ChatGPT│
│ cod_barras│      │  /Canva/Adobe...) │
│ precio_  │       │ tipo (mensual/    │
│ referencia│      │       anual)      │
└──────────┘       │ monto            │
     │             │ ultima_fecha_uso  │
     ▼             │ fk_miembro       │
┌──────────────┐   └───────────────────┘
│ ALERTA_PRECIO│       ┌─────────────────┐
│ id, fk_prod. │       │     CREDITO     │
│ precio_actual│       │ id, tipo        │
│ precio_ref.  │       │ entidad         │
│ tienda       │       │ saldo_capital   │
│ fecha_detect │       │ tasa_interes    │
└──────────────┘       │ cuota_mensual   │
                       │ fecha_fin       │
                       │ fk_familia      │
                       └─────────────────┘
```

### Relaciones Clave

| Relación | Cardinalidad | Descripción |
|---|---|---|
| Usuario → Familia | N:M | Un usuario puede pertenecer a varias familias |
| Familia → MiembroFamilia | 1:N | Cada familia tiene sus integrantes con rol y % de aporte |
| MiembroFamilia → Gasto | 1:N | Cada miembro registra gastos propios (individual o familiar) |
| Familia → Gasto | 1:N | Consolidado de gastos del núcleo familiar |
| Familia → Producto | 1:N | La despensa pertenece a la familia |
| Producto → Alerta_Precio | 1:N | Historial de alertas de precio por producto |
| MiembroFamilia → Suscripcion_IA | 1:N | Seguimiento individual de herramientas digitales |
| Familia → Meta | 1:N | Metas pueden ser individuales o compartidas entre miembros |
| Familia → Crédito | 1:N | Créditos del núcleo familiar |

---

## 5. TECNOLOGÍAS SUGERIDAS — *Tech Stack Justificado*

### ¿Por qué PWA Mobile-First?

> Una PWA elimina la barrera del "¡descarga la app!" — el usuario accede desde cualquier dispositivo sin App Store, y con las mismas capacidades de una app nativa para este tipo de producto.

| Tecnología | Justificación |
|---|---|
| **Next.js 14+ (App Router)** | Server-Side Rendering para SEO, Server Actions para formularios sin API extra, y segmentación de código que reduce tiempos de carga en redes móviles lentas. |
| **Tailwind CSS** | Design system consistente con utilidades responsive. Velocidad de prototipado sin CSS espagueti. Crítico para lograr Mobile-First sin overhead. |
| **Supabase (BaaS)** | Auth, PostgreSQL y Realtime integrados. Elimina la necesidad de un backend dedicado en el MVP. Row Level Security garantiza que cada familia solo vea sus datos. |
| **PWA (next-pwa)** | Instalable desde el navegador, funciona offline para consultas básicas (ver despensa, ver presupuesto). Reduce fricción de adopción en 60% vs. apps nativas. |
| **Chart.js / Recharts** | Visualizaciones de amortización, curvas de ahorro y gráficas de gasto por categoría ligeras y responsive. |
| **Zustand** | Estado global ligero para el carrito de compra y sesión de familia. Alternativa a Redux sin boilerplate. |

### Arquitectura General

```
┌─────────────────────────────────────┐
│         CLIENTE (PWA - Next.js)     │
│  Mobile Browser / Instalada Desktop │
└───────────────┬─────────────────────┘
                │ HTTPS / WebSocket
┌───────────────▼─────────────────────┐
│           SUPABASE                  │
│  Auth │ PostgreSQL │ Realtime │ Edge │
│  Functions (Nudge Engine + Scraper) │
└───────────────┬─────────────────────┘
                │
┌───────────────▼─────────────────────┐
│        APIs EXTERNAS (Fase 2)       │
│  Precios Supermercados │ Open Banking│
└─────────────────────────────────────┘
```

---

## 6. HOJA DE RUTA — *Product Roadmap*

### 🟢 FASE 1 — MVP: Control y Visibilidad *(0–4 meses)*
> **Objetivo:** Que la familia tenga su primer cuadro de mando real en menos de 10 minutos de setup.

- [ ] Autenticación · selección de modo **Individual** o **Familiar** en el onboarding
- [ ] Creación de perfiles de miembros del hogar con rol y % de aporte configurable
- [ ] Módulo **Compromisos Fijos**: registro de gastos recurrentes y análisis de conveniencia de crédito (modal)
- [ ] Módulo **Panel de Gastos Esporádicos**: registro de gastos no previstos y clasificación Individual/Familiar
- [ ] Subpanel de **Suscripciones de IA y Herramientas Digitales** (ChatGPT, Canva, Notion, etc.)
- [ ] Módulo **Plan de Desendeudamiento**: registro de créditos y tabla de amortización básica
- [ ] Módulo **Mi Reserva de Tranquilidad**: metas individuales + metas compartidas (viajes, bienes)
- [ ] Dashboard central con balance ingresos/egresos mensual · vista consolidada familiar y vista individual
- [ ] Nudge Engine v1: alertas de vencimiento y excedentes de quincena
- [ ] Despliegue como PWA instalable (iOS Safari / Android Chrome)

---

### 🟡 FASE 2 — Beta: Conexiones API y Comparador *(4–8 meses)*
> **Objetivo:** La app se alimenta sola de datos externos. El usuario compara sin buscar.

- [ ] Módulo **Gestión de Despensa**: inventario + escaneo de código de barras (WebRTC)
- [ ] Módulo **Conectividad y Suscripciones**: detector de suscripciones zombie
- [ ] Integración con APIs de precios (Éxito, Jumbo, D1 — webscraping ético o APIs oficiales)
- [ ] **Open Banking** (si disponible en Colombia): lectura de movimientos bancarios para registro automático de gastos
- [ ] Nudge Engine v2: nudges de precio y suscripciones + motor de políticas anti-spam completo
- [ ] Analytics de familias anonimizados para benchmarking ("tu familia gasta X% más en supermercado que familias similares")

---

### 🔵 FASE 3 — Scale: Inteligencia Predictiva *(8–18 meses)*
> **Objetivo:** La app anticipa, no solo registra. Modelo de negocio B2C + B2B2C.

- [ ] **Motor de IA Predictiva**: predicción de gasto del próximo mes basada en patrones históricos
- [ ] **Simulador de Decisiones**: "¿Qué pasa con mis finanzas si compro un carro a crédito?"
- [ ] **Modo Familia Extendida**: invitar a miembros con roles (visualizador, editor, administrador)
- [ ] Integración con **plataformas de inversión** colombianas (FIC de Bancolombia, etc.)
- [ ] **Plan Premium**: reportes exportables PDF, asesor IA personalizado, límites aumentados
- [ ] Modelo **B2B2C**: API blanca para cooperativas y mutuales que quieran ofrecer el servicio a sus asociados

---

## 7. MÉTRICAS DE ÉXITO — *KPIs del MVP*

| KPI | Meta MVP (Mes 4) | Meta Beta (Mes 8) |
|---|---|---|
| Familias registradas | 100 | 1,000 |
| Retención Semana 2 | > 40% | > 55% |
| Gastos registrados/familia/mes | > 10 | > 20 |
| Nudges aceptados / enviados | > 30% | > 45% |
| NPS (Net Promoter Score) | > 30 | > 45 |

---

*Documento generado bajo los estándares de documentación técnica **MODUS AXON** · Uso interno · Todos los derechos reservados*
