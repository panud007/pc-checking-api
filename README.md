# ⚙️ Hardware Checker API (PC Checking Backend)

[![Laravel Version](https://img.shields.io/badge/laravel-v10.x-red.svg?logo=laravel)](https://laravel.com/)
[![PHP Version](https://img.shields.io/badge/php-v8.2-777bb4.svg?logo=php)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Hardware Checker API adalah backend RESTful API berbasis framework Laravel yang dirancang untuk mendukung sistem penyimpanan data pengujian perangkat keras (*diagnostic reports*) dan pendaftaran unit masuk (*service intake*) dari aplikasi frontend **PC Quick Diagnostic Tool**.

---

## 🚀 Fitur Utama (Core Features)

* **RESTful API Endpoints**: Menyediakan endpoint untuk menyimpan, membaca, dan menghapus riwayat pemeriksaan hardware serta form intake unit.
* **Auto Cast Attributes**: Secara otomatis mengonversi data spesifikasi komputer, hasil tes tombol, dan pilihan servis (array) menjadi data JSON di database.
* **Structured Service Intake Data**: Mencatat data terperinci seperti processor, GPU, RAM, tipe storage, serta kerusakan inti unit.
* **Seamless Integration**: Siap dihubungkan langsung dengan frontend React/Vite.

---

## 🛠️ Spesifikasi Teknologi (Tech Stack)

* **Framework**: [Laravel 10.x](https://laravel.com/)
* **Language**: [PHP 8.2+](https://www.php.net/)
* **Database Driver**: MySQL / MariaDB (melalui XAMPP)
* **ORM**: Eloquent ORM

---

## 📂 Struktur Data & Model Database

Sistem ini memiliki dua tabel utama di dalam database:

### 1. Model `DiagnosticReport`
Digunakan untuk menyimpan log hasil diagnosa hardware interaktif (Keyboard, Mouse, Audio, Screen).

* `ticket_id` (String, Unique) - Nomor tiket diagnosa (contoh: NT-482910).
* `technician_name` (String) - Nama teknisi yang menguji.
* `customer_name` (String) - Nama pemilik perangkat.
* `device_model` (String) - Model/merek perangkat (contoh: ASUS ROG).
* `specs` (Array/JSON) - Detail spesifikasi hardware unit.
* `test_results` (Array/JSON) - Rincian hasil pengetesan (status keyboard/mouse/audio/display).
* `notes` (Text) - Catatan khusus teknisi mengenai kerusakan.
* `status` (String) - Status akhir pengujian (`PASSED` atau `DEFECT`).

### 2. Model `ServiceIntake`
Digunakan untuk mencatat pendaftaran/penerimaan unit komputer masuk untuk diservis.

* `no_nota` (String, Unique) - Nomor nota tanda terima servis.
* `nama_pelanggan` (String) - Nama pemilik perangkat.
* `no_hp` (String) - Nomor telepon aktif pelanggan.
* `tipe_perangkat` / `device_type` (String) - Jenis perangkat (Laptop, PC Desktop, AIO).
* `tanggal_masuk` (Date) - Tanggal penyerahan unit.
* `processor` (String) - Merek & tipe CPU.
* `gpu` (String) - Merek & tipe GPU.
* `ram` (String) - Kapasitas & tipe RAM.
* `storage` (String) - Kapasitas & jenis penyimpanan (SSD/HDD).
* `components` (Array/JSON) - Daftar kelengkapan yang dibawa (Charger, Tas, Box, dll).
* `service_types` (Array/JSON) - Jenis perbaikan yang diminta (Software, Hardware, Pembersihan).
* `kerusakan_inti` (Text) - Deskripsi kendala utama yang dialami perangkat.

---

## 🔌 API Route Endpoints

Seluruh API route memiliki prefix default `/api` dan dapat diakses dengan metode berikut:

| HTTP Method | Route Endpoint | Deskripsi Fungsi | Controller Action |
| :--- | :--- | :--- | :--- |
| **GET** | `/api/diagnostics` | Mengambil seluruh riwayat diagnosa (mendukung filter pencarian) | `index` |
| **POST** | `/api/diagnostics` | Menyimpan log diagnosa baru ke database | `store` |
| **GET** | `/api/diagnostics/{id}` | Mengambil detail satu data diagnosa | `show` |
| **DELETE** | `/api/diagnostics/{id}` | Menghapus data diagnosa dari database | `destroy` |
| **GET** | `/api/intakes` | Mengambil daftar unit penerimaan servis | `index` |
| **POST** | `/api/intakes` | Mendaftarkan tanda terima unit masuk baru | `store` |
| **GET** | `/api/intakes/{no_nota}`| Mencari tanda terima berdasarkan nomor nota | `show` |
| **DELETE** | `/api/intakes/{no_nota}`| Menghapus tanda terima servis dari database | `destroy` |

---

## ⚙️ Panduan Instalasi dan Konfigurasi Lokal

Ikuti langkah-langkah di bawah ini untuk memasang API ini secara lokal di Apache/MySQL (XAMPP):

### 1. Persiapan Dependensi
Pastikan PHP versi 8.2 atau di atasnya dan Composer telah terinstal di komputer Anda.

### 2. Instalasi Paket Package
Jalankan perintah berikut di direktori proyek ini untuk menginstal dependensi framework:

```bash
composer install
```

### 3. Setup Konfigurasi `.env`
Salin file `.env.example` menjadi `.env` lalu sesuaikan kredensial database MySQL Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pc_checking_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Membuat Kunci Aplikasi (App Key)
Jalankan perintah Artisan untuk membuat enkripsi key unik Laravel:

```bash
php artisan key:generate
```

### 5. Menjalankan Database Migrations
Buat database baru di MySQL/phpMyAdmin dengan nama `pc_checking_db`, lalu jalankan migrasi tabel dengan perintah:

```bash
php artisan migrate
```

### 6. Menjalankan Server Lokal
Untuk menyalakan server development bawaan Laravel:

```bash
php artisan serve
```

API backend sekarang siap diakses di `http://127.0.0.1:8000/api/`. Hubungkan url tersebut ke file `.env` aplikasi frontend Anda.

---

## 🔒 Lisensi

Backend ini bersifat open-source di bawah **MIT License**. Anda bebas memperluas fungsi API ini sesuai kebutuhan bisnis Anda.
