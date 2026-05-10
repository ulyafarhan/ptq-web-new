# Dokumentasi Resmi: Sistem Portal Informasi PTQ

## 1. Deskripsi Sistem
Sistem ini merupakan platform portal informasi dan profil organisasi berbasis web modern (Web Profile/Portal). Repositori ini merangkum fungsionalitas sistem yang dirancang untuk mengelola dan mempublikasikan identitas entitas, program kerja, publikasi berita, struktur organisasi, hingga pencatatan tonggak sejarah (milestone). 

Pendekatan pengembangan menggunakan arsitektur *monolith* dengan paradigma *Single Page Application* (SPA) pada sisi pengguna akhir (frontend), serta antarmuka tata kelola (admin panel) yang sangat terstruktur pada sisi pengelola konten (backend).

## 2. Arsitektur dan Teknologi
Sistem dibangun di atas fondasi teknologi *full-stack* dengan spesifikasi sebagai berikut:

* **Backend Framework:** Laravel 12. Berperan sebagai fondasi utama API internal, manajemen basis data, autentikasi, serta logika bisnis.
* **Admin Panel:** Filament PHP v3. Digunakan sebagai *dashboard* administratif (CMS) yang responsif dan aman untuk mengelola seluruh entitas data (Post, Program, Milestone, Structure, Site Settings).
* **Frontend Rendering:** Inertia.js terintegrasi dengan Vue.js 3. Berfungsi sebagai jembatan yang memungkinkan aplikasi Laravel merender komponen Vue langsung dari *controller* tanpa membangun antarmuka API REST/GraphQL yang terpisah, menghasilkan pengalaman navigasi SPA yang mulus.
* **UI/UX Framework:** Tailwind CSS v3 dipadukan dengan komponen *headless* dari Shadcn-Vue. Memberikan antarmuka yang modern, responsif, dan mudah dikustomisasi secara sistematis.
* **Autentikasi & Keamanan:** Laravel Default untuk sistem registrasi, pengaturan kata sandi, serta integrasi Autentikasi Dua Langkah (*Two-Factor Authentication/2FA*).
* **Perkakas CI/CD & Kualitas Kode:** GitHub Actions (Linting & Testing), ESLint, Prettier, dan PHPUnit.

## 3. Fitur yang Tersedia
Hingga versi terkini, sistem ini telah dilengkapi dengan modul dan fitur berikut:

### A. Modul Publik (Frontend)
* **Halaman Beranda (Home):** Menampilkan ringkasan informasi, program, dan berita terbaru.
* **Halaman Berita (Posts):** Daftar artikel/publikasi (Index) dan rincian konten artikel (Show).
* **Halaman Profil & Sejarah (History/Milestone):** Menampilkan linimasa atau pencapaian organisasi dari waktu ke waktu.
* **Halaman Program (Programs):** Rincian program kerja atau layanan yang ditawarkan.
* **Halaman Struktur Organisasi (Structure):** Visualisasi kepengurusan atau hierarki manajemen.
* **Tampilan Dinamis (Tema Terang/Gelap):** Dikendalikan melalui komponen antarmuka yang terintegrasi (Appearance).

### B. Modul Tata Kelola (Filament Admin Panel)
* **Manajemen Konten Berita (Posts):** Pembuatan, penyuntingan, dan penghapusan artikel. Termasuk dukungan *rich editor* dan unggahan media.
* **Manajemen Program Kerja (Programs):** Pengelolaan portofolio program organisasi.
* **Manajemen Milestone (Milestones):** Pengelolaan data sejarah dan pencapaian.
* **Manajemen Struktur (Structures):** Penambahan atau penyesuaian profil keanggotaan/hierarki kepengurusan.
* **Manajemen Pengaturan Situs (Site Settings):** Konfigurasi identitas web secara global (Nama situs, kontak, tautan sosial media, dll) tanpa harus mengubah kode sumber.
* **Dashboard Statistik (Stats Overview):** Visualisasi metrik internal, termasuk modul pemantauan statistik server.

### C. Fitur Keamanan dan Utilitas
* **Sistem Pelacakan Kunjungan (Traffic Tracking):** *Middleware* khusus (`TrackTraffic.php`) untuk memantau dan mencatat analitik jumlah kunjungan per halaman.
* **Manajemen Akun Pengguna:** Termasuk kemampuan *reset password*, pembaruan profil pengguna, konfirmasi hapus akun, dan aktivasi *Two-Factor Authentication* (2FA) melalui kode pemulihan.
* **Manajemen Media (Spatie Media Library):** Sistem terintegrasi untuk menangani unggahan, penyimpanan, dan optimasi berkas aset (gambar/dokumen).

