@echo off
REM === CONFIGURACION ===
set DB_USER=root
set DB_PASS=root 
set DB_NAME=db_inventory
set BACKUP_DIR=backups
set DATE=%DATE:~6,4%-%DATE:~3,2%-%DATE:~0,2%_%TIME:~0,2%%TIME:~3,2%%TIME:~6,2%
set DATE=%DATE: =0%
set DUMP_FILE=%BACKUP_DIR%\db_backup_%DB_NAME%_%DATE%.sql
set FILES_BACKUP=%BACKUP_DIR%\files_backup_%DATE%.zip

REM === CREAR CARPETA DE BACKUP ===
if not exist %BACKUP_DIR% mkdir %BACKUP_DIR%

REM === RESPALDAR BASE DE DATOS ===
"C:\laragon\bin\mysql\mysql-5.7.24-winx64\bin\mysqldump.exe" -u%DB_USER% -p%DB_PASS% %DB_NAME% > "%DUMP_FILE%"

REM === RESPALDAR ARCHIVOS DEL SISTEMA ===
powershell Compress-Archive -Path * -DestinationPath "%FILES_BACKUP%" -Force -CompressionLevel Optimal -Exclude %BACKUP_DIR%,backup.bat

echo Backup completado.
pause
