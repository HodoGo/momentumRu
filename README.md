# Momentum - Computer Based Test Website 🚜🌾

Momentum adalah sebuah website ujian berbasis komputer (Computer Based Test) yang dirancang untuk memudahkan administrasi ujian online. Website ini mendukung tiga peran utama: **Admin**, **Admin Sekolah**, dan **Murid** dengan fitur yang lengkap dan modern.

---

## Features ✨

### Admin

-   **Pengelolaan Data Sekolah:** Tambah, ubah, dan hapus data sekolah.
-   **Pengelolaan Data Siswa:** Tambah, ubah, dan hapus data siswa.
-   **Pengelolaan Akun Admin Sekolah:** Buat dan kelola akun admin untuk sekolah tertentu.
-   **Pembuatan Quiz:**
    -   Tambahkan nama, kode, kategori sekolah (SMP/SMA), jenis quiz (Pilihan Ganda, Essay, Benar-Salah).
    -   Tentukan waktu mulai, waktu selesai, dan durasi ujian.
    -   Input soal untuk quiz yang dibuat.
-   **Rekapitulasi Quiz:**
    -   Lihat ringkasan hasil pengerjaan quiz oleh siswa.
-   **Monitoring Realtime Ujian:**
    -   Pantau status online/offline siswa.
    -   Lihat jumlah soal yang sudah dijawab dan waktu tersisa untuk setiap siswa.

### Admin Sekolah

-   **Pengelolaan Data Siswa & Quiz:** Fitur serupa dengan admin utama, namun dibatasi hanya untuk sekolah yang dikelolanya.

### Murid

-   **Akses Ujian:**
    -   Masukkan kode quiz untuk mulai mengerjakan ujian.
    -   Waktu pengerjaan dibatasi sesuai pengaturan admin.
-   **Riwayat Quiz:** Lihat daftar ujian yang pernah diikuti beserta detail hasilnya.

---

## Tech Stack 🛠️

-   **Frontend:** Livewire 3, Alpine.js, Tailwind CSS
-   **Backend:** Laravel 10
-   **Database:** MySQL
-   **Realtime Communication:** Pusher & Laravel WebSockets
-   **Admin Panel:** Laravel Filament
-   **Deployment:** GitHub Actions

---

## Prerequisites 🛠️

Pastikan Anda memiliki:

-   PHP 8.1 atau lebih baru
-   Composer
-   Node.js & NPM
-   MySQL
-   Git

---

## Installation 🛠️

1.  Clone repository ini:
    ```bash
    git clone https://github.com/AhmadIkbalDjaya/momentum.git
    cd momentum
    ```
2.  Install dependensi menggunakan Composer:
    ```bash
    composer install
    ```
3.  Install dependensi Node.js:
    ```bash
    npm install
    npm run build
    ```
4.  Salin file `.env.example` ke `.env`:
    ```bash
    cp .env.example .env
    ```
5.  Atur koneksi database di `.env`:
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=nama_user
    DB_PASSWORD=password
    ```
6.  **Konfigurasi Realtime Communication**  
    Tambahkan pengaturan berikut pada file `.env`:
    ```bash
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_HOST=
    PUSHER_PORT=
    PUSHER_SCHEME=
    PUSHER_APP_CLUSTER=
    ```
7.  Jalankan migrasi database:
    ```bash
    php artisan migrate --seed
    ```
8.  Jalankan server lokal:
    ```bash
    php artisan serve
    ```
9.  Jalankan server WebSocket untuk fitur realtime:
    ```bash
    php artisan websockets:serve
    ```

---

## Usage 💻

-   **Admin Login:** Akses fitur pengelolaan data dan quiz melalui dashboard admin.
-   **Admin Sekolah Login:** Akses fitur terbatas sesuai dengan hak kelola sekolah.
-   **Murid Login:** Ikuti ujian dengan kode quiz dan lihat riwayat ujian di dashboard siswa.

---

## Screenshots 📸

Tambahkan tangkapan layar UI di sini.

---

## Database Design 🗄️

Below is the database design for this project:

![Database Design](docs/Momentum.png)

---
