# Compliance Legal Skill — v2.0

**Actualizado:** 2026-03-06 | Aplica estándares SIC 2026

---

## Marco Normativo Obligatorio

### 1. Ley 1581 de 2012 — Protección de Datos Personales (Colombia)
- Implementar avisos de privacidad claros y accesibles en todas las vistas que recojan datos.
- Obtener **consentimiento explícito** (checkbox no premarcado) antes de recolectar datos personales.
- Garantizar derechos ARCO: Acceso, Rectificación, Cancelación y Oposición.
- Designar Responsable del Tratamiento de Datos en toda comunicación oficial.

### 2. SIC 2026 — Superintendencia de Industria y Comercio (Circular Única 2026)
- **Cookie Consent obligatorio:** Banner que bloquee scripts de terceros (analytics, pixels, rastreadores) hasta que el usuario acepte explícitamente. No se puede preseleccionar "Aceptar todo".
- **Aviso de Privacidad:** Enlace visible en footer y en cada formulario. Debe indicar: finalidad del tratamiento, terceros receptores, mecanismo de revocación.
- **Período de retención:** Declarar explícitamente cuánto tiempo se conservan los datos.
- **Portabilidad de datos:** Usuarios registrados pueden solicitar exportación de sus datos.
- **Reporte de incidentes:** Si hay brecha de seguridad, notificar a la SIC y a los afectados en máximo 15 días hábiles.

### 3. GDPR — Reglamento General de Protección de Datos (EU)
- Minimización de datos: solo recolectar lo estrictamente necesario para el servicio.
- Privacidad desde el diseño (Privacy by Design): aplicar desde el modelado de base de datos.
- Portabilidad de datos en formatos estándar (JSON, CSV).
- Base legal explícita para cada tipo de tratamiento (contrato, consentimiento, interés legítimo).

### 4. Resolución 1519 de 2020 (MinTIC) — Accesibilidad Web
- Estándares WCAG 2.1 Nivel AA obligatorios para sitios gubernamentales y recomendados para privados.
- Contraste mínimo: 4.5:1 para texto normal, 3:1 para texto grande.
- Etiquetas ARIA en todos los elementos interactivos.
- Navegación completa por teclado (tabindex coherente).
- Imágenes con `alt` descriptivo. Videos con subtítulos.

### 5. Resolución 000042/2020 DIAN — Facturación Electrónica
- CUFE: Código Único de Factura Electrónica (SHA-384, 96 caracteres hex).
- Numeración secuencial autonumérica sin saltos.
- Para No Responsables de IVA: leyenda "No Responsable de IVA — Art. 437 ET" obligatoria en factura.
- Conservación de facturas: mínimo 5 años.

---

## Reglas de Diseño Técnico

1. **Bases de datos**: Ninguna puede diseñarse sin cifrado para datos sensibles (email, contraseñas, documentos de identidad). Usar `bcrypt` o equivalente para passwords. Nunca almacenar en texto plano.

2. **Interfaces**: Incluir etiquetas ARIA, contraste adecuado según WCAG 2.1. Formularios accesibles por teclado.

3. **Formularios**: Incluir enlace visible a política de tratamiento de datos junto a cada campo de recolección.

4. **Cookies técnicas vs. rastreadores**: Separar explícitamente. Las cookies técnicas (sesión, CSRF) no requieren consentimiento. Las de analytics y publicidad sí.

5. **Logs de auditoría**: Todo acceso a datos personales debe quedar en bitácora (quién, cuándo, qué acción). Campo `updated_by` + `updated_at` en tablas críticas.

---

## Componentes UI Obligatorios

```tsx
// CookieBanner — bloquea terceros hasta aceptación
// PrivacyLink — presente en footer y formularios
// ConsentLog — registro en BD de: user_id, timestamp, ip_hash, version_policy
// DeleteAccountFlow — flujo de eliminación de cuenta y datos (ARCO)
```

---

## Checklist de Compliance por Proyecto

| Item | Obligatorio | Estado por defecto |
|------|-------------|-------------------|
| Cookie Banner (no preseleccionado) | ✅ SIC 2026 | ⏳ Implementar |
| Aviso de Privacidad en footer | ✅ Ley 1581 | ⏳ Implementar |
| ARIA labels en formularios | ✅ Res. 1519 | ⏳ Implementar |
| Contraste WCAG 2.1 AA | ✅ Res. 1519 | ⏳ Verificar |
| Passwords con bcrypt | ✅ Ley 1581 | ⏳ Implementar |
| Consentimiento explícito | ✅ SIC 2026 | ⏳ Implementar |
| Log de auditoría | ✅ SIC 2026 | ⏳ Implementar |
| CUFE en facturas | ✅ DIAN 042 | ⏳ Implementar |
| Leyenda No IVA en factura | ✅ DIAN 042 | ⏳ Si aplica |

---

*Cualquier desviación de estos estándares debe documentarse en `AI_LOG_CUMPLIMIENTO.md` con justificación técnica y fecha de resolución esperada.*
