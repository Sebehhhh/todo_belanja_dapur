<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# To Do Belanja Dapur

Aplikasi web sederhana untuk mengelola rencana dan realisasi belanja kebutuhan dapur. Dibuat dengan Laravel dan menggunakan database SQLite.

## Fitur

- ✅ Tambah dan hapus rencana belanja
- ✅ Tabel dengan checkbox untuk menandai barang sudah dibeli
- ✅ Coretan otomatis pada barang yang sudah dibeli
- ✅ Statistik sederhana (sudah/belum dibeli)
- ✅ Pencarian berdasarkan nama barang
- ✅ Export laporan ke PDF
- ✅ Tampilan clean dan responsif dengan Bootstrap

## Tutorial Clone dan Setup

### 1. Clone Repository

```bash
git clone https://github.com/Sebehhhh/todo_belanja_dapur.git
cd todo_belanja_dapur
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Setup Database (SQLite)

Aplikasi ini menggunakan SQLite untuk kemudahan setup. File database akan dibuat otomatis.

```bash
# Buat file database SQLite
touch database/database.sqlite

# Jalankan migration untuk membuat tabel
php artisan migrate
```

### 6. Install Dependencies PDF (Jika belum)

```bash
composer require barryvdh/laravel-dompdf
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

### 7. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di: http://localhost:8000

## Cara Penggunaan

1. **Tambah Rencana Belanja**: Isi form di bagian atas halaman
2. **Centang Barang**: Klik checkbox untuk menandai barang sudah dibeli
3. **Cari Barang**: Gunakan fitur pencarian di atas tabel
4. **Hapus Data**: Klik tombol "Hapus" pada baris yang ingin dihapus
5. **Export PDF**: Klik tombol "Export PDF" untuk download laporan

## Struktur Database

Tabel `belanja`:
- `id` - Primary key
- `nama_barang` - Nama barang belanja
- `jumlah_barang` - Jumlah barang
- `jam_simpan` - Waktu rencana simpan
- `jam_beli` - Waktu realisasi beli (nullable)
- `status_sudah_dibeli` - Status sudah dibeli/belum
- `created_at`, `updated_at` - Timestamp

## Teknologi yang Digunakan

- **Backend**: Laravel 11 (PHP)
- **Database**: SQLite
- **Frontend**: Bootstrap 5
- **PDF**: DomPDF
- **Bahasa**: Indonesia (penamaan tabel, variabel, komentar)

## Troubleshooting

### Error "Class Barryvdh\DomPDF\Facades\Pdf not found"
```bash
composer dump-autoload
php artisan config:clear
```

### Error "no such table: belanjas"
Pastikan model `Belanja` sudah memiliki properti `protected $table = 'belanja';`

### Database tidak terbuat
```bash
php artisan migrate:fresh
```

## Kontribusi

Silakan fork repository ini dan buat pull request untuk kontribusi.

## Lisensi

Open source - bebas digunakan untuk pembelajaran dan pengembangan.
