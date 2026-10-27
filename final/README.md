# 🤟 Belajar SIBI — Laravel App

Aplikasi pembelajaran Bahasa Isyarat Indonesia (SIBI) untuk anak tunarungu.
Dibangun dengan **Laravel 11**, **Tailwind CSS CDN**, dan **SQLite** — tidak perlu npm/Vite.

---

## 🚀 Cara Install (Laragon / XAMPP / php artisan serve)

### Langkah 1 — Ekstrak & masuk folder
```bash
# Ekstrak zip, lalu masuk ke folder
cd sibi-laravel
```

### Langkah 2 — Install dependencies PHP
```bash
composer install
```

### Langkah 3 — Setup environment
```bash
# Salin .env (sudah ada, skip jika sudah ada)
cp .env.example .env

# Generate app key
php artisan key:generate
```

### Langkah 4 — Buat database SQLite
```bash
# Buat file database (SQLite, tidak perlu MySQL)
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"

# Atau di Windows:
type nul > database\database.sqlite
```

### Langkah 5 — Migrate & seed data
```bash
php artisan migrate --force
php artisan db:seed --force
```

### Langkah 6 — Jalankan server
```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## 🔑 Akun Default (setelah seeding)

| Role  | Email           | Password  |
|-------|-----------------|-----------|
| Admin | admin@sibi.id   | admin123  |

---

## 📁 Struktur File Penting

```
sibi-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/AuthController.php       ← Login, Register, Logout
│   │   │   ├── Frontend/
│   │   │   │   ├── HomeController.php        ← Halaman beranda
│   │   │   │   ├── ModulController.php       ← Modul angka/keluarga/benda/sapaan
│   │   │   │   └── KuisController.php        ← Kuis 5 level
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php   ← Dashboard admin
│   │   │       ├── KontenController.php      ← CRUD konten SIBI
│   │   │       └── SiswaController.php       ← Kelola siswa
│   │   └── Middleware/AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── KontenSibi.php                    ← Data kartu belajar
│       ├── SoalKuis.php                      ← Soal kuis per level
│       └── HasilKuisSibi.php                 ← Hasil kuis siswa
│
├── database/
│   ├── migrations/                           ← Tabel database
│   ├── seeders/DatabaseSeeder.php            ← Data awal (21 angka, dll)
│   └── database.sqlite                       ← Database (dibuat saat setup)
│
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php                     ← Layout utama (navbar + footer)
│   │   └── admin.blade.php                   ← Layout admin (sidebar)
│   ├── auth/
│   │   ├── login.blade.php                   ← Halaman login
│   │   └── register.blade.php                ← Halaman daftar
│   ├── frontend/
│   │   ├── home.blade.php                    ← Beranda
│   │   ├── modul.blade.php                   ← Modul belajar (slider kartu)
│   │   └── kuis.blade.php                    ← Kuis interaktif 5 level
│   └── admin/
│       ├── dashboard.blade.php               ← Dashboard admin
│       ├── konten/                           ← CRUD konten SIBI
│       └── siswa/                            ← Data siswa
│
├── routes/web.php                            ← Semua route URL
└── public/
    └── assets/gifs/                          ← Taruh file GIF di sini!
        ├── angka/    (angka-0.gif s.d. angka-20.gif)
        ├── keluarga/ (ayah.gif, ibu.gif, dll.)
        ├── benda/    (pensil.gif, buku.gif, dll.)
        ├── sapaan/   (pagi.gif, halo.gif, dll.)
        └── kuis/     (q1.gif s.d. q30.gif)
```

---

## 🌐 Daftar URL

| URL                     | Halaman                  |
|-------------------------|--------------------------|
| `/`                     | Beranda                  |
| `/login`                | Login                    |
| `/register`             | Daftar                   |
| `/modul/angka`          | Modul Angka (0–20)       |
| `/modul/keluarga`       | Modul Keluarga           |
| `/modul/benda`          | Modul Benda Sekolah      |
| `/modul/sapaan`         | Modul Kata Sapaan        |
| `/kuis`                 | Kuis 5 Level             |
| `/admin`                | Dashboard Admin          |
| `/admin/konten`         | Kelola Konten SIBI       |
| `/admin/siswa`          | Data Siswa               |

---

## 🖼️ Cara Tambah GIF

1. Taruh file GIF di `public/assets/gifs/[kategori]/`
2. Buka admin panel → **Konten SIBI** → Edit
3. Isi kolom **Path File GIF**, contoh: `/assets/gifs/angka/angka-5.gif`

Atau langsung isi saat seed di `database/seeders/DatabaseSeeder.php`.

---

## 🛠️ Tips Laragon

Jika pakai **Laragon**:
1. Taruh folder `sibi-laravel` di `C:\laragon\www\`
2. Ikuti langkah setup di atas via terminal Laragon
3. Akses via `php artisan serve` atau `http://sibi-laravel.test` (auto-virtual host Laragon)

---

## ❗ Troubleshooting

**Error: `No application encryption key`**
```bash
php artisan key:generate
```

**Error: `database/database.sqlite does not exist`**
```bash
touch database/database.sqlite   # Linux/Mac
type nul > database\database.sqlite  # Windows
php artisan migrate --force
```

**Error: `Class not found`**
```bash
composer dump-autoload
```

**Session error**
```bash
php artisan migrate --force   # pastikan tabel sessions ada
```
