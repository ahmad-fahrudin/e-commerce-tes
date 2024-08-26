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

2. **Buka `.env` lalu ubah baris berikut, atau menggunakan database di folder database SQL**

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

![Screenshot 2024-08-27 060445](https://github.com/user-attachments/assets/1b611fb9-eec4-42ff-a951-08af7b94d7ec)

![Screenshot 2024-08-27 060515](https://github.com/user-attachments/assets/e06cec9f-1c97-47f9-8fc3-4837c3e3caff)

![Screenshot 2024-08-27 060535](https://github.com/user-attachments/assets/2783e174-701d-4c48-a33c-14ab0749e7db)

![Screenshot 2024-08-27 060546](https://github.com/user-attachments/assets/4b5429c3-6b97-4db1-88b1-f29a195c531d)

![Screenshot 2024-08-27 060631](https://github.com/user-attachments/assets/c0a44b41-b706-4a7e-ac8c-517b742f90ed)

![Screenshot 2024-08-27 060654](https://github.com/user-attachments/assets/53541440-1631-4f02-9500-dea7a8f48452)

![Screenshot 2024-08-27 060907](https://github.com/user-attachments/assets/0b40ea6a-907c-49a8-9a06-99406d5cc648)
