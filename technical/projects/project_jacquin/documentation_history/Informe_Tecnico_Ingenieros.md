# Informe Técnico — Proyecto JACQUIN Academia Musical
**Para: Equipo de Ingeniería**  
**Fecha**: 11 de febrero de 2026  
**Versión**: 1.0  
**Commit**: `52c566a` (branch `main`)  
**Producción**: [academiajacquin.infinityfreeapp.com](https://academiajacquin.infinityfreeapp.com)

---

## 1. Resumen Ejecutivo

JACQUIN Academia Musical es una aplicación web para la gestión académica y promoción de una academia de música. Este informe documenta la arquitectura técnica, las decisiones de diseño, y el cumplimiento de los criterios de calidad del formato SENA de evaluación de prototipos.

---

## 2. Arquitectura del Sistema

### 2.1 Stack Tecnológico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| Frontend | HTML5, CSS3, JavaScript (ES6+) | — |
| Componentes UI | Web Components (Custom Elements) | v1 |
| Carruseles | Swiper.js | 11.x |
| Backend/API | PHP | 8.x |
| Base de Datos | MySQL (PDO) | 5.7+ |
| Servidor | Apache (XAMPP local / InfinityFree prod) | 2.4 |
| Control de Versiones | Git + GitHub | — |

### 2.2 Estructura del Proyecto

```
project_jacquin/
├── jacquin_api/              # Backend REST API
│   ├── config/
│   │   └── connection.php    # Conexión PDO (gitignored)
│   ├── helpers/
│   │   └── PathHelper.php    # Gestión de rutas de uploads
│   ├── get_events.php        # Endpoint: eventos
│   ├── get_about_cards.php   # Endpoint: tarjetas "Sobre Nosotros"
│   ├── get_team_members.php  # Endpoint: miembros del equipo
│   ├── get_mission_values.php# Endpoint: misión y valores
│   └── admin_*.php           # Endpoints administrativos (CRUD)
│
├── web_page/                 # Frontend
│   ├── index.html            # Redirect → pages/index.html
│   └── pages/
│       ├── index.html        # Página principal
│       ├── cookies.html      # Política de cookies
│       ├── galeria.html      # Galería multimedia
│       ├── politicas.html    # Política de privacidad
│       ├── terminos.html     # Términos y condiciones
│       ├── images/           # Assets estáticos
│       ├── css/              # Hojas de estilo
│       └── js/
│           ├── services/
│           │   └── api.js    # Cliente API con BASE_URL dinámica
│           ├── components/   # Web Components (Header, Footer, Navbar, etc.)
│           ├── home_events.js
│           ├── about_cards.js
│           ├── team_cards.js
│           └── programs_carousel.js
│
└── Documentation/            # Documentación técnica
```

### 2.3 Diagrama de Flujo de Datos

```
[Browser] → HTTP → [Apache Server]
                      ├── Static Files → [web_page/pages/]
                      └── API Calls   → [jacquin_api/] → PDO → [MySQL]
```

---

## 3. Decisiones Técnicas Clave

### 3.1 Migración MySQLi → PDO

**Problema**: El archivo `connection.php` usaba MySQLi, pero todos los endpoints API esperaban un objeto `$pdo`.  
**Solución**: Migración completa a PDO con prepared statements.  
**Impacto**: Protección contra SQL injection, compatibilidad total con la capa de datos.

**Antes:**
```php
$conn = new mysqli($host, $user, $pass, $db);
```

**Después:**
```php
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);
$conn = $pdo; // Alias para compatibilidad
```

### 3.2 Reubicación de index.html

**Problema**: `index.html` residía en `web_page/` pero referenciaba recursos en `pages/`.  
**Solución**: Mover `index.html` a `web_page/pages/` y crear un redirect en la raíz.  
**Beneficio**: Eliminación de 30+ prefijos `pages/` en rutas, simplificación del mantenimiento.

### 3.3 Resolución Dinámica de Rutas API

**Problema**: Rutas API hardcodeadas fallaban según el contexto de despliegue.  
**Solución**: `api.js` detecta dinámicamente la estructura de directorio y construye `BASE_URL` según el contexto (local vs producción).

---

## 4. Seguridad

| Aspecto | Implementación |
|---------|---------------|
| SQL Injection | PDO Prepared Statements |
| CORS | Headers configurados en `.htaccess` |
| Archivos sensibles | `connection.php` en `.gitignore` |
| Directorios protegidos | `Options -Indexes` en `.htaccess` |
| Credenciales | Separadas por entorno (local/prod) |
| Cookies | Banner de consentimiento con política de privacidad |

---

## 5. Testing y Validación

### 5.1 Pruebas Realizadas

| Tipo | Herramienta | Resultado |
|------|------------|-----------|
| Funcional (Desktop) | Chrome 128 / localhost:8080 | ✅ Sin errores en consola |
| Funcional (Mobile) | Chrome DevTools (375x812) | ✅ Sin scroll horizontal |
| API Endpoints | Prueba directa GET | ✅ JSON válido |
| Cross-origin | zrok tunnel | ✅ Acceso externo funcional |
| Producción | InfinityFree | ✅ Live y funcional |

---

## 6. Entornos de Despliegue

| Entorno | URL | Base de Datos |
|---------|-----|---------------|
| Local | `http://localhost:8080/web_page/pages/index.html` | MySQL local (XAMPP) |
| Demo | Túnel zrok (temporal) | MySQL local |
| Producción | `https://academiajacquin.infinityfreeapp.com` | MySQL InfinityFree |

---

## 7. Deuda Técnica y Mejoras Futuras

| Prioridad | Mejora | Justificación |
|-----------|--------|---------------|
| Media | Atributos `alt` en imágenes dinámicas | Accesibilidad (WCAG 2.1) |
| Media | Lazy loading en carruseles | Performance (Core Web Vitals) |
| Baja | Reposicionar cookie banner en móvil | UX — cubre Hero CTA |
| Baja | Módulo de búsqueda y filtros | Funcionalidad ampliada |
| Futura | Backup automatizado de BD | Seguridad y continuidad |
