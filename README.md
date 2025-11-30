# Thrif - Sistem Manajemen Thrift Shop

**Thrif** adalah aplikasi manajemen toko thrift berbasis web yang dibangun menggunakan **Laravel**. Aplikasi ini menyediakan platform bagi pemilik toko untuk mengelola produk, kategori, dan pesanan, serta antarmuka publik bagi pelanggan untuk melihat katalog produk.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)

## 🚀 Fitur Utama

### 👥 Role & Akses
Sistem ini membagi pengguna menjadi dua peran utama:
*   **Admin**: Memiliki akses penuh ke dashboard untuk mengelola data master (produk, kategori) dan memantau pesanan.
*   **Customer**: Pengguna umum yang dapat mendaftar, login, melihat katalog produk, dan mengelola profil mereka.

### 🛠️ Fungsionalitas
*   **Dashboard Admin**: Statistik ringkas, manajemen produk (CRUD), manajemen kategori, dan daftar pesanan.
*   **Katalog Publik**: Tampilan produk yang menarik untuk pelanggan dengan fitur pencarian dan filter.
*   **Dark Mode**: Dukungan tema gelap yang nyaman di mata, otomatis menyesuaikan atau dapat diatur manual.
*   **Desain Responsif**: Tampilan yang optimal baik di perangkat desktop maupun mobile.

## ⚙️ Teknologi yang Digunakan

*   **Framework**: [Laravel 10/11](https://laravel.com)
*   **Full-stack Framework**: [Livewire](https://livewire.laravel.com) untuk interaktivitas dinamis tanpa meninggalkan PHP.
*   **Styling**: [Tailwind CSS](https://tailwindcss.com) untuk desain antarmuka yang modern dan kustom.
*   **JavaScript**: [Alpine.js](https://alpinejs.dev) untuk interaksi ringan di sisi klien.

## 💻 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/thrif.git
    cd thrif
    ```

2.  **Install Dependensi**
    Pastikan Anda telah menginstal PHP dan Composer, serta Node.js.
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Migration & Seeding**
    Jalankan migrasi untuk membuat tabel database dan seeder untuk data awal (termasuk akun admin default).
    ```bash
    php artisan migrate --seed
    ```
    > **Catatan**: Seeder akan membuat akun admin default:
    > *   Email: `admin@thrif.test`
    > *   Password: `password`

5.  **Jalankan Server**
    Anda perlu menjalankan server PHP dan build asset (Vite) secara bersamaan (di terminal terpisah).
    ```bash
    php artisan serve
    ```
    ```bash
    npm run dev
    ```

6.  **Akses Aplikasi**
    Buka browser dan kunjungi `http://localhost:8000`.

## 📝 Lisensi

Proyek ini adalah perangkat lunak open-source di bawah lisensi [MIT license](https://opensource.org/licenses/MIT).
