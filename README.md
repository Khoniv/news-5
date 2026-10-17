<p align="center">
  <img src="public/logo.svg" width="180" alt="News-5 Logo">
</p>

<h1 align="center">📰 News-5 — Modern Editorial & Digital News Portal</h1>

<p align="center">
  <strong>Platform Portal Berita Digital Berbasis Laravel 11 dengan Desain Editorial Kontemporer, Panel Backoffice Komprehensif, dan Sistem Komentar Interaktif Real-Time.</strong>
</p>

<p align="center">
  <a href="https://github.com/Khoniv/news-5"><img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"></a>
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Vite-Bundler-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License MIT">
</p>

---

## 📌 Daftar Isi
1. [Tentang Proyek (About Project)](#-tentang-proyek-about-project)
2. [Fitur Utama](#-fitur-utama)
3. [Teknologi & Dependensi](#-teknologi--dependensi)
4. [Arsitektur & Struktur Direktori](#-arsitektur--struktur-direktori)
5. [Panduan Instalasi Cepat](#-panduan-instalasi-cepat)
6. [Kredensial Default](#-kredensial-default)
7. [Manual Book & Panduan Fitur](#-manual-book--panduan-fitur)
8. [Perintah Artisan Pemeliharaan](#-perintah-artisan-pemeliharaan)
9. [Kontribusi & Lisensi](#-kontribusi--lisensi)

---

## 📖 Tentang Proyek (About Project)

**News-5** adalah sistem portal berita digital (*Content Management System*) modern yang dirancang khusus untuk kebutuhan publikasi media daring profesional. Aplikasi ini menggabungkan antarmuka pembaca (*front-end*) bergaya majalah editorial kontemporer dengan ruang baca yang nyaman serta panel pengelolaan (*backoffice*) yang responsif, terstruktur, dan intuitif.

Dibangun dengan arsitektur modern **Laravel 11**, aplikasi ini memprioritaskan performa rendering cepat, struktur ramah SEO, keamanan autentikasi bertingkat (*Role-Based Access Control*), serta kolom komentar interaktif real-time tanpa reload halaman menggunakan **Laravel Livewire 3**.

---

## 🚀 Fitur Utama

### 🌐 Frontend (Portal Pembaca)
- **Desain Editorial Premium**: Navigasi sticky, ticker berita terkini, hero headline terpopuler, dan tipografi ramah mata.
- **Algoritma Berita Populer**: Penyajian artikel terpopuler secara otomatis berdasarkan jumlah pembaca (*views counter*).
- **Filter Topik Kategori Dinamis**: Pembaca dapat menyaring artikel berita berdasarkan kategori secara instan.
- **Ruang Baca Optimal**: Dilengkapi informasi jurnalis, tanggal publikasi, dan estimasi waktu baca artikel.
- **Komentar Real-Time (Livewire 3)**: Form diskusi dan komentar pembaca tanpa reload halaman.
- **Pencarian Cepat**: Mesin pencarian artikel berbasis kata kunci judul maupun isi berita.
- **Halaman Profil Redaksi (About Us)**: Visi, misi, dan kontak pengelola media.

### ⚙️ Backoffice (Panel Administrasi)
- **Dashboard Statistik**: Metrik total artikel yang diterbitkan, kategori, pengguna terdaftar, serta analitik pembaca.
- **Manajemen Artikel (CRUD)**: Editor teks kaya, upload gambar sampul, pemilihan kategori, auto-generate slug URL, dan status Draft/Publish.
- **Manajemen Kategori**: Pengelompokan berita dengan validasi slug unik otomatis.
- **Manajemen Pengguna & Peran (Role-Based Access Control)**:
  - Role 1 : **Admin** (Akses penuh ke seluruh konfigurasi, user, artikel, dan kategori).
  - Role 2 : **User / Penulis** (Akses terbatas ke artikel dan diskusi komentar).
- **Pengaturan Situs (Website Configuration)**: Pengaturan nama portal, deskripsi meta SEO, favicon, logo, dan integrasi tautan media sosial.

---

## 🛠️ Teknologi & Dependensi

| Komponen | Teknologi | Deskripsi |
|---|---|---|
| **Backend Framework** | [Laravel 11.x](https://laravel.com) | Modern PHP Web Framework |
| **Runtime Environment** | PHP 8.2+ / 8.3 | Minimum requirement PHP runtime |
| **Interactivity Layer** | [Laravel Livewire 3](https://livewire.laravel.com) | Dynamic UI tanpa reload halaman |
| **Database** | MySQL 8.x / MariaDB | Relational Database Management System |
| **Styling & UI** | Bootstrap 5 + Modern Vanilla CSS | Desain editorial responsif |
| **Asset Bundler** | [Vite](https://vitejs.dev/) | Lightning fast asset compilation |
| **Testing Suite** | [Pest PHP 3.x](https://pestphp.com/) | Elegant PHP testing framework |

---

## 📂 Arsitektur & Struktur Direktori

`	ext
news-5/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/             # Autentikasi Login, Register, Password Reset
│   │   │   ├── Back/             # Controller Admin (Article, Category, User, Config, Dashboard)
│   │   │   └── Front/            # Controller Portal Pembaca (Home, Article, Category, About)
│   │   ├── Middleware/           # UserAccess (Role-based access guard)
│   │   └── Requests/             # Form Request Validation rules
│   ├── Livewire/                 # Komponen Interaktif (Comment.php)
│   └── Models/                   # Eloquent Models (Article, Category, User, Config, Comment)
├── config/                       # Konfigurasi aplikasi & database
├── database/
│   ├── migrations/               # Skema migrasi database
│   └── seeders/                  # Seeder akun admin & data awal
├── public/
│   ├── back/css/                 # Styling khusus panel admin (admin-modern.css)
│   ├── front/css/                # Styling antarmuka pembaca (editorial.css)
│   ├── logo.svg                  # Brand logo News-5
│   └── storage/                  # Tautan symbolic media upload publik
├── resources/
│   └── views/
│       ├── auth/                 # Antarmuka login & registrasi
│       ├── back/                 # Template & halaman Backoffice Admin
│       └── front/                # Template & halaman Portal Pembaca
├── routes/
│   └── web.php                   # Definisi seluruh rute aplikasi
├── CONTRIBUTING.md               # Panduan kontribusi pengembang
├── LICENSE                       # Lisensi resmi (MIT)
├── MANUAL_BOOK.md                # Buku panduan lengkap pembaca, jurnalis, & admin
└── README.md                     # Dokumentasi utama repositori
`

---

## 💻 Panduan Instalasi Cepat

### 1. Prasyarat Sistem
Pastikan perangkat Anda telah terpasang:
- **PHP** >= 8.2 (ekstensi: pdo_mysql, mbstring, openssl, 	okenizer, xml, ctype, json, ileinfo)
- **Composer** (v2+)
- **MySQL / MariaDB**
- **Node.js & NPM** (Node v18+)
- **Git**

### 2. Clone Repositori
`ash
git clone https://github.com/Khoniv/news-5.git
cd news-5
`

### 3. Pasang Dependensi
`ash
composer install
npm install
`

### 4. Setup File .env
`ash
cp .env.example .env
php artisan key:generate
`
Sesuaikan koneksi database Anda di .env:
`env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_5
DB_USERNAME=root
DB_PASSWORD=
`

### 5. Migrasi & Seeder Database
Buat database bernama 
ews_5 di MySQL, lalu jalankan:
`ash
php artisan migrate --seed
`

### 6. Tautkan Direktori Penyimpanan Media
`ash
php artisan storage:link
`

### 7. Jalankan Server Lokal
`ash
php artisan serve
`
Buka browser Anda di:
- **Portal Berita (Frontend)**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Halaman Login Admin**: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

---

## 🔑 Kredensial Default

Setelah menjalankan migrasi dan seeder, akun administrator default berikut dapat langsung digunakan untuk masuk:

| Role | Email | Password | Hak Akses |
|---|---|---|---|
| **Admin** | dmin@gmail.com | dmin123 | Akses penuh dashboard, artikel, kategori, user, dan setelan portal |

---

## 📚 Manual Book & Panduan Fitur

> 📘 Buku panduan penggunaan lengkap untuk pembaca, jurnalis, editor, dan super admin tersedia di berkas **[MANUAL_BOOK.md](MANUAL_BOOK.md)**.

### Ringkasan Alur Penerbitan Berita:
1. Masuk ke panel admin di /login.
2. Buat topik kategori berita di menu **Categories** (jika belum ada).
3. Buka menu **Articles** -> klik **Tambah Artikel**.
4. Masukkan judul berita, pilih kategori, unggah foto sampul, tulis isi berita, lalu ubah status ke **Publish**.
5. Artikel akan otomatis tayang di halaman utama dan halaman kategori terkait.

---

## ⚡ Perintah Artisan Pemeliharaan

| Perintah | Deskripsi |
|---|---|
| php artisan serve | Menjalankan web server lokal Laravel |
| php artisan migrate:fresh --seed | Menyetel ulang seluruh skema database dan mengisi data contoh |
| php artisan optimize:clear | Menghapus seluruh cache (config, view, route, application) |
| php artisan storage:link | Menautkan folder penyimpanan publik untuk cover artikel |
| php artisan test | Menjalankan pengujian otomatis Pest PHP |

---

## 📄 Kontribusi & Lisensi

Proyek ini dilisensikan di bawah lisensi **[MIT License](LICENSE)**.

* **Pengembang**: **Khonif Zakaria** ([NivDev](https://github.com/Khoniv))
* **GitHub**: [@Khoniv](https://github.com/Khoniv)
* **Email**: [oniefzk11@gmail.com](mailto:oniefzk11@gmail.com)
* Panduan berkontribusi: **[CONTRIBUTING.md](CONTRIBUTING.md)**