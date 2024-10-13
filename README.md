### Aplikasi CRUD 2 Tabel Laravel

## 1 . Penjelasan Project

```txt
Aplikasi ini adalah sistem manajemen sederhana yang mengimplementasikan operasi CRUD (Create, Read, Update, Delete) pada dua tabel utama: Departments (Departemen) dan Employees (Karyawan). Dibangun menggunakan framework Laravel, aplikasi ini menyediakan antarmuka admin yang intuitif untuk mengelola data departemen dan karyawan dalam suatu organisasi.

Fitur Utama:

Manajemen Departemen: Tambah, lihat, edit, dan hapus data departemen
Manajemen Karyawan: Tambah, lihat, edit, dan hapus data karyawan
Relasi antar tabel: Setiap karyawan terhubung dengan satu departemen
Antarmuka pengguna yang responsif dan mudah digunakan
Validasi input untuk memastikan integritas data
Pencarian dan filter data untuk kemudahan akses informasi
```

### 2. Design Database

-   Departments

```php
Schema::create('departments', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

-   Employees

```php
Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->foreignId('department_id')->constrained();
    $table->timestamps();
});
```

### 3. Login

```txt
Login Menggunakan Laravel UI
```

```php
composer require laravel/ui

php artisan ui bootstrap --auth

```

### 4. Screenshot Aplikasi

<div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: space-between;">
<img src="./login.png" alt="login" style="width: 48%; max-width: 300px;"/>
  <img src="./register.png" alt="Register" style="width: 48%; max-width: 300px;"/>
  <img src="./dashboard.png" alt="Dashboard" style="width: 48%; max-width: 300px;"/>
  <img src="./departments.png" alt="Departemen" style="width: 48%; max-width: 300px;"/>
  <img src="./employee.png" alt="Karyawan" style="width: 48%; max-width: 300px;"/>

### 5. Dependency

```txt
Aplikasi ini memiliki beberapa dependency utama:

PHP >= 8.1
Laravel 10.x
MySQL
Composer
Node.js dan NPM (untuk kompilasi asset)

Paket PHP (dikelola melalui Composer):

laravel/framework: ^10.10
laravel/sanctum: ^3.2
laravel/tinker: ^2.8

Paket JavaScript (dikelola melalui NPM):

axios: ^1.1.2
laravel-vite-plugin: ^0.7.5
lodash: ^4.17.21
postcss: ^8.4.23
vite: ^4.0.0
```

### 6. Instalasi

```bash
# Clone repository
git clone https://github.com/ahmad-rian/admin-panel

# Masuk ke direktori proyek
cd admin-panel

# Install dependensi PHP
composer install

# Copy file .env
cp .env.example .env

# Generate application key
php artisan key:generate

# Konfigurasi database di file .env

# Jalankan migrasi
php artisan migrate

# Install dependensi JavaScript
npm install

# Compile assets
npm run dev

# Jalankan server
php artisan serve
```

### 7. Penggunaan

```txt
1. Buka aplikasi di browser (biasanya di http://localhost:8000)
2. Register akun baru atau login jika sudah memiliki akun
3. Navigasi melalui menu untuk mengelola Departemen dan Karyawan
4. Gunakan fitur CRUD untuk menambah, melihat, mengedit, atau menghapus data
```
