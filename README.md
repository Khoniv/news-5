# 📰 News-5 — Modern Editorial & Digital News Portal

<p align="center">
  <img src="public/logo.svg" width="180" alt="News-5 Logo">
</p>

<p align="center">
  <strong>Platform Portal Berita Digital Berbasis Laravel 11 dengan Desain Editorial Modern, Panel Backoffice Komprehensif, dan Sistem Komentar Interaktif.</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

---

## 📌 Daftar Isi
1. [Tentang Project](#-tentang-project)
2. [Fitur Utama](#-fitur-utama)
3. [Teknologi & Dependensi](#-teknologi--dependensi)
4. [Arsitektur & Struktur Direktori](#-arsitektur--struktur-direktori)
5. [Panduan Instalasi (Manual Book)](#-panduan-instalasi-manual-book)
6. [Kredensial Default](#-kredensial-default)
7. [Panduan Penggunaan Fitur](#-panduan-penggunaan-fitur)
8. [Perintah Artisan Penting](#-perintah-artisan-penting)
9. [Lisensi & Penulis](#-lisensi--penulis)

---

## 📖 Tentang Project

**News-5** adalah sistem portal berita (*content management system*) modern yang dirancang untuk kebutuhan publikasi media daring. Aplikasi ini menggabungkan antarmuka pembaca (*front-end*) bergaya editorial majalah berita kontemporer dengan panel pengelolaan (*backoffice*) yang responsif dan intuitif.

Dibangun dengan **Laravel 11**, arsitektur aplikasi ini memprioritaskan performa rendering cepat, struktur SEO yang rapi, keamanan role-based authentication, serta interaktivitas real-time pada kolom diskusi pembaca menggunakan **Laravel Livewire**.

---

## 🚀 Fitur Utama

### 🌐 Frontend (Portal Pembaca)
- **Desain Editorial Premium:** Tampilan elegan dengan navigasi sticky, top ticker, headline hero, dan dark/light friendly aesthetic.
- **Berita Populer & Rekomendasi:** Algoritma penyajian berita terpopuler berdasarkan total penayangan (*views*).
- **Filter Kategori Dinamis:** Pembaca dapat memfilter artikel berdasarkan topik/kategori secara instan.
- **Detail Artikel & Tipografi Optimal:** Desain ruang baca yang nyaman dilengkapi estimasi waktu baca, tanggal terbit, dan profil penulis.
- **Komentar Interaktif (Livewire):** Form komentar responsif tanpa reload halaman.
- **Pencarian Artikel:** Fitur pencarian cepat berdasarkan kata kunci judul maupun isi berita.
- **Halaman Profil Redaksi (About Us):** Informasi visi, misi, serta profil pengelola media.

### ⚙️ Backoffice (Panel Administrasi)
- **Dashboard Statistik:** Ringkasan total artikel, kategori, pengguna terdaftar, serta metrik performa konten.
- **Manajemen Artikel (CRUD):** Pembuatan berita dengan editor teks kaya, upload cover gambar, status draft/publish, dan slug otomatis.
- **Manajemen Kategori:** Pengelompokan topik artikel berita dengan validasi slug unik.
- **Manajemen Pengguna & Role:** Kontrol akses bertingkat:
  - `Role 1` : **Admin** (Akses penuh ke seluruh konfigurasi & konten)
  - `Role 2` : **User / Penulis** (Akses terbatas ke artikel dan komentar)
- **Konfigurasi Website:** Pengaturan nama portal, deskripsi SEO, favicon, logo, serta integrasi akun media sosial.

---

## 🛠️ Teknologi & Dependensi

- **Backend Framework:** [Laravel 11.x](https://laravel.com)
- **Runtime:** PHP 8.2+
- **Database:** MySQL / MariaDB
- **State Management & Interactivity:** [Laravel Livewire 3](https://livewire.laravel.com)
- **Frontend Styling:** Modern Vanilla CSS + Bootstrap 5
- **Assets Bundler:** Vite

---

## 📂 Arsitektur & Struktur Direktori

```text
news-5/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/             # Autentikasi Login, Register, Password Reset
│   │   │   ├── Back/             # Controller Admin (Article, Category, User, Config, Dashboard)
│   │   │   └── Front/            # Controller Portal Pembaca (Home, Article, Category, About)
│   │   ├── Middleware/           # UserAccess (Role-based access guard)
│   │   └── Requests/             # Form validation requests
│   ├── Livewire/                 # Komponen interaktif (Comment.php)
│   └── Models/                   # Eloquent Models (Article, Category, User, Config, Comment)
├── config/                       # Konfigurasi aplikasi & database
├── database/
│   ├── migrations/               # Skema database
│   └── seeders/                  # Seeder data awal & admin
├── public/
│   ├── back/css/                 # Styling khusus panel admin (admin-modern.css)
│   └── front/css/                # Styling antarmuka pembaca (editorial.css)
├── resources/
│   └── views/
│       ├── auth/                 # Antarmuka login & registrasi
│       ├── back/                 # Template & halaman Backoffice
│       └── front/                # Template & halaman Portal Pembaca
└── routes/
    └── web.php                   # Definisi seluruh rute aplikasi
```

---

## 💻 Panduan Instalasi (Manual Book)

Ikuti langkah-langkah berikut untuk menjalankan project ini di lingkungan lokal Anda:

### 1. Prasyarat Sistem
Pastikan perangkat Anda telah terpasang:
- **PHP** >= 8.2 (ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`)
- **Composer** (versi terbaru)
- **MySQL / MariaDB** (melalui Laragon, XAMPP, atau service mandiri)
- **Node.js & NPM** (disarankan v18 ke atas)
- **Git**

---

### 2. Clone Repository
```bash
git clone https://github.com/Khoniv/news-5.git
cd news-5
```

---

### 3. Instal Dependensi Composer
```bash
composer install
```

---

### 4. Konfigurasi Environment (`.env`)
Salin file konfigurasi contoh:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan koneksi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_5
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Generate Application Key
```bash
php artisan key:generate
```

---

### 6. Persiapan Database & Seeder
Buat database di MySQL dengan nama `news_5`, kemudian jalankan migrasi dan seeding data:
```bash
php artisan migrate --seed
```

---

### 7. Buat Symbolic Link Storage (Untuk Media & Gambar)
```bash
php artisan storage:link
```

---

### 8. Instal Dependensi Frontend (Opsional untuk Build)
```bash
npm install
npm run build
```

---

### 9. Jalankan Server Pengembangan
Jalankan server lokal Laravel:
```bash
php artisan serve
```
Buka browser dan akses:
- **Portal Pembaca (Front):** [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Panel Login Admin:** [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

---

## 🔑 Kredensial Default

Setelah menjalankan perintah `php artisan migrate --seed`, akun administrator default dapat digunakan untuk masuk:

| Role | Email | Password | Hak Akses |
|---|---|---|---|
| **Admin** | `admin@gmail.com` | `admin123` | Akses penuh dashboard, artikel, kategori, user, dan setelan web |

---

## 🧭 Panduan Penggunaan Fitur

### 1. Masuk ke Panel Admin
1. Akses rute `/login`.
2. Masukkan email dan password akun admin.
3. Anda akan diarahkan ke halaman `/dashboard`.

### 2. Mengelola Kategori Berita
1. Buka menu **Categories** pada sidebar.
2. Klik tombol **Tambah Kategori** untuk membuat topik berita baru.
3. Kategori yang dibuat akan otomatis muncul pada menu filter navigasi portal frontend.

### 3. Menerbitkan Artikel Baru
1. Buka menu **Articles** -> klik **Tambah Artikel**.
2. Masukkan judul berita, pilih kategori yang relevan, unggah cover gambar berita, dan tulis isi artikel.
3. Klik **Publish**. Artikel akan langsung tayang pada halaman beranda serta bagian berita terbaru.

### 4. Menyesuaikan Konfigurasi Web
1. Buka menu **Configurations**.
2. Perbarui nama portal berita, logo, favicon, email kontak, serta tautan akun media sosial.

---

## ⚡ Perintah Artisan Penting

| Perintah | Deskripsi |
|---|---|
| `php artisan serve` | Menjalankan web server lokal Laravel |
| `php artisan migrate:fresh --seed` | Mengatur ulang seluruh database dan mengisi ulang data dummy |
| `php artisan optimize:clear` | Menghapus seluruh cache (config, view, route) |
| `php artisan storage:link` | Menghubungkan direktori upload `storage/app/public` ke `public/storage` |

---

## 📄 Lisensi & Penulis

Project ini dilisensikan di bawah lisensi **[MIT License](LICENSE)**.

Dikembangkan oleh **[Khoniv](https://github.com/Khoniv)**.
