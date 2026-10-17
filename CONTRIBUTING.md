# 🤝 Panduan Kontribusi — News-5 Portal Berita

Terima kasih atas minat Anda untuk berkontribusi pada pengembangan **News-5**! Portal berita editorial dan sistem manajemen konten ini dikembangkan untuk menyediakan platform publikasi digital yang cepat, aman, dan mudah digunakan.

---

## 📌 Alur Kontribusi

### 1. Pelaporan Masalah (Bug Reports)
Jika Anda menemukan error pada autentikasi, rendering komponen Livewire komentar, upload gambar cover artikel, migrasi database, atau layout styling:
1. Periksa tab [Issues](https://github.com/Khoniv/news-5/issues) terlebih dahulu.
2. Buat issue baru dengan format:
   - **Judul Masalah**: Penjelasan ringkas.
   - **Langkah Reproduksi**: Urutan tindakan sebelum error muncul.
   - **Tangkapan Layar / Cuplikan Log**: Salin pesan error dari storage/logs/laravel.log atau console browser.
   - **Lingkungan Sistem**: Versi PHP, OS, dan browser yang digunakan.

### 2. Pengajuan Fitur Baru (Feature Requests)
Ingin mengusulkan fitur seperti integrasi rich-text editor baru (TinyMCE/CKEditor), multi-language artikel, pembaca berita audio berbasis AI, atau notifikasi push browser? Buka issue baru berlabel enhancement.

### 3. Mengirimkan Pull Request (PR)
1. Fork repositori ini ke akun GitHub Anda.
2. Buat branch baru dari main:
   `ash
   git checkout -b feature/fitur-keren
   `
3. Pastikan penulisan kode mematuhi standar PSR-12 dan konvensi Laravel:
   `ash
   ./vendor/bin/pint
   `
4. Jalankan pengujian unit / feature:
   `ash
   php artisan test
   `
5. Commit perubahan dengan pesan yang jelas dan deskriptif.
6. Push branch Anda dan ajukan **Pull Request** ke branch main.

---

## 🛠️ Standar Kode
- Gunakan Eloquent ORM untuk manipulasi database.
- Pisahkan logika front-end interaktif ke dalam komponen **Livewire** atau controller yang sesuai (pp/Http/Controllers/Front vs pp/Http/Controllers/Back).
- Hindari hardcoding teks antarmuka atau konfigurasi sensitif (gunakan file konfigurasi atau .env).

---

## 📬 Kontak
- **Pengembang**: Khonif Zakaria (NivDev)
- **GitHub**: [@Khoniv](https://github.com/Khoniv)
- **Email**: [oniefzk11@gmail.com](mailto:oniefzk11@gmail.com)