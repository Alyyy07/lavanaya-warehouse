# 🏭 WAREHOUSE MANAGEMENT SYSTEM

[![Recruitment Test](https://img.shields.io/badge/Project-Recruitment_Test-blue?style=for-the-badge)](https://github.com/Alyyy07/lavanaya-warehouse)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Tailwind](https://img.shields.io/badge/Tailwind-4.x-38bdf8?style=for-the-badge&logo=tailwindcss)](https://tailwindcss.com)

Aplikasi ini adalah Sistem Manajemen Gudang (WMS) yang dikembangkan sebagai **Tes Rekrutmen Programmer di PT Lavanaya Madinah Travel**. Proyek ini menggunakan **Laravel 12** dan **Tailwind CSS v4**.

---

## Akses

- **Email**: `admin@warehouse.com`
- **Password**: `password`

---

## ✨ Fitur Utama

### 1. Master Data Terpadu

- **Kelola Supplier & Lokasi**: Manajemen supplier dan informasi logistik dalam satu tempat
- **Katalog Produk Lengkap**: Daftar produk dengan kode unik, stok, dan foto produk

### 2. Tracking & Monitoring Stok

- **Pencatatan Barang Masuk**: Catat setiap barang yang masuk dari supplier
- **Pencatatan Barang Keluar**: Catat pengiriman barang dengan validasi stok otomatis

### 3. Dashboard & Laporan

- **Dashboard Real-time**: Pantau stok kritis, ringkasan transaksi harian, dan nilai total aset
- **Export Laporan**: Buat laporan dalam format **Excel** dan **PDF**

---

## 🛠️ Spesifikasi Teknis

| Komponen             | Teknologi                    |
| :------------------- | :--------------------------- |
| **Backend Engine**   | Laravel 12                   |
| **Runtime**          | PHP 8.2+                     |
| **Database**         | MySQL                        |
| **Interactivity**    | Alpine.js (State Management) |

---

##  Instalasi Lokal

### 1. Project Setup

```bash
git clone https://github.com/Alyyy07/lavanaya-warehouse.git
cd lavanaya-warehouse
composer install
npm install
```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Konfigurasi database sesuai kebutuhan di file `.env`. Detail environment variables sudah tersedia di `.env.example`.

### 3. Database Migration & Seeding

```bash
php artisan migrate --seed
```

**Database Seeder:**

- **AdminSeeder**: Membuat user admin default
    - Email: `admin@warehouse.com`
    - Password: `password`

### 4. Asset Building

```bash
npm run build
```

### 5. Launching

```bash
# Terminal A: Backend Server
php artisan serve

# Terminal B: Frontend Development Server
npm run dev
```

---
