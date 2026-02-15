# Configuración del Repositorio - Modus Axon

Este archivo contiene los comandos necesarios para gestionar el repositorio.

## 1. Trabajo Local (Sin autenticación)
Para hacer commits locales sin que Git pida cuenta de GitHub o tokens:

```powershell
# Configurar identidad (Solo una vez)
git config user.name "Manuel Pertuz"
git config user.email "manuel@ejemplo.com"

# Ciclo de trabajo
git add .
git commit -m "Descripción de los cambios"
```

## 2. Subir al Repositorio Remoto (Requiere Token)
Cuando decidas subir los cambios a GitHub, usa este comando para evitar que te pida la cuenta constantemente:

```powershell
# Reemplaza <TOKEN> y <USUARIO> con tus datos de GitHub
git remote set-url origin https://<USUARIO>:<TOKEN>@github.com/modusaxon-hub/modus_axon.git

# Subir cambios
git push -u origin main
```

---
*Nota: El token (PAT) se genera en GitHub > Settings > Developer settings > Personal access tokens.*