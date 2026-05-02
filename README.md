# ☕ Lav Cafe

Lav Cafe adalah platform e-commerce dan katalog digital untuk sebuah kedai kopi (cafe) modern. Dibangun menggunakan framework Laravel, website ini menyediakan antarmuka pengguna (frontend) yang elegan dan responsif, serta panel admin (backend) yang kuat untuk mengelola produk, pesanan, dan ulasan pelanggan.

## ✨ Fitur Utama

- **Katalog & Detail Produk:** Menampilkan daftar produk dengan desain yang memukau. Halaman detail produk dilengkapi dengan galeri gambar dan daftar komposisi (ingredients).
- **Shopping Cart (Keranjang Belanja):** Sistem keranjang belanja berbasis _client-side_ menggunakan Alpine.js dan session/local storage, lengkap dengan komponen UI _slide-over_.
- **Checkout via WhatsApp:** Integrasi langsung yang memungkinkan pelanggan mengirimkan detail pesanan keranjang mereka langsung ke WhatsApp admin/kasir.
- **Sistem Ulasan (Review):** Pelanggan dapat melihat ulasan produk dengan fitur _star rating_ dan avatar inisial otomatis.
- **Slider Promosi:** Banner promosi interaktif dan responsif di halaman beranda menggunakan Swiper.js.
- **Admin Panel Premium:** Backend panel menggunakan Filament dengan kustomisasi halaman login (Split-screen design) yang disesuaikan dengan branding cafe.
- **UI/UX Modern:** Desain antarmuka premium dengan efek _glassmorphism_, palet warna yang elegan (termasuk pink, white, dan warna bertema kopi), serta optimalisasi animasi.

## 🛠️ Teknologi & Library yang Digunakan

**Backend:**
- [Laravel](https://laravel.com/) (Framework PHP)
- [Filament](https://filamentphp.com/) (Admin Panel)
- [Livewire](https://laravel-livewire.com/) (Komponen interaktif untuk Filament)

**Frontend:**
- [Tailwind CSS v4](https://tailwindcss.com/) (Styling & Utility-first CSS)
- [Alpine.js](https://alpinejs.dev/) (Reaktivitas UI & State Management Keranjang Belanja)
- [Swiper.js](https://swiperjs.com/) (Slider Banner Promosi & Ulasan)
- [Vite](https://vitejs.dev/) (Frontend Build Tool)

## 📂 Struktur Project

Berikut adalah gambaran umum dari struktur direktori utama di dalam project ini:

```text
lav-cafe/
├── app/
│   ├── Http/Controllers/     # Logika aplikasi (Frontend Controllers)
│   ├── Models/               # Representasi tabel database
│   └── Filament/             # Resources untuk halaman admin panel
├── database/
│   ├── migrations/           # Skema tabel database
│   └── seeders/              # Data awal (dummy/initial data)
├── public/                   # File publik (gambar, build assets Vite)
├── resources/
│   ├── css/                  # File CSS utama (Tailwind)
│   ├── js/                   # File JavaScript utama
│   └── views/
│       ├── components/       # Komponen Blade UI (Navbar, Product Card, dll)
│       ├── frontend/         # Halaman untuk pengunjung (Home, Catalog, Detail)
│       └── ...
├── routes/
│   └── web.php               # Definisi rute URL website
└── ...
```

## 🚀 Cara Install & Menjalankan Project (Lokal)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

1. **Clone repositori ini:**
   ```bash
   git clone <url-repo-ini>
   cd lav-cafe
   ```

2. **Install dependensi PHP (Composer):**
   ```bash
   composer install
   ```

3. **Install dependensi Node.js (NPM):**
   ```bash
   npm install
   ```

4. **Siapkan konfigurasi environment:**
   Salin file `.env.example` menjadi `.env`.
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi Database:**
   Buka file `.env` dan sesuaikan konfigurasi database Anda (misalnya MySQL atau SQLite).
   Contoh jika menggunakan database lokal MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lav_cafe
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Jalankan Migrasi & Seeder Database:**
   Buat tabel database dan masukkan data awal.
   ```bash
   php artisan migrate --seed
   ```

8. **Buat Symlink untuk Storage (Penting untuk gambar produk):**
   ```bash
   php artisan storage:link
   ```

9. **Jalankan Server Development:**
   Jalankan server PHP lokal dan Vite untuk _hot-reloading_ aset frontend secara bersamaan.
   
   Buka terminal pertama:
   ```bash
   php artisan serve
   ```
   
   Buka terminal kedua:
   ```bash
   npm run dev
   ```
   Atau jika menggunakan command bawaan yang ada di composer:
   ```bash
   composer run dev
   ```

10. **Akses Website:**
    - Frontend (Katalog Cafe): [http://127.0.0.1:8000](http://127.0.0.1:8000)
    - Admin Panel (Filament): [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin) *(Catatan: URL admin dapat berbeda sesuai konfigurasi `filament.php`)*

---

*Dikembangkan untuk memberikan pengalaman digital kafe yang memukau.*
