# Payroll Management System

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <strong>Sebuah sistem manajemen penggajian modern, aman, dan efisien yang dibangun di atas Laravel dan Filament.</strong>
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.2-777BB4.svg?style=flat-square" alt="PHP 8.2"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-10.x-FF2D20.svg?style=flat-square" alt="Laravel 10.x"></a>
  <a href="#"><img src="https://img.shields.io/badge/Filament-3.x-F59E0B.svg?style=flat-square" alt="Filament 3.x"></a>
  <a href="#"><img src="https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square" alt="License MIT"></a>
</p>

---

**Payroll Management System** adalah aplikasi web canggih yang dirancang untuk mengotomatiskan dan menyederhanakan proses penggajian yang kompleks. Dengan arsitektur yang kuat dan antarmuka pengguna yang intuitif, sistem ini menyediakan dua portal berbeda—satu untuk **Administrator** dengan kontrol penuh dan satu lagi untuk **Karyawan** dengan akses mandiri (self-service).

## ✨ Fitur Utama

Sistem ini dirancang dengan serangkaian fitur yang kuat untuk memenuhi kebutuhan manajemen SDM dan keuangan modern.

-   **🖥️ Portal Ganda (Dual Portal)**
    -   **Portal Admin:** Antarmuka komprehensif untuk mengelola seluruh aspek sistem, mulai dari data master hingga laporan akhir.
    -   **Portal Karyawan:** Antarmuka yang ramah pengguna bagi karyawan untuk mengakses informasi pribadi mereka, seperti slip gaji dan riwayat kehadiran.

-   **🗃️ Manajemen Data Terpusat**
    -   Mengelola data karyawan, jabatan, departemen, dan komponen gaji secara terstruktur dan mudah diakses.

-   **⚙️ Perhitungan Gaji Otomatis**
    -   Mesin kalkulasi canggih yang secara otomatis menghitung gaji berdasarkan data kehadiran, jabatan, tunjangan, potongan, dan variabel lainnya.

-   **📄 Generasi Slip Gaji**
    -   Membuat slip gaji dalam format PDF secara otomatis untuk setiap karyawan dan menyediakannya melalui portal karyawan untuk akses mandiri.

-   **📊 Laporan Komprehensif**
    -   Menyediakan berbagai laporan dinamis untuk keperluan administrasi, audit, dan analisis keuangan, yang dapat diekspor dengan mudah.

-   **🛡️ Keamanan & Kontrol Akses (RBAC)**
    -   Dibangun dengan mempertimbangkan keamanan, sistem ini menggunakan Role-Based Access Control (RBAC) melalui `Filament Shield` untuk memastikan pengguna hanya dapat mengakses data dan fitur yang sesuai dengan peran mereka.

-   **🎨 Tema "Secure Gateway" Kustom**
    -   Antarmuka pengguna yang dirancang khusus dengan tema gelap modern ("glassmorphism") untuk memberikan pengalaman visual yang konsisten dan profesional di seluruh aplikasi.

## 🛠️ Tumpukan Teknologi (Tech Stack)

Proyek ini dibangun menggunakan teknologi terbaru dan paling andal di ekosistem PHP.

-   **Backend:** PHP 8.2, Laravel 10
-   **Admin Panel & UI:** Filament 3.x, Livewire 3
-   **Frontend:** Tailwind CSS, Alpine.js, Vite
-   **Database:** Kompatibel dengan MySQL, PostgreSQL, SQLite

## 🚀 Panduan Instalasi & Setup

Ikuti langkah-langkah ini untuk menjalankan proyek di lingkungan lokal Anda.

### 1. Prasyarat
-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   Database (misalnya, MySQL, PostgreSQL)

### 2. Clone Repositori
```bash
git clone https://github.com/qoidrifat/payrolls.git
cd payrolls
```

### 3. Instalasi Dependensi
Instal dependensi PHP dan JavaScript.
```bash
# Instal dependensi backend
composer install

# Instal dependensi frontend
npm install
```

### 4. Konfigurasi Lingkungan (.env)
Salin file environment dan buat kunci aplikasi.
```bash
cp .env.example .env
php artisan key:generate
```
**Penting:** Buka file `.env` dan konfigurasikan koneksi database Anda (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

### 5. Migrasi & Seeding Database
Jalankan migrasi untuk membuat skema tabel dan (opsional) seeder untuk mengisi data awal.
```bash
php artisan migrate --seed
```

### 6. Kompilasi Aset Frontend
Jalankan server pengembangan Vite untuk mengkompilasi CSS dan JS secara real-time.
```bash
npm run dev
```
**Biarkan terminal ini tetap berjalan** saat Anda mengembangkan aplikasi.

### 7. Jalankan Server Lokal
Buka terminal baru dan jalankan server pengembangan Laravel.
```bash
php artisan serve
```
Aplikasi Anda sekarang dapat diakses di **http://127.0.0.1:8000**.

## 🔑 Akses Portal

-   **Halaman Utama (Gateway):**
    -   URL: `http://127.0.0.1:8000/`

-   **Portal Administrator:**
    -   URL: `http://127.0.0.1:8000/admin`
    -   Email: `admin@example.com`
    -   Password: `password`

-   **Portal Karyawan:**
    -   URL: `http://127.0.0.1:8000/karyawan`
    -   *Gunakan data karyawan yang dibuat melalui seeder atau portal admin.*

## 📄 Lisensi

Proyek ini berada di bawah Lisensi MIT. Lihat file [MIT License](https://opensource.org/licenses/MIT) untuk detail lebih lanjut.
