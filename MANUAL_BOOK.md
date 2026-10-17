# 📖 BUKU PANDUAN PENGGUNA (MANUAL BOOK)
# NEWS-5 — Portal Berita Digital & Editorial CMS Modern

<p align="center">
  <img src="public/logo.svg" width="180" alt="News-5 Logo">
</p>

---

## 📑 DAFTAR ISI
1. [Pendahuluan](#1-pendahuluan)
2. [Spesifikasi & Prasyarat Sistem](#2-spesifikasi--prasyarat-sistem)
3. [Panduan Instalasi & Konfigurasi Lokal](#3-panduan-instalasi--konfigurasi-lokal)
4. [Struktur Pengguna & Hak Akses (Role-Based Access)](#4-struktur-pengguna--hak-akses-role-based-access)
5. [Panduan Pembaca (Frontend Guide)](#5-panduan-pembaca-frontend-guide)
   - [5.1 Menjelajahi Berita Beranda & Headline](#51-menjelajahi-berita-beranda--headline)
   - [5.2 Filter Kategori Berita](#52-filter-kategori-berita)
   - [5.3 Membaca Artikel & Waktu Baca](#53-membaca-artikel--waktu-baca)
   - [5.4 Mengirim Komentar Interaktif (Livewire)](#54-mengirim-komentar-interaktif-livewire)
   - [5.5 Pencarian Cepat Berita](#55-pencarian-cepat-berita)
6. [Panduan Penulis & Editor (Backoffice Guide)](#6-panduan-penulis--editor-backoffice-guide)
   - [6.1 Masuk ke Panel Administrasi](#61-masuk-ke-panel-administrasi)
   - [6.2 Mengelola Kategori Berita](#62-mengelola-kategori-berita)
   - [6.3 Menulis & Menerbitkan Artikel Baru](#63-menulis--menerbitkan-artikel-baru)
   - [6.4 Mengedit & Menghapus Artikel](#64-mengedit--menghapus-artikel)
7. [Panduan Administrator (Super Admin Guide)](#7-panduan-administrator-super-admin-guide)
   - [7.1 Manajemen Pengguna & Hak Akses](#71-manajemen-pengguna--hak-akses)
   - [7.2 Pengaturan Identitas Portal (Configurations)](#72-pengaturan-identitas-portal-configurations)
   - [7.3 Manajemen Diskusi & Komentar](#73-manajemen-diskusi--komentar)
8. [Perintah Artisan Pemeliharaan Sistem](#8-perintah-artisan-pemeliharaan-sistem)
9. [Troubleshooting & Solusi Kendala](#9-troubleshooting--solusi-kendala)

---

## 1. PENDAHULUAN

**News-5** adalah sistem portal berita digital dan *Content Management System* (CMS) kontemporer yang dibangun menggunakan arsitektur **Laravel 11**, **PHP 8.2+**, **Laravel Livewire 3**, dan **Bootstrap 5**.

Aplikasi ini menggabungkan antarmuka pembaca (*front-end*) bergaya majalah editorial modern dengan ruang baca optimal serta panel administrasi redaksi (*backoffice*) yang responsif, aman, dan intuitif.

---

## 2. SPESIFIKASI & PRASYARAT SISTEM

Sebelum memasang News-5 di server atau komputer pengembang, pastikan lingkungan sistem memenuhi kriteria berikut:

| Perangkat Lunak | Versi yang Didukung | Keterangan |
| :--- | :--- | :--- |
| **PHP** | 8.2 atau 8.3+ | Ekstensi wajib: pdo_mysql, mbstring, openssl, xml, ctype, json, ileinfo |
| **Composer** | Versi 2.x | Dependensi manajer PHP |
| **Database** | MySQL 8.x / MariaDB 10.4+ | Penyimpanan data relasional |
| **Node.js & NPM** | Node v18+ & NPM v9+ | Kompilasi aset Vite & Tailwind/Bootstrap |
| **Web Server** | Nginx / Apache / PHP Built-in | Server web |

---

## 3. PANDUAN INSTALASI & KONFIGURASI LOKAL

### Langkah 1: Clone Repositori
`ash
git clone https://github.com/Khoniv/news-5.git
cd news-5
`

### Langkah 2: Pasang Dependensi Composer
`ash
composer install
`

### Langkah 3: Setup File Environment
Salin file konfigurasi contoh:
`ash
cp .env.example .env
`
Buka file .env dan atur detail database Anda:
`env
APP_NAME=News-5
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_5
DB_USERNAME=root
DB_PASSWORD=
`

### Langkah 4: Generate Kunci Enkripsi Aplikasi
`ash
php artisan key:generate
`

### Langkah 5: Migrasi Database & Seeder
Buat database kosong bernama 
ews_5 di MySQL (lewat phpMyAdmin atau CLI MySQL), lalu jalankan:
`ash
php artisan migrate --seed
`

### Langkah 6: Tautkan Direktori Penyimpanan Berkas (Storage Link)
`ash
php artisan storage:link
`
> Perintah ini sangat penting agar gambar sampul artikel yang diunggah ke storage/app/public dapat diakses oleh publik melalui public/storage.

### Langkah 7: Pasang & Bangun Aset Frontend
`ash
npm install
npm run build
`

### Langkah 8: Menjalankan Server Pengembangan
`ash
php artisan serve
`
Akses portal melalui browser di **[http://127.0.0.1:8000](http://127.0.0.1:8000)**.

---

## 4. STRUKTUR PENGGUNA & HAK AKSES (ROLE-BASED ACCESS)

News-5 mengimplementasikan perlindungan rute berbasis middleware UserAccess:

| Role ID | Nama Peran | Hak Akses Utama |
| :---: | :--- | :--- |
| 1 | **Administrator** | Akses penuh: Dashboard analitik, manajemen seluruh artikel, kategori, pengguna/penulis, moderasi komentar, dan setelan konfigurasi situs. |
| 2 | **Penulis / User** | Akses menulis artikel baru, melihat status publikasi artikel pribadi, dan berpartisipasi dalam diskusi komentar. |

---

## 5. PANDUAN PEMBACA (FRONTEND GUIDE)

### 5.1 Menjelajahi Berita Beranda & Headline
* **Top Bar / Ticker**: Menampilkan pembaruan waktu dan tanggal secara *real-time*.
* **Hero Headline**: Berita sorotan utama hari ini dengan gambar resolusi tinggi dan judul menonjol.
* **Berita Populer**: Kolom sisi kanan yang menyajikan artikel dengan jumlah pembaca (*viewers*) terbanyak.

### 5.2 Filter Kategori Berita
Klik pada salah satu nama kategori di menu navigasi atas (contoh: *Teknologi*, *Bisnis*, *Gaya Hidup*, *Otomotif*) untuk menyaring artikel berdasarkan topik tersebut secara otomatis.

### 5.3 Membaca Artikel & Waktu Baca
Setiap artikel dilengkapi dengan informasi metadata:
* Estimasi durasi membaca (contoh: *3 menit baca*).
* Nama jurnalis / penulis artikel.
* Tanggal publikasi.
* Total penayangan (*views*).

### 5.4 Mengirim Komentar Interaktif (Livewire)
1. Gulir ke bagian bawah artikel untuk menemukan kolom komentar.
2. Masukkan nama atau masuk dengan akun Anda, lalu tulis komentar pada formulir.
3. Klik tombol **Kirim Komentar**. Komentar akan langsung muncul tanpa memuat ulang (*refresh*) halaman berkat teknologi **Laravel Livewire 3**.

### 5.5 Pencarian Cepat Berita
Gunakan bilah pencarian pada navbar atas untuk mencari artikel berdasarkan kata kunci judul maupun ringkasan isi berita.

---

## 6. PANDUAN PENULIS & EDITOR (BACKOFFICE GUIDE)

### 6.1 Masuk ke Panel Administrasi
1. Akses halaman /login.
2. Masukkan email dan password admin:
   - **Email**: dmin@gmail.com
   - **Password**: dmin123
3. Anda akan diarahkan ke halaman **Dashboard** statistik ringkasan publikasi.

### 6.2 Mengelola Kategori Berita
1. Pilih menu **Categories** di sidebar panel admin.
2. Klik tombol **Tambah Kategori** (*Create Category*).
3. Ketikkan nama kategori. Kolom *slug* URL akan terisi otomatis.
4. Klik **Simpan**. Kategori baru akan langsung tampil di bilah navigasi portal pembaca.

### 6.3 Menulis & Menerbitkan Artikel Baru
1. Buka menu **Articles** -> klik **Tambah Artikel** (*Create Article*).
2. Isi kolom formulir:
   - **Judul Artikel**: Masukkan judul berita yang informatif dan menarik.
   - **Kategori**: Pilih topik kategori artikel.
   - **Gambar Sampul (Cover Image)**: Unggah gambar berita (format JPG/PNG/WebP).
   - **Isi Artikel**: Tulis konten berita menggunakan editor teks.
   - **Status Publikasi**: Pilih Publish agar langsung tayang, atau Draft untuk menyimpan sementara.
3. Klik **Simpan**. Artikel baru langsung diterbitkan.

### 6.4 Mengedit & Menghapus Artikel
1. Buka daftar artikel di menu **Articles**.
2. Klik ikon pena (*Edit*) untuk memperbarui teks atau mengganti gambar sampul.
3. Klik ikon sampah (*Delete*) untuk menghapus artikel dari sistem.

---

## 7. PANDUAN ADMINISTRATOR (SUPER ADMIN GUIDE)

### 7.1 Manajemen Pengguna & Hak Akses
1. Akses menu **Users** di sidebar.
2. Administrator dapat menambahkan akun penulis baru, mengubah peran pengguna (Role 1 / Role 2), mereset kata sandi, atau menonaktifkan akun.

### 7.2 Pengaturan Identitas Portal (Configurations)
1. Buka menu **Configurations**.
2. Anda dapat menyesuaikan:
   - Nama Portal Berita (site_name).
   - Deskripsi Singkat untuk Meta SEO.
   - Logo dan Favicon situs.
   - Email resmi redaksi dan nomor kontak.
   - Tautan media sosial (Facebook, Twitter/X, Instagram, YouTube).

---

## 8. PERINTAH ARTISAN PEMELIHARAAN SISTEM

| Perintah Artisan | Kegunaan |
| :--- | :--- |
| php artisan optimize:clear | Menghapus seluruh cache (konfigurasi, rute, view Blade, dan cache aplikasi). |
| php artisan storage:link | Menghubungkan direktori penyimpanan media lokal ke folder public. |
| php artisan migrate:fresh --seed | Menyetel ulang struktur database dan mengisi kembali akun default & kategori awal. |
| php artisan test | Menjalankan seluruh pengujian unit dan fungsional Pest PHP. |

---

## 9. TROUBLESHOOTING & SOLUSI KENDALA

### Q1: Gambar sampul artikel tidak muncul di halaman pembaca (404 Not Found)?
> **Solusi**: Pastikan Anda telah menjalankan perintah php artisan storage:link. Periksa apakah folder public/storage sudah menunjuk ke storage/app/public.

### Q2: Muncul pesan error "SQLSTATE[HY000] [1049] Unknown database 'news_5'"?
> **Solusi**: Buat database bernama 
ews_5 di MySQL melalui phpMyAdmin atau jalankan CREATE DATABASE news_5; pada konsol MySQL sebelum menjalankan php artisan migrate.

### Q3: Fitur komentar Livewire tidak merespons klik?
> **Solusi**: Pastikan direktif @livewireStyles dan @livewireScripts ada pada template layout Blade utama dan aset JS Livewire dapat dimuat tanpa terblokir CSP.