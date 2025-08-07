# 🚀 CodeIgniter 4 Project Setup Guide

Panduan ini ditujukan untuk developer yang ingin menjalankan project CodeIgniter 4 setelah melakukan clone dari repository ini.

---

## 🛠️ Prasyarat

Sebelum menjalankan project, pastikan kamu sudah menginstal:

- [PHP >= 8.1](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [MySQL/MariaDB](https://www.mysql.com/)
- Web Server (disarankan: Apache/Nginx)
- Git

---

## 📥 Langkah Clone dan Setup Project

### 1. **Clone Repository**
   ```bash
   git clone https://github.com/MagangTelkom2025/Web-Monitoring.git
   ```
   ```bash
   cd Web-Monitoring
   ```

### 2. **Install Dependency dengan Composer**
   ```bash
   composer install
   ```

### 3. **Copy File Environment**
   ```bash
   cp env .env
   ```

### 4. **Konfigurasi Environment**
   
   Edit file `.env` sesuai kebutuhan. Contoh konfigurasi database:

   ```dotenv
   CI_ENVIRONMENT = development

   app_baseURL = 'http://localhost:8080'

   database.default.hostname = 127.0.0.1
   database.default.database = web_monitoring
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   ```

### 5. **Generate Key Aplikasi**
   ```bash
   php spark key:generate
   ```

### 6. **Migrasi dan Seeding (Jika Ada)**
   
   Jika menggunakan migration:
   ```bash
   php spark migrate
   ```

   Jika menggunakan seeder:
   ```bash
   php spark db:seed NamaSeeder
   ```

### 7. **Jalankan Development Server**
   ```bash
   php spark serve
   ```

---

## 📁 Struktur Direktori Penting

- `app/` – Folder utama aplikasi (Controllers, Models, Views)
- `public/` – Root direktori yang diakses dari browser
- `writable/` – Tempat file log, cache, uploads, dsb
- `.env` – File konfigurasi environment
- `composer.json` – File dependency composer

---

## ✅ Tips Tambahan

- Gunakan virtual host agar tidak perlu menggunakan `php spark serve`.
- Jika menggunakan modul tambahan (JWT, REST API), pastikan sudah di-`require` melalui Composer.

---

## 📌 Catatan

- Jangan lupa setup database sebelum migrasi!
- Jika terjadi error setelah clone, pastikan:
  - `writable/` memiliki permission tulis.
  - `.env` sudah diaktifkan dan disesuaikan.