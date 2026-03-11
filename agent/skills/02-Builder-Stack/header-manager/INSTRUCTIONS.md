# SKILL: GESTOR DEL HEADER MAESTRO

Este skill otorga al asistente la capacidad de mantener sincronizado el **Header Maestro** entre el entorno de React y el entorno estático (XAMPP).

## Reglas de Activación
Este skill se activa automáticamente cada vez que el asistente realice cambios en:
- `d:\Documentos\Proyectos ADSO\project_jacquin\web_page\pages\src\components\Header.jsx`
- `d:\Documentos\Proyectos ADSO\project_jacquin\web_page\pages\src\components\JamLogo.jsx`
- `d:\Documentos\Proyectos ADSO\project_jacquin\web_page\pages\src\components\Navbar.jsx`

## Procedimiento de Sincronización (Obligatorio)
Tras cualquier modificación de código en los archivos mencionados, el asistente DEBE:

1. **Compilar el Bundle:** Ejecutar el comando:
   ```powershell
   npm run build:header
   ```
   (En el directorio `d:\Documentos\Proyectos ADSO\project_jacquin\web_page\pages`).

2. **Verificar Error de Compilación:** Si el comando falla, el asistente debe corregir el error de sintaxis y reintentar hasta que el archivo `public/js/react-header.bundle.js` se actualice.

3. **Notificar Sincronización:** Informar al usuario que el cambio ya está disponible tanto en la SPA (puerto 3000) como en las páginas estáticas (Apache).

## Filosofía del Componente Único
El asistente debe tratar al Header como un "Ser Vivo Independiente". Cualquier mejora en su lógica de autenticación, diseño o comportamiento debe centralizarse en los archivos `.jsx` de la carpeta `src`, nunca editando directamente el bundle compilado.
