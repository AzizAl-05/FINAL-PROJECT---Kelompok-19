
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🏠 KosMas - Sistem Informasi Manajemen Kost Mahasiswa

KosMas merupakan aplikasi berbasis web yang dikembangkan untuk membantu proses pengelolaan rumah kos mahasiswa secara lebih efektif dan terintegrasi. Aplikasi ini memungkinkan pengelola untuk mengelola data kamar, fasilitas, penghuni, dan transaksi sewa, serta memudahkan calon penyewa dalam mencari dan memesan kamar secara online.

Project ini dikembangkan sebagai Final Project Mata Kuliah **Pemrograman Web**.

## 👥 Tim Pengembang

| Nama                        | NIM        |
| --------------------------- | ---------- |
| Abdul Aziz Al Palembani     | 0110225118 |
| Avicenna Zakiy Zuhair       | 0110225154 |
| Muhammad A'qib Hadziq       | 0110225151 |
| Azzidan Al'fatio Syachputra | 0110225173 |
| Muhammad Abror              | 0110225122 |

## ✨ Fitur Utama

* Registrasi dan Login Pengguna
* Dashboard Admin menggunakan Filament
* Manajemen Data Kamar
* Manajemen Tipe Kamar
* Manajemen Fasilitas
* Manajemen Penghuni
* Manajemen Transaksi Sewa
* Pencarian dan Filter Kamar
* Detail Kamar dan Fasilitas
* Pemesanan Kamar Secara Online
* Riwayat Penyewaan
* Pengelolaan Profil Pengguna
* Role-Based Access Control (RBAC)

## 🛠️ Teknologi yang Digunakan

* Laravel
* Filament Admin Panel
* MySQL
* Blade Template
* Tailwind CSS
* Spatie Laravel Permission
* Vite

## 🚀 Cara Menjalankan Project

### 1. Download Repository

Download repository ini dalam bentuk ZIP kemudian ekstrak ke komputer Anda.

### 2. Import Database

Keluarkan file database dari file zip yang sudah di ekstrak tadi lalu Import file database berikut ke MySQL/MariaDB menggunakan phpMyAdmin:

```text
sewa_kos_mhs.sql
```

### 3. Install Dependency

Buat 2 terminal pada folder project di vscode, kemudian jalankan perintah ini (satu terminal satu perintah):

```bash
composer install
npm install
```

### 4. Jalankan Aplikasi

```bash
php artisan storage:link 
php artisan serve
npm run dev
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

### 5. Informasi Akun

Akun Admin dan Petugas:

```Admin dan petugas
Email : 
admin@gmail.com
petugas@gmail.com
Password (untuk kedua akun) : 123
```

Untuk akses admin dan petugas berikan /admin/login pada url webnya

Akun User Biasa:

```text
Email :
wahyu@gmail.com
Password : 12345678
Atau silahkan coba daftarkan akun baru sendiri
```


## 📄 Lisensi

Project ini dikembangkan untuk keperluan akademik pada Mata Kuliah **Pemrograman Web**.

---

⭐ Jika project ini bermanfaat, jangan lupa berikan star pada repository ini.
