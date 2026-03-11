param (
    [string]$TargetProject = ""
)

# 0. Detectar Proyecto Objetivo
if ([string]::IsNullOrWhiteSpace($TargetProject)) {
    $TargetProject = Get-Location
}

if (!(Test-Path $TargetProject)) {
    Write-Host "Error: El directorio '$TargetProject' no existe." -ForegroundColor Red
    exit 1
}

$ProjectName = Split-Path -Leaf $TargetProject
Write-Host "Configurando entorno para: $ProjectName" -ForegroundColor Cyan

# 1. Configurar Identidad Global (Idempotente)
Write-Host "Verificando Git Global..." -ForegroundColor Cyan
if ((git config --global user.name) -ne "modusaxon-hub") {
    git config --global user.name "modusaxon-hub"
    git config --global user.email "modusaxon@gmail.com"
    git config --global credential.helper manager
}

# 2. Configurar Directorio Seguro Específico
Write-Host "Añadiendo directorio seguro..." -ForegroundColor Cyan
git config --global --add safe.directory $TargetProject

# 3. Enlaces Simbólicos Dinámicos (Solo si aplica XAMPP)
$xamppPath = "C:\xampp\htdocs\$ProjectName"
if (Test-Path "C:\xampp\htdocs") {
    Write-Host "Configurando Enlace Simbólico en XAMPP..." -ForegroundColor Cyan
    if (!(Test-Path $xamppPath)) {
        New-Item -ItemType SymbolicLink -Path $xamppPath -Target $TargetProject -Force
        Write-Host "Enlace creado: $xamppPath -> $TargetProject" -ForegroundColor Green
    } else {
        Write-Host "El enlace en XAMPP ya existe." -ForegroundColor Gray
    }
}

# 4. Verificar MySQL (Opcional)
Write-Host "Verificando acceso a MySQL..." -ForegroundColor Cyan
if (Get-Command mysql -ErrorAction SilentlyContinue) {
    mysql --version
} else {
    Write-Host "CUIDADO: MySQL no está en el PATH. Recuerda agregar C:\xampp\mysql\bin" -ForegroundColor Yellow
}

Write-Host "¡Entorno configurado con éxito!" -ForegroundColor Green
