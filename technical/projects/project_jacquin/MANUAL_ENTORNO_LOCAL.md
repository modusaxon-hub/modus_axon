# 🚀 Manual de Entorno y Despliegue Local - Project Jacquin

Este documento establece el protocolo estándar sobre cómo iniciar, verificar y compartir de manera externa el entorno de desarrollo local de la aplicación "Academia Jacquin". Incluye los requerimientos técnicos y enlaces permanentes.

## 1. 📂 Repositorio y Arquitectura

- **Ruta Local Front/Back:** `D:\Documentos\Proyectos ADSO\project_jacquin`
- **Repositorio Git de trabajo:** `https://github.com/Pulecode2977343/project_jacquin.git` 
- **Frontend Legacy / Sitio Web:** Se aloja en `htdocs` y la API en `jacquin_api`. Base de datos principal es `jam_db` (XAMPP).
- **Frontend Moderno (React):** Ubicado en el directorio secundario `web_page\pages`.

## 2. ⚡ Servidor React (Frontend JAM)

Para que el túnel Zrok y el entorno moderno funcionen correctamente, el servidor React debe estar corriendo **ANTES** de iniciar el túnel hacia el exterior, en el puerto `3000`.

**Comandos de la Terminal:**
```powershell
# 1. Navegar a la carpeta correcta
cd "D:\Documentos\Proyectos ADSO\project_jacquin\web_page\pages"

# 2. Levantar servidor local 
npm start
# o
npm run start
```
*Se montará la web transaccional en `http://localhost:3000`.*

## 3. 🛡️ Iniciar el Túnel Zrok (Enlace de Producción Local/Permanente)

El sistema de la academia puede evaluarse exteriormente mediante un túnel reverso estático proporcionado por Zrok, configurado específicamente para redireccionar al puerto 3000 de React.

### Credenciales y Parámetros
- **Ubicación del binario local Zrok:** `C:\zrok_1.1.10\zrok.exe`
- **Token Zrok / Subdominio Reservado:** `academiajacquin`
- **Link Público / Permanente de la Academia:** [https://academiajacquin.share.zrok.io](https://academiajacquin.share.zrok.io)
- **Batch de Automatización Local:** Ejecutar `iniciar_tunel.bat` en la raíz del proyecto.

### Protocolo de Activación
Habiéndonos asegurado de que el comando `npm start` se está ejecutando en una pestaña (paso 2):

```powershell
# 1. Volver o estar posicionado en la raíz de Jacquin
cd "D:\Documentos\Proyectos ADSO\project_jacquin"

# 2. Ejecutar el Batch de tunelizado
cmd.exe /c ".\iniciar_tunel.bat"
# Alternativa manual:
# "C:\zrok_1.1.10\zrok.exe" share reserved academiajacquin --override-endpoint http://localhost:3000
```
*NOTA: Un Error 502/HTTP en el enlace de zrok indica de inmediato que olvidaste o se cerró accidentalmente el servidor `npm start` de React.*
