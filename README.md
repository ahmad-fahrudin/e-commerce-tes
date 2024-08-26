<p align="center">Dibuat Menggunakan Framework Laravel Versi 10 dan Php versi 8.1.</p>

## Fitur apa saja yang tersedia di Aplikasi E-Commerce Laravel ini?

-   ADMIN PANEL
-   TERINTEGRASI DENGAN PAYMENT GATEWAY MIDTRANS
-   ORDER LEBIH DARI SATU PRODUK
-   KERANJANG BELANJA
-   Dan lain-lain

## Akun Default

**http://localhost/login**

-   email: user@gmail.com
-   Password: 111

**http://localhost/admin/login**

-   email: admin@gmail.com
-   Password: 111

---

## Install

1. **Clone Repository**

```bash
git clone https://github.com/ahmad-fahrudin/e-commerce-tes-konnco-studio.git
cd e-commerce-tes-konnco-studio
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Buka `.env` lalu ubah baris berikut sesuai dengan api midtrans kamu**

```bash
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_MERCHAT_ID=xxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxx
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxx
```

4. **Instalasi Aplikasi**

```bash
php artisan key:generate
php artisan migrate atau ('ada database saya di folder sql')
```

5. **Jalankan Aplikasi**

```bash
php artisan serve
```

## Preview