## 4. Bagaimana Sistem Bekerja
1.  **Siklus Permintaan Publik (Client Request Flow):**
    * Pengguna (klien) mengakses URL web (misal: `/posts`).
    * Permintaan masuk ke *Router* Laravel (`routes/web.php`).
    * *Controller* (`PageController.php` / `PostController.php`) menangani logika bisnis dan mengambil data dari basis data menggunakan *Eloquent ORM*.
    * Alih-alih mengembalikan tampilan *Blade*, *Controller* mengembalikan respons `Inertia::render('Post/Index', [data])`.
    * *Inertia.js* pada sisi klien menerima data berformat JSON tersebut dan memberikan instruksi kepada *Vue.js* untuk merender halaman SPA secara dinamis tanpa proses muat ulang halaman secara penuh (*full page reload*).
2.  **Siklus Administrasi (Filament Admin Flow):**
    * Administrator mengakses area panel (misal: `/admin`).
    * Autentikasi diverifikasi. Apabila 2FA aktif, pengguna diwajibkan memasukkan token sekuritas.
    * Administrator berinteraksi dengan antarmuka berbasis *Livewire* (bawaan Filament) untuk melakukan operasi *Create, Read, Update, Delete* (CRUD). Operasi ini langsung terhubung ke tabel relasional di dalam basis data (seperti `posts`, `programs`, `site_settings`).
3.  **Pelacakan Sistem Operasional:**
    * Setiap kali halaman publik dimuat, *middleware* pelacakan mencegat *request* HTTP, mencatat rekam jejak pengguna ke tabel `visits`, dan kemudian melanjutkan alur proses pemuatan halaman.

## 5. Panduan Instalasi dan Konfigurasi Lokal
Untuk menjalankan sistem ini pada lingkungan lokal, ikuti langkah-langkah berikut:

**Prasyarat Sistem:**
* PHP ^8.2
* Composer v2.x
* Node.js v18.x atau yang lebih baru beserta NPM/Yarn
* MySQL/PostgreSQL

**Langkah Instalasi:**
1. Kloning repositori ini ke dalam perangkat komputer.
2. Salin fail pengaturan *environment*: `cp .env.example .env`
3. Konfigurasikan kredensial basis data pada fail `.env`.
4. Instal dependensi PHP: `composer install`
5. Bangkitkan kunci aplikasi: `php artisan key:generate`
6. Jalankan migrasi basis data beserta inisialisasi data (seeder): `php artisan migrate --seed`
7. Instal dependensi Javascript: `npm install`
8. Buat tautan penyimpanan media (symlink): `php artisan storage:link`
9. Kompilasi aset (*Hot Module Replacement* untuk pengembangan lokal): `npm run dev`
10. Jalankan peladen lokal Laravel: `php artisan serve`

Sistem akan dapat diakses melalui `http://localhost:8000`. Area administrator berada pada rute `/admin`.

## 6. Rencana Pengembangan Berikutnya (Future Development)
Untuk meningkatkan performa, skalabilitas, dan utilitas perangkat lunak ini di masa depan, prioritas pengembangan dapat diarahkan pada area berikut:

1.  **Peningkatan Integrasi SEO dan Rendering:**
    Meskipun konfigurasi SSR (*Server-Side Rendering*) telah tersedia (`ssr.js`), optimasi metadata tag spesifik pada tingkat artikel/post sangat diperlukan guna meningkatkan keterbacaan indeks oleh mesin pencari (*Search Engine Optimization*).
2.  **Implementasi Lapisan Caching Tambahan:**
    Menggunakan Redis atau Memcached untuk melakukan *caching* pada kueri basis data statis seperti 'Site Settings', 'Milestones', atau 'Structure' agar menekan beban kueri database pada setiap interaksi.
3.  **Pengembangan Dashboard Analitik Lanjutan:**
    Mengonversi raw data dari model `Visit` menjadi grafik *real-time* yang lebih interaktif di dalam *Filament Admin Panel* menggunakan pustaka *Chart.js* atau *ApexCharts*, sehingga administrator dapat memahami demografi pengunjung secara detail.
4.  **Integrasi Layanan Email Eksternal (SMTP & *Queue*):**
    Mengoptimalkan mekanisme pengiriman *email* notifikasi, pendaftaran pengguna baru, maupun pemulihan kata sandi melalui pengolahan latar belakang (*background jobs* / *queues*) untuk memangkas waktu tunggu *HTTP Response*.
5.  **Audit Trail & Log Aktivitas:**
    Mengimplementasikan perekaman tindakan administratif (*activity logging*). Hal ini penting guna menelusuri penambahan atau penghapusan data secara historis oleh masing-masing administrator.
6.  **Pengujian Otomatis (Automated Testing) yang Komprehensif:**
    Memperluas cakupan kode uji (Pest/PHPUnit test coverage) pada fungsionalitas inti, lalu mengintegrasikannya lebih jauh ke dalam prosedur penerapan berkelanjutan (CI/CD) pada lingkungan produksi.
