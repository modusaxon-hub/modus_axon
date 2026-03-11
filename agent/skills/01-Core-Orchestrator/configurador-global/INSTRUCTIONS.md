# REGLAS MAESTRAS DE CONFIGURACIÓN — ANTIGRAVITY v2.0

**Actualizado:** 2026-03-06
Este documento contiene las reglas globales de configuración técnica para todos los proyectos en el entorno de desarrollo. El asistente DEBE leer y aplicar estas reglas al iniciar cualquier interacción o proyecto nuevo.

---

## 1. Identidad de Git y GitHub

Siempre utilizar la siguiente configuración de identidad (local por proyecto, o global si el usuario lo solicita):

- **User Name:** `modusaxon-hub`
- **User Email:** `modusaxon@gmail.com`
- **Auth Method:** Git Credential Manager (`git config --global credential.helper manager`)
- **Commits:** Locales libres de autenticación. Push solo cuando el usuario lo pida explícitamente.
- **Safe Directory:** Marcar automáticamente los directorios de trabajo como seguros:
  ```bash
  git config --global --add safe.directory "D:/Documentos/Proyectos ADSO/*"
  ```

---

## 2. Integración con XAMPP (Sin Duplicidad de Carpetas)

Para proyectos PHP/MySQL que requieran XAMPP:

- **Regla:** Los archivos reales SIEMPRE viven en `D:\Documentos\Proyectos ADSO\`.
- **Estrategia:** Crear enlace simbólico en `C:\xampp\htdocs\` que apunte a `D:\`.
- **Comando:**
  ```powershell
  New-Item -ItemType SymbolicLink -Path "C:\xampp\htdocs\nombre-proyecto" -Target "D:\Documentos\Proyectos ADSO\nombre-proyecto"
  ```
- **Beneficio:** Un solo lugar para editar código, un solo lugar para Git, acceso inmediato vía `localhost/nombre-proyecto`.

---

## 3. Stack Tecnológico Preferente

| Capa | Opción Primaria | Opción Cloud/Producción |
|------|----------------|------------------------|
| Base de Datos | MySQL (MariaDB vía XAMPP) — proyectos PHP | Supabase (PostgreSQL) — proyectos React/Next.js |
| Entorno Local | `127.0.0.1:3306`, `root`, sin contraseña | Variables `.env` con `VITE_SUPABASE_URL` y `VITE_SUPABASE_ANON_KEY` |
| Frontend | React + TypeScript + Vite | Next.js para SSR si se necesita SEO avanzado |
| Estilos | Tailwind CSS | CSS Modules como alternativa |
| Auth | Supabase Auth (JWT + RLS) | PHP Sessions para proyectos legacy |

**Regla:** Diseño y pruebas en entorno local. Migración a Supabase Cloud en staging/producción para proyectos React.

---

## 4. Carpeta de Agentes Única (Centralizada)

- **Regla:** NO copiar la carpeta `agent` dentro de cada proyecto.
- **Ubicación:** `D:\Documentos\Proyectos ADSO\agent\` — siempre abierta en el workspace de VS Code.
- **Funcionamiento:** El asistente salta entre proyectos referenciando la carpeta central de agentes para leer skills y configuraciones, pero aplica los cambios en el proyecto activo.

---

## 5. Gestión del Header Maestro (project_jacquin)

- **Aplica solo a:** proyectos del ecosistema `project_jacquin`.
- **Regla:** Ejecutar automáticamente `npm run build:header` cada vez que se modifique el Header o sus subcomponentes (Logo, Navbar).
- **Referencia:** `agent/skills/02-Builder-Stack/header-manager/INSTRUCTIONS.md`

---

## 6. Túneles con zrok (Compartir Externamente)

Para compartir proyectos o probar en dispositivos móviles:

- **Herramienta:** `C:\zrok_1.1.10\zrok.exe`
- **Estrategia:** Preferir túneles reservados (permanentes) para evitar cambios de URL.
- **XAMPP:** `zrok reserve public localhost:80/nombre-proyecto --backend-mode web`
- **Vite:** Activar `--host` en Vite + apuntar zrok al puerto de dev (ej. 5000).
- **Activación:** `zrok share <token_de_reserva>`

---

## 7. Seguridad y Compliance SIC 2026

- **HTTPS:** Forzar en todos los despliegues. Reglas de redirección en `.htaccess` o middleware.
- **Cookie Consent (SIC 2026):** Inyectar en todo proyecto con analytics o rastreadores externos. Banner que bloquee scripts hasta aceptación explícita.
- **Aviso de Privacidad:** Enlace en footer y formularios (Ley 1581 de 2012).
- **OWASP Top 10:** Aplicar sanitización (`sanitizeText`), throttle en submits, CSP meta tag, validación MIME en uploads.
- **RLS:** Activar Row Level Security en Supabase para cualquier tabla con datos de usuarios.

---

## 8. Estándares de Proyecto — Estructura OBLIGATORIA

Todo proyecto DEBE tener una carpeta `technical/` en la raíz con los siguientes archivos base:

| Archivo | Descripción |
|---------|-------------|
| `technical/Repositorio.md` | URL Git, estado (DEV/STAGING/PROD), instrucciones de clone |
| `technical/ERROR_LOG.html` | Bitácora de errores con severidad y fecha |
| `technical/DOC_TECNICO.html` | Manual técnico: arquitectura, DB schema, flujos |
| `technical/MANUAL_USUARIO.html` | Guía de usuario final |
| `AI_LOG_CUMPLIMIENTO.md` | Registro de decisiones de IA y compliance (raíz del proyecto) |
| `TASK.md` | Log de acciones en tiempo real (raíz del proyecto) |
| `PHASE-TRACKER.md` | Bitácora de gates por fase (raíz del proyecto) |

**SQL:** Mantener siempre un archivo de respaldo del esquema en `database/schema.sql` o equivalente.

---

## 9. Idioma y Estilo

- **Idioma del Asistente:** Español (preferencia absoluta en toda comunicación).
- **Código:** Modular, limpio, sin código muerto. Comentarios en español cuando no es autoevidente.
- **Tipografía en interfaces:** Sistema Bio-Digital Futurism — Space Grotesk (display) + DM Sans (body) + JetBrains Mono (code).

---

## 10. Entregable Obligatorio: TASK.md

Después de **cada instrucción completada** (sin excepción), el asistente DEBE actualizar el `TASK.md` del proyecto activo:

```markdown
# TASK: [Nombre del Objetivo Principal]

| Acción / Requerimiento | Estado | Nota |
| :--- | :---: | :--- |
| **[Descripción de la tarea]** | ⏳ / ✅ / ❌ | [Observaciones] |
```

**Reglas del TASK.md:**
- **Acumulativo:** No se borra el progreso anterior. Solo se AÑADEN tareas nuevas.
- **Estados:** `⏳ Pendiente`, `✅ Hecho`, `❌ Bloqueado`.
- **Presentar al usuario:** Siempre al final de cada interacción significativa.
- **Ubicación:** Raíz del proyecto activo.

---

*Cualquier desviación de estas reglas debe ser consultada previamente con el usuario y documentada en `AI_LOG_CUMPLIMIENTO.md`.*
