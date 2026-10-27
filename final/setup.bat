@echo off
echo ========================================
echo   Setup Otomatis - Belajar SIBI
echo ========================================

echo.
echo [0/6] Perbaiki izin folder git (biar composer gak diblokir)...
call git config --global --add safe.directory "*"
call composer config audit.block-insecure false

echo.
echo [1/6] Install dependency PHP (composer)...
call composer install

echo.
echo [2/6] Menyiapkan file .env...
if not exist .env (
    copy .env.example .env
) else (
    echo .env sudah ada, dilewati.
)

echo.
echo [3/6] Membuat database SQLite kosong (jika belum ada)...
if not exist database\database.sqlite (
    type nul > database\database.sqlite
) else (
    echo database.sqlite sudah ada, dilewati.
)

echo.
echo [4/6] Generate APP_KEY...
call php artisan key:generate

echo.
echo [5/6] Migrasi + Seed database (buat tabel + akun admin/guru + konten SIBI)...
call php artisan migrate:fresh --seed

echo.
echo [6/6] Selesai! Menjalankan server...
echo   Admin/Kepala Sekolah : admin@SLB.id / SLB12345
echo   Guru                 : guru@SLB.id  / SLB12345
echo   Buka browser ke      : http://127.0.0.1:8000
echo ========================================
call php artisan serve
