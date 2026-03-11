@echo off
setlocal
echo ================================================
echo       ZROK - JACQUIN ACADEMIA MUSICAL
echo       Enlace Permanente: lsw34loontpx
echo       Puerto XAMPP: 8080
echo ================================================
echo.

set ZROK_EXE=C:\zrok_1.1.10\zrok.exe
set SHARE_TOKEN=lsw34loontpx

REM [1/2] Verificando XAMPP
echo [1/2] Verificando XAMPP (Puerto 8080)...
netstat -ano | findstr :8080 | findstr LISTENING >nul
if %errorlevel% neq 0 (
    echo [ERROR] Apache no parece estar corriendo en el puerto 8080.
    echo Asegurate de que XAMPP este funcionando.
    pause
    exit /b
)
echo OK: Apache detectado en puerto 8080.
echo.

REM [2/2] Iniciando zrok
echo [2/2] Iniciando zrok con enlace permanente...
echo.
echo ======================================================================
echo  URL DE INICIO: https://%SHARE_TOKEN%.share.zrok.io/web_page/
echo ======================================================================
echo.
echo MANTEN ESTA VENTANA ABIERTA mientras uses el acceso remoto.
echo Para detenerlo, presiona Ctrl+C o cierra esta ventana.
echo.

"%ZROK_EXE%" share reserved %SHARE_TOKEN%

if %errorlevel% neq 0 (
    echo.
    echo ================================================
    echo [ERROR] No se pudo conectar con zrok.
    echo ================================================
    pause
)