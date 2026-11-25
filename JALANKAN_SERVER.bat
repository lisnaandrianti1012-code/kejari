@echo off
color 0A
title SERVER PAPAN KONTROL KEJARI

echo =====================================================================
echo           SERVER PAPAN INFORMASI KEJAKSAAN NEGERI
echo =====================================================================
echo.
echo Mencari Alamat IP Komputer...

for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /c:"IPv4 Address" /c:"Alamat IPv4"') do (
    set IP=%%a
)

set IP=%IP: =%

echo IP Komputer Induk : %IP%
echo.
echo ---------------------------------------------------------------------
echo 1. LINK UNTUK SMART TV (Buka di Browser Smart TV):
echo    http://%IP%:8000/display
echo.
echo 2. LINK UNTUK ADMIN / INPUT DATA (Buka di Laptop Pegawai):
echo    http://%IP%:8000/login
echo ---------------------------------------------------------------------
echo.
echo [PERHATIAN] JANGAN TUTUP JENDELA INI SELAMA TV DISPLAY MENYALA!
echo.
echo Menjalankan server...
php artisan serve --host=0.0.0.0 --port=8000
pause

