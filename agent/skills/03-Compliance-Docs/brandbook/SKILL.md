---
name: brandbook
description: Estándar de marca. Úsalo siempre que generes interfaz, landing, componentes, copies, textos de botones o cualquier contenido visible para el usuario.
---

# Skill: Estilo y Marca

**Contexto del Proyecto**: El agente debe identificar la marca activa (ej. `{{ProjectName}}`) leyendo el contexto o preguntando al usuario si no está definido.

## Cuándo usar este Skill
- Si vas a diseñar una UI o una pantalla.
- Si vas a crear una landing.
- Si vas a escribir textos: titulares, CTAs, botones, mensajes de error, descripciones.
- Si vas a generar assets "de cara al usuario".

## Regla número 1 (Bootstrapping)
Antes de nada, verifica si existe la carpeta `.agent/skills/brandbook/` en el proyecto activo. Si no existe, CRÉALA.
No improvises el estilo. Si falta un dato, pregunta o usa los valores definidos en los recursos del proyecto.

## Dónde mirar según el tipo de tarea
- **Estilo visual**: Busca `recursos/{{ProjectName}}-estilo.json` o usa un genérico.
- **Forma de escribir**: `recursos/guia-de-textos.md`
- **Decisiones técnicas**: `recursos/reglas-tecnicas.md`

## Checklist antes de entregar
1) ¿Parece de la misma marca que lo anterior?
2) ¿Titulares y CTAs son concretos (no genéricos)?
3) ¿La jerarquía visual está clara (título, subtítulo, acciones)?
4) ¿El texto es corto y entendible a la primera?
5) ¿No se han inventado colores/estilos fuera de la guía del proyecto?

## Cómo mejorar este Skill
Si algo no cuadra, no "lo arregles en el prompt": ajusta los recursos y vuelve a generar. El objetivo es que el estándar se quede guardado para este proyecto.

## 📁 Entrega de Manuales e Informes (A4)
Todos los manuales de identidad o informes de marca deben entregarse en **HTML Autocontenido** optimizado para impresión A4, manteniendo un rigor estético profesional y consistente con la marca del proyecto:
- CSS embebido con `@media print { size: A4; margin: 2cm; }`.
- Distribución impecable sin hojas en blanco innecesarias.
- Tipografía acorde a la identidad visual detectada.
