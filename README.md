# Ticket Summary CI

## Introduction
Project ini adalah aplikasi CodeIgniter 4 untuk manajemen ticket summary. Ikuti langkah-langkah berikut untuk setup di lokal Anda.

## Prerequisites
- PHP 7.2 atau lebih baru
- Composer
- MySQL/MariaDB
- Web server (Apache, Nginx, atau gunakan built-in server CI4)

## Setup Step-by-Step

```bash
# 1. Clone repository
git clone <repository-url>
cd Ticket-Summary-CI

# 2. Install dependencies
composer install

# 3. Copy file environment
cp env .env

# 4. Edit file .env dan sesuaikan konfigurasi database Anda
# Contoh:
# database.default.hostname = 127.0.0.1
# database.default.database = web_monitoring
# database.default.username = root
# database.default.password =

# 5. Buat database di MySQL sesuai dengan nama pada .env
# Contoh (masuk ke MySQL):
CREATE DATABASE web_monitoring;

# 6. Jalankan migrasi database
php spark migrate

# 7. Jalankan server development
php spark serve

# 8. Akses aplikasi di browser
# http://localhost:8080
```

## Menjalankan Test
```bash
phpunit
```

## Contributing
Silakan buat issue atau pull request. Pastikan kode Anda mengikuti standar yang berlaku.

## License
MIT License. Lihat file