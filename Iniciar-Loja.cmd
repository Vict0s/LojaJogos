@echo off
setlocal
cd /d "%~dp0"
set "PHPRC=%~dp0php.ini"
set "PHP_EXE=%LOCALAPPDATA%\Microsoft\WinGet\Packages\PHP.PHP.8.4_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"
if not exist "%PHP_EXE%" set "PHP_EXE=php"
echo A iniciar a Loja de Jogos em http://127.0.0.1:8000
start "" http://127.0.0.1:8000
"%PHP_EXE%" artisan serve --host=127.0.0.1 --port=8000
pause
