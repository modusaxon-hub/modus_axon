# 🛠️ MANUAL DE ENTORNO LOCAL
## Origen Sierra Nevada — Guía de Despliegue y Configuración

| Atributo | Detalle |
|---|---|
| **Proyecto** | Origen Sierra Nevada SM |
| **ID** | PRJ-OSN-2026 |
| **Repositorio** | d:\Documentos\Proyectos ADSO\origen_sierranevada |
| **Última Actualización** | 2026-03-11 · Sesión III |
| **Versión** | v2.0.0 |

---

## 🏗️ Requisitos del Sistema

| Herramienta | Versión | Propósito |
|---|---|---|
| Node.js | v18+ | Runtime del servidor de desarrollo |
| npm | v9+ | Gestor de dependencias |
| Git | Cualquiera | Control de versiones |
| VS Code | Última estable | IDE recomendado |
| PowerShell | v7+ | Terminal en Windows |

---

## 🚀 Inicio Rápido (Quick Start)

### 1. Clonar / Ubicarse en el Proyecto
```powershell
cd "d:\Documentos\Proyectos ADSO\origen_sierranevada\web-page\pages"
```

### 2. Instalar Dependencias
```powershell
npm install
```

### 3. Configurar Variables de Entorno
Crea el archivo `.env` en la raíz del proyecto (`web-page/pages/`) con:
```env
VITE_SUPABASE_URL=https://oawhbhoywqfgnqgdyyer.supabase.co
VITE_SUPABASE_ANON_KEY=<tu-anon-key-aquí>
```

> ⚠️ El archivo `.env` NO debe subirse al repositorio. Está en `.gitignore`.

### 4. Iniciar el Servidor de Desarrollo
```powershell
npm run dev
```
La aplicación estará disponible en: **http://localhost:5000**

> Si el puerto 5000 está ocupado, Vite usará el siguiente disponible.
> Verificar en `vite.config.ts` → `server.port`.

### 5. Compilar para Producción
```powershell
npm run build
```
Los archivos listos para despliegue estarán en `dist/`.

---

## 🌐 Acceso Remoto (Para Pruebas en Dispositivos Externos)

MODUS AXON recomienda **zrok** para túneles estables:

```powershell
& "C:\zrok_1.1.10\zrok.exe" share reserved [NOMBRE_RESERVADO] --override-endpoint http://localhost:5000
```

Alternativa con LocalTunnel:
```powershell
npx localtunnel --port 5000 --subdomain origen-sierranevada
```

---

## 📁 Estructura del Proyecto

```
origen_sierranevada/
├── web-page/
│   └── pages/                    ← RAÍZ DEL FRONTEND
│       ├── src/
│       │   ├── contexts/          # AuthContext, CartContext, LanguageContext
│       │   ├── features/
│       │   │   └── auth/pages/    # Login, Register, ForgotPassword, Reset
│       │   ├── pages/             # AdminDashboard, HomePage, ProductManager...
│       │   │   └── home/          # HistoriaSection, MapaOrigenSection, TestimoniosSection
│       │   ├── services/          # supabaseClient, productService, authService...
│       │   └── shared/
│       │       ├── components/    # Header, Footer, MobileNav, Logo...
│       │       └── types/         # index.ts — Tipos TypeScript centralizados
│       ├── public/                # Assets estáticos
│       ├── .env                   # Variables locales (no en git)
│       ├── vite.config.ts
│       └── tailwind.config.js
├── thinking-design/               # Bocetos y guías de diseño visual
├── scripts/                       # Scripts de utilidad
├── modus-connector.md             # Conector con MODUS AXON
└── instructions.md                # Bitácora del proyecto
```

---

## 🗄️ Supabase — Datos de Conexión

| Atributo | Valor |
|---|---|
| **Project ID** | `oawhbhoywqfgnqgdyyer` |
| **Region** | `us-west-2` |
| **Dashboard** | https://supabase.com/dashboard/project/oawhbhoywqfgnqgdyyer |
| **DB Host** | `db.oawhbhoywqfgnqgdyyer.supabase.co` |
| **PostgreSQL Version** | 17.6.1 |

### Variables de Entorno en Supabase (Secrets)
Configuradas en: Supabase → Settings → Edge Functions → Secrets

| Variable | Propósito |
|---|---|
| `BREVO_API_KEY` | Clave API para envío de correos transaccionales |

---

## ⚙️ Comandos Útiles

| Comando | Descripción |
|---|---|
| `npm run dev` | Inicia el dev server |
| `npm run build` | Build de producción |
| `npm run lint` | Verificación de código |
| `npm run preview` | Vista previa del build |

---

## ⚠️ Solución de Problemas

| Error | Causa | Solución |
|---|---|---|
| Puerto 5000 en uso | Proceso previo no cerrado | `netstat -ano \| findstr :5000` → matar el PID |
| `Forbidden resource` Supabase MCP | Permisos del MCP server | Usar `execute_sql` con proyecto correcto |
| Imágenes no cargan | Bucket público no configurado | Supabase → Storage → `product-images` → Make Bucket Public |
| Error de compilación TS | Import incorrecto | Verificar que los imports usen `@/` en lugar de rutas relativas |
| BREVO no envía correo | API key incorrecta o modo prueba | Verificar en Supabase Secrets + revisar dominio verificado en Brevo |

---
**MODUS AXON** — Cualquier sistema, perfeccionado.
*PRJ-OSN-2026 · v2.0.0 · Bio-Digital Futurism · 2026*
