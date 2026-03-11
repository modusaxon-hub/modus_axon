# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Workspace Overview

This is a multi-project workspace containing independent applications. Each sub-project has its own tech stack and dependencies. Never conflate files or configs between projects.

---

## Projects & Commands

### `novedades_nomina` — Payroll Reporting System

**Stack**: React 19 + Vite (frontend) · Node.js + Express 5 (backend) · SQL Server

**Setup** — requires Node.js v18+ and a SQL Server instance:
```bash
# 1. Initialize DB: run app/server/schema.sql in SQL Server
# 2. Create app/server/.env with DB_USER, DB_PASSWORD, DB_SERVER, DB_NAME, PORT=5000

# Backend
cd novedades_nomina/app/server && npm install
node index.js              # runs on :5000

# Frontend
cd novedades_nomina/app && npm install
npm run dev                # runs on :5173
npm run build
npm run lint
```
Alternatively, run `ejecutar_app.bat` from the project root.

---

### `project_jacquin` — Educational Institution Platform

**Stack**: React 19 + React Router v7 (frontend, CRA) · PHP 8 native API (backend) · MySQL/MariaDB · Zrok tunnel for dev

```bash
# Frontend
cd project_jacquin/web_page/pages && npm install
npm start                  # dev server :3000
npm run build
npm test

# Backend: PHP with Composer — no separate build step
cd project_jacquin/jacquin_api && composer install
```
Quick start: `iniciar_proyecto.bat`; tunnel: `iniciar_tunel.bat`

**Key env**: `jacquin_api/.env` — contains `BREVO_API_KEY` for transactional email (Brevo/SendinBlue SDK).

---

### `despensa_inteligente` — Smart Grocery Budget Planner

**Stack**: Vanilla JS + HTML/CSS (frontend) · PHP REST API (backend) · Python + Playwright (scrapers)

```bash
# No frontend build step — serve HTML/JS directly

# Python scrapers (price monitoring)
python despensa_inteligente/scrapers/auto_bot.py      # full store scraper
python despensa_inteligente/scrapers/check_browser.py # validate Playwright browser

# Daily automation: run_daily_scrape.bat
```

Supported stores: D1, Olímpica, ARA, Megatiendas.

---

### `agent` — Antigravity AI Skill Library

Reusable skills for the AI-driven development workflow. Not a runnable app. See `agent/skills/task.md` for the master workflow (Branding → Ideation → Roadmap → Build → QA → Deploy).

---

## Architecture

### project_jacquin
Decoupled Client-Server: React SPA calls PHP API endpoints over JSON/HTTPS. Auth uses session tokens stored in LocalStorage. Role-based access: Admin, Profesor, Estudiante. Enrollment flow has a pending→active→rejected lifecycle approved by Admin.

Key entities: Users, Roles, Courses, Schedules, Enrollments, Events (Workshop/Concert/Class).

### novedades_nomina
Biweekly payroll period logic: Corte A (25th–9th) and Corte B (10th–24th). Admin can set a manual start date; the system auto-calculates all subsequent periods.

### despensa_inteligente
Python Playwright bots scrape store prices and persist to DB via `config/db.php`. PHP endpoints expose product comparison and budget tracking. No JS bundler — files are served as-is.

---

## Cross-Project Conventions

- **UI style**: Dark glassmorphism, mobile-first, responsive. Match existing visual language.
- **API communication**: JSON over HTTP in all projects.
- **Security**: Passwords hashed with Bcrypt (PHP). SQL inputs sanitized. CORS configured on PHP APIs.
- **Repos**: `project_jacquin` → `github.com/Pulecode2977343/project_jacquin`; `despensa_inteligente` → `github.com/modusaxon-hub/despensa_inteligente`; `modus_axon` → `github.com/modusaxon-hub/modus_axon`
- **Task tracking**: Each project has a `TASK.md` and a `technical/ARCHITECTURE.md`.
- **Logging**: Projects use `debug/` or `log/` folders (called bitácoras) for diagnostic output.

---

## Agent Skill Library (Dispatcher Automático)

Librería centralizada en `d:\Documentos\Proyectos ADSO\agent\skills\`. NO se copia en cada proyecto.

**INSTRUCCIÓN OBLIGATORIA:** Antes de responder cualquier tarea, evalúa las palabras clave del mensaje del usuario y aplica proactivamente el skill correspondiente leyendo su archivo SKILL.md/INSTRUCTIONS.md completo.

### Reglas de enrutamiento (dispatcher)

| Si el mensaje contiene... | Leer y aplicar skill |
|---|---|
| "idea", "concepto", "opciones", "brainstorming", "variantes", "nombres", "hooks" | `agent/skills/brainstorming-pro/SKILL.md` |
| "plan", "hoja de ruta", "roadmap", "fases", "estrategia", "pasos" | `agent/skills/planificacion-pro/SKILL.md` |
| "documento", "pdf", "convierte", "doc to app", "mini-app desde" | `agent/skills/doc-to-app/SKILL.md` |
| "revisa", "pulir", "calidad", "QA", "antes de publicar", "listo para" | `agent/skills/modo-produccion/SKILL.md` |
| "diseña", "UI", "landing", "componente", "pantalla", "visual", "estilo" | `agent/skills/brandbook/SKILL.md` |
| "documenta", "arquitectura", "diagrama", "ERD", "flowchart", "casos de uso", "build log" | `agent/skills/documentador-tecnico/SKILL.md` |
| "crea un skill", "nuevo agente", "automatizar proceso" | `agent/skills/creador-de-skills/SKILL.md` |
| Header.jsx, JamLogo.jsx o Navbar.jsx modificados | `agent/skills/header-manager/INSTRUCTIONS.md` → ejecutar `npm run build:header` |

### Comportamiento esperado
1. Detectar palabras clave en la instrucción del usuario
2. Leer el SKILL.md correspondiente
3. Seguir exactamente su workflow, inputs y formato de output
4. Si ninguna regla aplica, responder normalmente
5. Actualizar `TASK.md` en la raíz del proyecto activo al finalizar cada tarea
