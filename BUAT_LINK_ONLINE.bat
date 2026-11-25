@echo off
color 0A
title PEMBUAT LINK ONLINE (HTTPS) - PAPAN KONTROL KEJARI

echo =====================================================================
echo          PEMBUAT LINK ONLINE RESMI (HTTPS)
echo       PAPAN INFORMASI KEJAKSAAN NEGERI KOTA TASIKMALAYA
echo =====================================================================
echo.
echo 1. Menjalankan server aplikasi di latar belakang...
start /B php artisan serve --host=127.0.0.1 --port=8000 > nul 2>&1

echo 2. Menghubungkan ke jalur online publik (HTTPS aman)...
echo.
echo ---------------------------------------------------------------------
echo PETUNJUK PENGGUNAAN:
echo - Tunggu sekitar 5-10 detik sampai muncul tulisan link https://...
echo - Salin link tersebut dan buka di:
echo     a) Browser Smart TV:  https://[link-anda]/display
echo     b) Laptop Staf/Admin: https://[link-anda]/login
echo - Link ini bisa dibuka DARI MANA SAJA (bahkan beda Wi-Fi / dari HP)!
echo - JANGAN TUTUP jendela ini selama link masih digunakan.
echo ---------------------------------------------------------------------
echo.

ssh -o StrictHostKeyChecking=no -R 80:localhost:8000 nokey@localhost.run

echo.
echo Jalur online terputus.
pause
