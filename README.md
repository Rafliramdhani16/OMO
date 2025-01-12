---
# **OMO (Oh My Outfit)**
OMO, singkatan dari **Oh My Outfit**, adalah toko online modern untuk berbelanja fashion terkini. Dengan desain yang responsif menggunakan **Tailwind CSS**, OMO menghadirkan pengalaman belanja yang cepat, aman, dan elegan untuk pengguna dari berbagai perangkat.
---

## **Fitur Utama**

-   **Katalog Lengkap**: Jelajahi koleksi pakaian terbaru untuk semua gaya dan kebutuhan.
-   **Filter Pintar**: Temukan produk berdasarkan kategori, ukuran, warna, dan harga.
-   **Deskripsi Produk**: Informasi lengkap produk dengan gambar berkualitas tinggi.
-   **Responsif**: Tampilan optimal di desktop, tablet, dan perangkat mobile berkat **Tailwind CSS**.
-   **Promo & Diskon**: Penawaran menarik seperti flash sale, cashback, dan diskon musiman.

---

## **Persyaratan Sistem**

Pastikan sistem Anda memenuhi persyaratan berikut:

-   **PHP**: >= 8.3
-   **Composer**: Terinstal di mesin Anda
-   **Node.js & npm**: Untuk mengelola dependensi frontend
-   **Database**: MySQL atau database lain yang didukung Laravel
-   **Ekstensi PHP yang diperlukan**:
    -   `OpenSSL`
    -   `PDO`
    -   `Mbstring`
    -   `Tokenizer`
    -   `XML`
    -   `Ctype`
    -   `JSON`
    -   `MySql`
    -   `BCMath`

---

## **Langkah Instalasi**

Ikuti langkah-langkah berikut untuk menjalankan proyek **OMO (Oh My Outfit)** di lingkungan lokal Anda:

### **1. Clone Repository**

Clone repository ini ke direktori lokal Anda:

```bash
git clone https://github.com/Rafliramdhani16/OMO.git
cd OMO
```

### **2. Instal Dependensi Backend**

Instal semua dependensi Laravel menggunakan Composer:

```bash
composer install
```

### **3. Instal Dependensi Frontend**

Instal dependensi **Tailwind CSS** dan lainnya melalui npm:

```bash
npm install
```

### **4. Konfigurasi Environment**

Buat file `.env` dengan menyalin dari `.env.example`:

```bash
cp .env.example .env
```

### **5. Konfigurasi Database**

Edit file `.env` dan sesuaikan pengaturan database Anda:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=omo
DB_USERNAME=root
DB_PASSWORD=
```

### **7. Migrasi dan Seed Database**

Jalankan migrasi untuk membuat tabel database dan tambahkan data awal jika diperlukan:

```bash
php artisan migrate:fresh --seed
```

### **8. Build Frontend Assets**

Setelah menginstal dependensi frontend, build file CSS dan JS menggunakan Tailwind:

```bash
npm run dev
```

Jika ingin melakukan build untuk production:

```bash
npm run build
```

### **9. Jalankan Server Lokal**

Setelah semua konfigurasi selesai, jalankan server Laravel:

```bash
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000`.

---

## **Prefix Commit dan Workflow**

Gunakan prefix berikut untuk setiap commit:

-   **`feat:`** untuk fitur baru, contoh: `feat: Halaman detail produk`.
-   **`fix:`** untuk perbaikan bug, contoh: `fix: Bug pada filter produk`.
-   **`style:`** untuk perubahan tampilan, contoh: `style: Perbaikan margin pada header`.
-   **`pref:`** untuk improve performa, contoh: `pref: Halaman index`.

### **Branch Workflow**:

-   **Main**: Branch stabil untuk deploy.
-   **Dev**: Branch untuk pengembangan.

---

## **Testing Aplikasi**

Jalankan pengujian untuk memastikan aplikasi berjalan dengan baik:

```bash
php artisan test
```

---

## **Panduan Penggunaan**

1. **Akses Website**  
   Kunjungi `http://127.0.0.1:8000` melalui browser Anda.
2. **Jelajahi Produk**  
   Gunakan fitur pencarian atau filter untuk menemukan pakaian sesuai kebutuhan Anda.
3. **Pesan Produk**  
   Tambahkan produk ke keranjang belanja, isi detail pengiriman, dan lakukan pembayaran.
4. **Pantau Status Pesanan**  
   Lacak pesanan melalui halaman profil pengguna.

---

Berikut adalah pembaruan bagian kontribusi dengan tabel nama dan NIM:

---

### **Daftar Kontributor**

| **Nama**                | **NIM**   |
| ----------------------- | --------- |
| Rafli Ramdhani          | 223040010 |
| Muhammad Daffa Musyaffa | 223040048 |
| Syahbrina Dinova        | 223040074 |
| Fadhilla Nur Islami     | 223040082 |

---

## **Lisensi**

OMO dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

**OMO (Oh My Outfit)** - Belanja fashion yang praktis, cepat, dan aman. Jelajahi koleksi kami sekarang dan temukan outfit terbaik untuk gaya Anda!

---
