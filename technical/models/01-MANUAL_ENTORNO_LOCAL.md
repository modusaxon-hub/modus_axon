# 🛠️ MANUAL_ENTORNO_LOCAL.md
## Manual de Despliegue y Configuración del Entorno Local

| Proyecto | {{PROJECT_NAME}} |
|----------|------------------|
| **MODUS AXON Hub** | [modus_axon](../modus_axon) |
| **Repositorio** | [Git URL] |
| **Creado** | {{DATE}} |
| **Versión** | v1.0.0 |

---

## 🏗️ Requisitos del Sistema
- **Interprete**: Node.js (v18.0+) / PHP (v8.0+) / Python (v3.9+)
- **Base de Datos**: Supabase (Local/Remote) / MySQL / Postgres
- **Herramientas de Túnel**: zrok (v1.1.10+) / LocalTunnel / Ngrok

---

## 🚀 Flujo de Inicio (Quick Start)
Ejecutar los siguientes comandos en orden:

### 1. Clonar y Dependencias
```powershell
git clone [URL_REPOSITORIO]
cd [CARPETA_PROYECTO]
npm install # o composer install
```

### 2. Configuración de Variables (Environment)
Copiar el archivo `.env.example` a `.env` y configurar:
- `VITE_SUPABASE_URL`: URL de Supabase.
- `VITE_SUPABASE_ANON_KEY`: Key anónima de Supabase.
- `DB_PASSWORD`: Clave de Base de Datos.

### 3. Ejecución del Servidor
```powershell
npm run dev # o npm start
```

---

## 🌐 Configuración de Túneles (Acceso Remoto para Pruebas)
*MODUS AXON recomienda usar **zrok** para túneles estables.*

### Comando de Reserva (Shared Reserved)
```powershell
& "C:\zrok_1.1.10\zrok.exe" share reserved [RESERVED_NAME] --override-endpoint http://localhost:[PORT]
```

---

## 📁 Estructura del Proyecto
- `/src`: Código fuente (React/JS).
- `/api`: Endpoints backend (PHP/Edge Functions).
- `/documentation`: Manuales, Arquitectura, Specs (HTML/MD).
- `/public`: Activos públicos, imágenes, iconos.

---

## ⚠️ Solución de Problemas (Troubleshooting)
- **Error CORS**: Verificar que la URL del front-end esté en el `whitelist` del back-end.
- **Error Auth**: Asegurar que las variables de Supabase en el `.env` sean correctas.
- **Túnel Caído**: Verificar reserva de zrok con `zrok status`.

---
**MODUS AXON** — Cualquier sistema, perfeccionado.
