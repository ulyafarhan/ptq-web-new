# DOCUMENTASI PROYEK UKM PTQ WEB

## DAFTAR ISI

1. [PENDAHULUAN](#pendahuluan)
2. [ARSITEKTUR SISTEM](#arsitektur-sistem)
3. [TEKNOLOGI YANG DIGUNAKAN](#teknologi-yang-digunakan)
4. [STRUKTUR DIREKTORI](#struktur-direktori)
5. [KONFIGURASI LINGKUNGAN](#konfigurasi-lingkungan)
6. [DATABASE DAN MIGRASI](#database-dan-migrasi)
7. [MODEL DAN RELASI DATA](#model-dan-relasidata)
8. [SISTEM ADMINISTRASI (FILAMENT)](#sistem-administrasi-filament)
9. [FRONTEND DAN TAMPILAN](#frontend-dan-tampilan)
10. [MIDDLEWARE DAN KEAMANAN](#middleware-dan-keamanan)
11. [MANAJEMEN FILE DAN MEDIA](#manajemen-file-dan-media)
12. [SISTEM BAHASA DAN LOKALISASI](#sistem-bahasa-dan-lokalisasi)
13. [PENGEMBANGAN DAN DEPLOYMENT](#pengembangan-dan-deployment)
14. [PENGUJIAN DAN QUALITY ASSURANCE](#pengujian-dan-quality-assurance)
15. [PERAWATAN DAN TROUBLESHOOTING](#perawatan-dan-troubleshooting)

---

## PENDAHULUAN

### Deskripsi Proyek

Proyek **UKM PTQ Web** merupakan sebuah aplikasi web berbasis Laravel 12 yang dikembangkan untuk mengelola dan menampilkan informasi tentang Unit Kegiatan Mahasiswa Pencak Silat Tenaga Dasar Qur'ani (UKM PTQ). Aplikasi ini menyediakan fitur manajemen konten dinamis, pengelolaan struktur organisasi, program kerja, berita, serta sistem administrasi yang komprehensif.

### Tujuan Pengembangan

- Menyediakan platform informasi yang profesional untuk UKM PTQ
- Memudahkan pengelolaan konten dan informasi organisasi
- Menyediakan sistem administrasi yang user-friendly
- Meningkatkan efisiensi dalam pengelolaan data organisasi
- Memberikan pengalaman pengguna yang optimal

### Spesifikasi Teknis

- **Framework**: Laravel 12.0
- **PHP**: Minimum versi 8.2
- **Database**: SQLite (default), mendukung MySQL/PostgreSQL
- **Frontend**: Vue.js 3 dengan Inertia.js
- **Admin Panel**: Filament 3.3
- **Authentication**: Laravel Fortify dengan Two-Factor Authentication

---

## ARSITEKTUR SISTEM

### Arsitektur MVC

Aplikasi ini mengikuti pola arsitektur Model-View-Controller (MVC) yang memisahkan logika bisnis, presentasi, dan manipulasi data:

#### Model Layer
- Menyimpan definisi data dan relasi database
- Berlokasi di direktori `app/Models/`
- Menggunakan Eloquent ORM untuk interaksi database
- Implementasi Spatie Media Library untuk manajemen file

#### View Layer
- Menggunakan Vue.js 3 dengan Inertia.js
- Template berbasis komponen Vue
- Styling dengan Tailwind CSS
- Responsif dan mobile-first design

#### Controller Layer
- Berlokasi di `app/Http/Controllers/`
- Menangani permintaan HTTP dan logika bisnis
- Menggunakan Inertia untuk rendering frontend
- Implementasi middleware untuk keamanan dan tracking

### Arsitektur Database

Sistem menggunakan pendekatan database terstruktur dengan tabel-tabel utama:

- **users**: Manajemen pengguna dan autentikasi
- **posts**: Sistem manajemen berita/konten
- **structures**: Struktur organisasi dan pengurus
- **programs**: Program kerja UKM
- **milestones**: Sejarah dan pencapaian organisasi
- **site_settings**: Pengaturan konfigurasi website
- **visits**: Tracking pengunjung website

---

## TEKNOLOGI YANG DIGUNAKAN

### Backend Technologies

#### Laravel Framework (v12.0)
- Framework PHP modern dengan fitur lengkap
- Eloquent ORM untuk database interaction
- Blade templating engine
- Artisan CLI untuk command-line operations
- Built-in authentication dan authorization

#### Laravel Fortify (v1.30)
- Headless authentication backend
- Two-factor authentication support
- Email verification
- Password reset functionality

#### Filament Admin Panel (v3.3)
- Modern admin panel framework
- Resource management dengan CRUD operations
- Form dan table builder
- Role-based access control
- Custom widgets dan pages

#### Spatie Packages
- **laravel-medialibrary (v11.17)**: Manajemen file dan media
- **laravel-responsecache (v7.7)**: Response caching untuk performa

### Frontend Technologies

#### Vue.js 3 (v3.5.24)
- Progressive JavaScript framework
- Composition API untuk better code organization
- Reactive data binding
- Component-based architecture

#### Inertia.js (v2.2.18)
- Bridge antara Laravel dan Vue.js
- Single-page application tanpa API
- Server-side routing dengan client-side rendering
- Shared data antara backend dan frontend

#### Tailwind CSS (v3.4.18)
- Utility-first CSS framework
- Responsive design utilities
- Custom design system
- Dark mode support

#### Additional Frontend Libraries
- **Radix UI / Reka UI**: Headless UI components
- **Lucide Vue**: Icon library
- **Axios**: HTTP client untuk API calls
- **Ziggy**: Laravel route usage di JavaScript

### Development Tools

#### Package Managers
- **Composer**: PHP dependency management
- **NPM**: JavaScript dependency management

#### Build Tools
- **Vite**: Modern build tool dan development server
- **TypeScript**: Type safety untuk JavaScript
- **ESLint**: JavaScript linting
- **Prettier**: Code formatting

#### Testing Framework
- **Pest PHP**: Modern PHP testing framework
- **Laravel Dusk**: Browser automation testing

---

## STRUKTUR DIREKTORI

### Root Directory Structure

```
ptq-web-new/
├── app/                    # Application core files
├── bootstrap/             # Application bootstrapping
├── config/                # Configuration files
├── database/              # Database files
├── lang/                  # Language files
├── node_modules/          # NPM dependencies
├── public/                # Public assets
├── resources/             # Views, CSS, JS, Vue components
├── routes/                # Route definitions
├── storage/               # Storage untuk logs, cache, uploads
├── tests/                 # Test files
├── vendor/                # Composer dependencies
└── .env                   # Environment variables
```

### App Directory Structure

```
app/
├── Actions/               # Laravel Actions (Fortify)
├── Filament/              # Filament admin resources
│   ├── Pages/            # Custom admin pages
│   ├── Resources/        # CRUD resources
│   └── Widgets/           # Dashboard widgets
├── Http/                  # HTTP layer
│   ├── Controllers/      # Request controllers
│   ├── Middleware/       # HTTP middleware
│   └── Requests/         # Form request validation
├── Models/               # Eloquent models
└── Providers/            # Service providers
```

### Filament Resources Structure

```
app/Filament/Resources/
├── MilestoneResource/      # Manajemen milestone/sejarah
├── PostResource/          # Manajemen berita/postingan
├── ProgramResource/       # Manajemen program kerja
└── StructureResource/    # Manajemen struktur organisasi
```

### Database Directory Structure

```
database/
├── factories/             # Model factories untuk testing
├── migrations/          # Database migrations
└── seeders/             # Database seeders
```

### Resources Directory Structure

```
resources/
├── css/                  # CSS files
├── js/                   # JavaScript files
│   ├── Components/      # Vue components
│   ├── Composables/     # Vue composables
│   ├── Layouts/         # Layout components
│   ├── Pages/           # Page components
│   └── app.js           # Main JavaScript entry
└── views/               # Blade templates
```

---

## KONFIGURASI LINGKUNGAN

### Environment Variables (.env)

File `.env` berisi konfigurasi sensitif dan environment-specific. Contoh konfigurasi:

```env
APP_NAME="UKM PTQ"
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@ukmptq.ac.id
MAIL_FROM_NAME="${APP_NAME}"
```

### Important Security Considerations

- **APP_KEY**: Generate menggunakan `php artisan key:generate`
- **APP_DEBUG**: Set ke `false` di production
- **Database credentials**: Jangan commit ke version control
- **Mail credentials**: Gunakan app-specific passwords
- **Backup .env**: Simpan backup di lokasi aman

### Configuration Files

#### app.php
Konfigurasi utama aplikasi:
- Nama aplikasi
- Environment settings
- Timezone dan locale
- Encryption settings
- Maintenance mode configuration

#### database.php
Konfigurasi koneksi database:
- Multiple database connections
- Migration settings
- Redis configuration

#### filesystems.php
Konfigurasi penyimpanan file:
- Local storage
- Public disk untuk assets
- Cloud storage drivers (S3, etc)

#### mail.php
Konfigurasi pengiriman email:
- Mail drivers
- SMTP settings
- Queue configuration untuk email

---

## DATABASE DAN MIGRASI

### Database Schema Overview

#### Users Table
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    two_factor_secret TEXT NULL,
    two_factor_recovery_codes TEXT NULL,
    two_factor_confirmed_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Posts Table
```sql
CREATE TABLE posts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT NULL,
    status ENUM('draft', 'published') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_published_at (published_at)
);
```

#### Structures Table
```sql
CREATE TABLE structures (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    group_type ENUM('teras', 'division') NOT NULL,
    division_name VARCHAR(255) NULL,
    level TINYINT UNSIGNED DEFAULT 3,
    sort_order INTEGER DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_group_type (group_type),
    INDEX idx_sort_order (sort_order)
);
```

#### Programs Table
```sql
CREATE TABLE programs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    schedule VARCHAR(255) NULL,
    location VARCHAR(255) NULL,
    type ENUM('rutin', 'bulanan', 'tahunan') NOT NULL,
    status VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Milestones Table
```sql
CREATE TABLE milestones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year YEAR NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Site Settings Table
```sql
CREATE TABLE site_settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key VARCHAR(255) UNIQUE NOT NULL,
    value TEXT NULL,
    type VARCHAR(50) DEFAULT 'string',
    group_name VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Visits Table
```sql
CREATE TABLE visits (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    url TEXT NOT NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ip_address (ip_address),
    INDEX idx_created_at (created_at)
);
```

### Migration Management

#### Running Migrations
```bash
# Jalankan semua migration
php artisan migrate

# Jalankan migration tertentu
php artisan migrate --path=/database/migrations/2025_11_17_182943_create_posts_table.php

# Rollback migration terakhir
php artisan migrate:rollback

# Rollback semua migration
php artisan migrate:reset

# Refresh database (rollback + migrate)
php artisan migrate:fresh

# Migration dengan seeding
php artisan migrate:fresh --seed
```

#### Creating New Migrations
```bash
# Generate migration baru
php artisan make:migration create_table_name

# Generate migration dengan table name
php artisan make:migration add_column_to_table --table=table_name

# Generate migration untuk membuat tabel baru
php artisan make:migration create_posts_table --create=posts
```

---

## MODEL DAN RELASI DATA

### User Model

```php
<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Semua user bisa akses admin panel
    }

    // Relasi ke posts (sebagai author)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

### Post Model

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'published_at',
        'user_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi ke author (user)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Media conversions untuk thumbnail dan banner
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->format('webp')
            ->nonQueued();
            
        $this->addMediaConversion('banner')
            ->width(1200)
            ->format('webp')
            ->nonQueued();
    }

    // Scope untuk published posts
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    // Accessor untuk excerpt
    public function getExcerptAttribute()
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->content), 120);
    }
}
```

### Structure Model

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Structure extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'position',
        'group_type',
        'division_name',
        'level',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'level' => 'integer',
        'sort_order' => 'integer',
    ];

    // Scope untuk active structures
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk pengurus teras
    public function scopeTeras($query)
    {
        return $query->where('group_type', 'teras');
    }

    // Scope untuk divisi
    public function scopeDivision($query)
    {
        return $query->where('group_type', 'division');
    }

    // Accessor untuk photo URL dengan fallback
    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMediaUrl('default') ?: asset('images/default-avatar.png');
    }

    // Media conversion untuk thumbnail
    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->format('webp')
            ->nonQueued();
    }
}
```

### Program Model

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Program extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'schedule',
        'location',
        'type',
        'status',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Program types
    const TYPE_RUTIN = 'rutin';
    const TYPE_BULANAN = 'bulanan';
    const TYPE_TAHUNAN = 'tahunan';

    // Scope untuk active programs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope berdasarkan type
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessor untuk poster URL
    public function getPosterUrlAttribute()
    {
        return $this->getFirstMediaUrl('default');
    }

    // Accessor untuk formatted schedule
    public function getFormattedScheduleAttribute()
    {
        return $this->schedule ?: 'Jadwal akan diumumkan';
    }
}
```

### Milestone Model

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'title',
        'description',
        'sort_order'
    ];

    protected $casts = [
        'year' => 'integer',
        'sort_order' => 'integer',
    ];

    // Scope untuk urutan berdasarkan tahun dan sort_order
    public function scopeOrdered($query)
    {
        return $query->orderBy('year', 'asc')
                    ->orderBy('sort_order', 'asc');
    }

    // Accessor untuk formatted year
    public function getFormattedYearAttribute()
    {
        return 'Tahun ' . $this->year;
    }
}
```

### SiteSetting Model

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group_name'
    ];

    // Cache settings untuk performa
    protected static $settingsCache = null;

    // Method untuk mendapatkan setting berdasarkan key
    public static function get($key, $default = null)
    {
        if (static::$settingsCache === null) {
            static::$settingsCache = static::pluck('value', 'key')->toArray();
        }

        return static::$settingsCache[$key] ?? $default;
    }

    // Method untuk set/update setting
    public static function set($key, $value, $type = 'string', $group = null)
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group_name' => $group
            ]
        );

        // Clear cache
        static::$settingsCache = null;
    }

    // Accessor untuk typed value
    public function getTypedValueAttribute()
    {
        return match($this->type) {
            'boolean' => (bool) $this->value,
            'integer' => (int) $this->value,
            'float' => (float) $this->value,
            'array' => json_decode($this->value, true),
            default => $this->value
        };
    }
}
```

---

## SISTEM ADMINISTRASI (FILAMENT)

### Filament Admin Panel Overview

Filament Admin Panel menyediakan interface administrasi yang modern dan powerful untuk mengelola seluruh konten website UKM PTQ. Panel admin dapat diakses melalui route `/admin` dengan autentikasi yang aman.

### Admin Panel Configuration

#### AdminPanelProvider

```php
<?php
namespace App\Providers\Filament;

use Filament\PanelProvider;
use Filament\Panel;
use App\Filament\Widgets\ServerStatsWidget;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('UKM PTQ Admin')
            ->brandLogo(fn () => view('vendor.filament.components.brand'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/logo-ptq.svg'))
            ->sidebarCollapsibleOnDesktop(false)
            ->colors([
                'primary' => '#047857', // Hijau gelap
            ])
            ->font('Inter')
            ->darkMode()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->widgets([
                ServerStatsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
```

### Post Resource (Manajemen Berita)

#### Resource Configuration

```php
<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PostResource extends Resource
{
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Data Berita';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 2;
```

#### Form Configuration

Form untuk membuat dan mengedit berita memiliki struktur yang komprehensif:

1. **Informasi Utama**:
   - Judul berita dengan validasi regex untuk mencegah karakter ilegal
   - Slug yang otomatis di-generate dari judul
   - Konten berita dengan Rich Editor
   - Validasi real-time dan error handling

2. **Media Management**:
   - Upload cover image dengan validasi file
   - Konversi otomatis ke format WebP
   - Image editor built-in
   - Multiple size conversions (thumb, banner)

3. **Publikasi Settings**:
   - Status draft/published
   - Jadwal publikasi
   - User assignment

#### Table Configuration

Tabel berita menyediakan fitur:

1. **Columns**:
   - Thumbnail cover image
   - Judul dengan slug sebagai description
   - Status badge dengan warna berbeda
   - Tanggal publikasi yang diformat

2. **Filters**:
   - Filter berdasarkan status
   - Pencarian berdasarkan judul
   - Sorting berdasarkan tanggal

3. **Actions**:
   - Edit dan delete untuk setiap record
   - Bulk delete untuk multiple records
   - View action untuk preview

### Structure Resource (Manajemen Struktur Organisasi)

Resource untuk mengelola struktur organisasi UKM PTQ:

1. **Pengurus Teras**: Ketua, Wakil, Sekretaris, Bendahara
2. **Divisi**: Media, PSDM, Kesekretariatan, dsb
3. **Level Management**: Ketua divisi, anggota
4. **Photo Management**: Upload foto pengurus
5. **Sorting**: Urutan tampilan di frontend

### Program Resource (Manajemen Program Kerja)

Resource untuk mengelola program kerja UKM:

1. **Program Types**:
   - Program rutin (latihan mingguan)
   - Program bulanan (kajian, workshop)
   - Program tahunan (pentas, lomba)

2. **Information Management**:
   - Judul dan deskripsi program
   - Jadwal dan lokasi
   - Status program
   - Upload poster/program book

### Milestone Resource (Manajemen Sejarah)

Resource untuk mengelola sejarah dan milestone organisasi:

1. **Timeline Management**:
   - Tahun kejadian
   - Judul peristiwa
   - Deskripsi detail
   - Urutan tampilan

2. **Display Configuration**:
   - Sorting berdasarkan tahun
   - Grouping periode
   - Visual timeline di frontend

### Site Settings Management

Custom page untuk mengelola pengaturan website:

1. **Hero Section**: Judul dan deskripsi utama
2. **Contact Information**: Email, alamat, kontak
3. **Social Media**: Instagram, WhatsApp, YouTube, TikTok
4. **Registration**: Link pendaftaran anggota
5. **Schedule**: File jadwal kegiatan

### Dashboard Widgets

#### ServerStatsWidget

Widget untuk menampilkan statistik server dan website:

```php
<?php
namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Visit;
use App\Models\Post;
use App\Models\User;

class ServerStatsWidget extends Widget
{
    protected static string $view = 'filament.widgets.server-stats';
    
    public function getStats(): array
    {
        return [
            'total_visits' => Visit::count(),
            'today_visits' => Visit::whereDate('created_at', today())->count(),
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'total_users' => User::count(),
            'server_uptime' => $this->getServerUptime(),
            'memory_usage' => $this->getMemoryUsage(),
        ];
    }
}
```

---

## FRONTEND DAN TAMPILAN

### Inertia.js Integration

Aplikasi menggunakan Inertia.js sebagai bridge antara Laravel dan Vue.js, memungkinkan pembuatan single-page application tanpa membangun API terpisah.

#### Inertia Configuration

```php
// config/inertia.php
return [
    'middleware' => [
        \App\Http\Middleware\HandleInertiaRequests::class,
    ],
];
```

#### HandleInertiaRequests Middleware

```php
<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
            ],
        ]);
    }
}
```

### Page Controller Structure

#### PageController Overview

`PageController` menangani semua halaman frontend website:

```php
<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Structure;
use App\Models\Program;
use App\Models\Milestone;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PageController extends Controller
{
    // 1. Home Page
    public function home()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        
        $latestPosts = Post::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get()
            ->map(fn($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => Str::limit(strip_tags($post->content), 120),
                'published_at' => $post->published_at->format('d M Y'),
                'cover' => $post->getFirstMediaUrl('default') ?: asset('images/placeholder-image.jpg'),
            ]);

        $structures = Structure::where('is_active', true)
            ->orderBy('level', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'position' => $item->position,
                'group_type' => $item->group_type,
                'division_name' => $item->division_name,
                'image' => $item->getFirstMediaUrl('default') ?: asset('images/default-avatar.png'),
            ]);

        return Inertia::render('Home', [
            'latestPosts' => $latestPosts,
            'structures' => $structures,
            'siteConfig' => [
                'hero_title' => $settings['hero_title'] ?? null,
                'hero_desc' => $settings['hero_desc'] ?? null,
                'register_url' => $settings['register_url'] ?? null,
                'contact' => [
                    'email' => $settings['contact_email'] ?? 'ukmptq@unimal.ac.id',
                    'address' => $settings['contact_address'] ?? 'Sekretariat UKM PTQ',
                    'instagram' => $settings['social_instagram'] ?? null,
                    'whatsapp' => $settings['social_whatsapp'] ?? null,
                    'youtube' => $settings['social_youtube'] ?? null,
                    'tiktok' => $settings['social_tiktok'] ?? null,
                ]
            ]
        ]);
    }

    // 2. Structure Page
    public function structure()
    {
        $teras = Structure::where('is_active', true)
            ->where('group_type', 'teras')
            ->orderBy('sort_order')
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'position' => $item->position,
                'photo' => $item->getFirstMediaUrl('default', 'thumb'),
            ]);

        $divisions = Structure::where('is_active', true)
            ->where('group_type', 'division')
            ->orderBy('division_name')
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('division_name')
            ->map(fn($group, $name) => [
                'name' => $name,
                'members' => $group->map(fn($item) => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'position' => $item->position,
                    'level' => $item->level,
                    'photo' => $item->getFirstMediaUrl('default', 'thumb'),
                ])
            ]);

        return Inertia::render('Structure', [
            'teras' => $teras,
            'divisions' => $divisions
        ]);
    }

    // 3. History Page
    public function history()
    {
        $milestones = Milestone::orderBy('year', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(fn($m) => [
                'year' => $m->year,
                'title' => $m->title,
                'desc' => $m->description,
            ]);

        return Inertia::render('Profile/History', [
            'milestones' => $milestones
        ]);
    }

    // 4. Programs Page
    public function programs()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        
        $programs = Program::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($p) => [
                'title' => $p->title,
                'desc' => $p->description,
                'schedule' => $p->schedule,
                'location' => $p->location,
                'type' => $p->type,
                'status' => $p->status,
                'month' => $p->created_at->format('F Y'),
                'image' => $p->getFirstMediaUrl('default'),
                'icon' => 'book-open',
                'color' => 'bg-emerald-100 text-emerald-600'
            ])
            ->groupBy('type');

        return Inertia::render('Profile/Programs', [
            'programs' => $programs,
            'scheduleUrl' => $settings['schedule_file_url'] ?? null,
        ]);
    }

    // 5. Posts Index Page
    public function posts(Request $request)
    {
        $query = Post::where('status', 'published');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest('published_at')
            ->paginate(9)
            ->withQueryString()
            ->through(fn($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => Str::limit(strip_tags($post->content), 120),
                'published_at' => $post->published_at->format('d M Y'),
                'cover' => $post->getFirstMediaUrl('default', 'thumb'),
            ]);

        return Inertia::render('Post/Index', [
            'posts' => $posts,
            'filters' => $request->only(['search']),
        ]);
    }

    // 6. Post Detail Page
    public function postShow($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $postData = [
            'title' => $post->title,
            'content' => $post->content,
            'published_at' => $post->published_at->format('d F Y'),
            'author' => $post->user->name ?? 'Admin',
            'cover' => $post->getFirstMediaUrl('default'),
        ];

        return Inertia::render('Post/Show', [
            'post' => $postData,
        ]);
    }
}
```

### Vue Components Structure

#### Layout Components

```
resources/js/Layouts/
├── AuthenticatedLayout.vue    # Layout untuk halaman yang membutuhkan auth
├── GuestLayout.vue           # Layout untuk halaman publik
└── AdminLayout.vue          # Layout untuk admin panel
```

#### Page Components

```
resources/js/Pages/
├── Home.vue                  # Halaman beranda
├── Structure.vue             # Halaman struktur organisasi
├── Post/
│   ├── Index.vue            # Daftar berita
│   └── Show.vue             # Detail berita
└── Profile/
    ├── History.vue          # Halaman sejarah
    └── Programs.vue         # Halaman program kerja
```

#### Reusable Components

```
resources/js/Components/
├── Cards/
│   ├── PostCard.vue        # Card untuk berita
│   ├── StructureCard.vue   # Card untuk pengurus
│   └── ProgramCard.vue     # Card untuk program
├── Navigation/
│   ├── Navbar.vue         # Navigation bar
│   └── Footer.vue         # Footer
├── UI/
│   ├── Button.vue         # Custom button component
│   ├── Card.vue           # Base card component
│   └── Badge.vue          # Badge component
└── Forms/
    ├── Input.vue          # Custom input
    └── Textarea.vue       # Custom textarea
```

### Styling System (Tailwind CSS)

#### Configuration

```javascript
// tailwind.config.js
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    500: '#10b981',
                    600: '#059669',
                    700: '#047857',
                    900: '#064e3b',
                },
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
```

#### Design System

- **Primary Color**: Hijau (#047857) - merepresentasikan kesegaran dan pertumbuhan
- **Secondary Colors**: Abu-abu dan putih untuk kontras
- **Typography**: Inter font family untuk modern look
- **Spacing**: Menggunakan Tailwind spacing scale
- **Border Radius**: Rounded corners untuk friendly appearance

### Responsive Design

Semua komponen dirancang dengan mobile-first approach:

```vue
<template>
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Content -->
    </div>
  </div>
</template>
```

---

## MIDDLEWARE DAN KEAMANAN

### Authentication Middleware

#### Laravel Fortify Configuration

```php
// config/fortify.php
return [
    'guard' => 'web',
    'passwords' => 'users',
    
    'features' => [
        Features::twoFactorAuthentication([
            'confirm' => true,
            'confirmPassword' => true,
            // 'window' => 0,
        ]),
    ],
];
```

### Custom Middleware

#### TrackTraffic Middleware

Middleware untuk tracking pengunjung website:

```php
<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;

class TrackTraffic
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking untuk admin dan livewire routes
        if (!$request->is('admin*') && !$request->is('livewire*')) {
            Visit::create([
                'ip_address' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->header('User-Agent'),
            ]);
        }

        return $next($request);
    }
}
```

#### SecurityHeaders Middleware

Menambahkan security headers untuk proteksi tambahan:

```php
<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Security headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        
        // Content Security Policy
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' *.google-analytics.com; " .
            "style-src 'self' 'unsafe-inline' fonts.googleapis.com; " .
            "font-src 'self' fonts.gstatic.com; " .
            "img-src 'self' data: blob:; " .
            "connect-src 'self' *.google-analytics.com;"
        );

        return $response;
    }
}
```

#### CachePublicPages Middleware

Caching untuk halaman publik untuk meningkatkan performa:

```php
<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CachePublicPages
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Cache hanya untuk halaman publik dan method GET
        if ($request->isMethod('GET') && !$request->is('admin/*')) {
            $response->headers->set('Cache-Control', 'public, max-age=3600');
            $response->headers->set('Expires', now()->addHour()->toRfc7231String());
        }

        return $response;
    }
}
```

### Middleware Pipeline

```php
// app/Http/Kernel.php
protected $middleware = [
    // Global middleware
    \App\Http\Middleware\TrustHosts::class,
    \App\Http\Middleware\TrustProxies::class,
    \Illuminate\Http\Middleware\HandleCors::class,
    \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    \App\Http\Middleware\TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
];

protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \App\Http\Middleware\TrackTraffic::class,
        \App\Http\Middleware\SecurityHeaders::class,
        \App\Http\Middleware\CachePublicPages::class,
    ],

    'api' => [
        // Throttle: 60 requests per minute
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
];

protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
];
```

### Security Best Practices

#### Password Security
- Minimum 8 karakter
- Harus mengandung huruf besar, huruf kecil, angka
- Laravel Fortify menyediakan password validation rules

#### SQL Injection Prevention
- Menggunakan Eloquent ORM dan query builder
- Parameter binding otomatis
- Avoid raw queries kecuali absolutely necessary

#### XSS Prevention
- Laravel Blade otomatis escape output
- Vue.js template otomatis escape HTML
- Validasi input di backend dan frontend

#### CSRF Protection
- CSRF tokens untuk semua form submission
- Laravel VerifyCsrfToken middleware aktif
- Token validation untuk AJAX requests

#### File Upload Security
- Validasi file type dan size
- Store uploaded files di directory yang tidak dapat diakses langsung
- Gunakan Spatie Media Library untuk file management
- Scan uploaded files untuk malware

#### Rate Limiting
- Throttle middleware untuk API endpoints
- Batasi jumlah login attempts
- Implement rate limiting untuk form submissions

---

## MANAJEMEN FILE DAN MEDIA

### Spatie Media Library Integration

Aplikasi menggunakan Spatie Media Library untuk manajemen file dan media yang robust dan scalable.

#### Installation dan Configuration

```bash
composer require spatie/laravel-medialibrary
```

```php
// config/media-library.php
return [
    'disk_name' => 'public',
    
    'max_file_size' => 1024 * 1024 * 10, // 10MB
    
    'queue_connection_name' => 'sync',
    
    'queue_name' => 'default',
    
    'queue_conversions_by_default' => true,
    
    'media_model' => Spatie\MediaLibrary\MediaCollections\Models\Media::class,
    
    'temporary_upload_model' => Spatie\MediaLibraryPro\Models\TemporaryUpload::class,
    
    'enable_temporary_uploads_session_affinity' => true,
    
    'generate_urls_with_type' => true,
];
```

#### Disk Configuration

```php
// config/filesystems.php
'disks' => [
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
    
    'media' => [
        'driver' => 'local',
        'root' => public_path('media'),
        'url' => env('APP_URL').'/media',
        'visibility' => 'public',
    ],
],
```

### Model Implementations

#### Post Model dengan Media

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
            
        $this->addMediaConversion('banner')
            ->width(1200)
            ->height(600)
            ->format('webp')
            ->quality(90)
            ->nonQueued();
            
        $this->addMediaConversion('preview')
            ->width(800)
            ->height(600)
            ->format('webp')
            ->quality(80)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');
            
        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');
            
        $this->addMediaCollection('attachments')
            ->acceptsMimeTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
            ->useDisk('public');
    }
}
```

#### Structure Model dengan Media

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Structure extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
            
        $this->addMediaConversion('card')
            ->width(300)
            ->height(300)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
            
        $this->addMediaConversion('full')
            ->width(500)
            ->height(500)
            ->format('webp')
            ->quality(90)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');
    }

    // Helper method untuk get photo URL dengan fallback
    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMediaUrl('default', 'thumb') ?: asset('images/default-avatar.png');
    }
}
```

### Filament Integration

#### File Upload di Filament Forms

```php
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

SpatieMediaLibraryFileUpload::make('cover')
    ->collection('default')
    ->image()
    ->imageEditor()
    ->imageEditorAspectRatios([
        '16:9',
        '4:3',
        '1:1',
    ])
    ->maxSize(5120) // 5MB
    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
    ->rules(['mimes:jpeg,png,webp'])
    ->directory('posts/covers')
    ->preserveFilenames(false)
    ->conversion('thumb')
    ->conversion('banner')
    ->columnSpanFull();
```

#### Image Column di Filament Tables

```php
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

SpatieMediaLibraryImageColumn::make('cover')
    ->collection('default')
    ->conversion('thumb')
    ->height(50)
    ->width(50)
    ->rounded()
    ->label('Cover Image');
```

### File Storage Management

#### Directory Structure

```
storage/app/public/
├── posts/
│   ├── covers/           # Cover images untuk posts
│   ├── content/          # Images dalam konten posts
│   └── gallery/          # Gallery images untuk posts
├── structures/           # Photos untuk struktur organisasi
│   ├── teras/           # Pengurus teras
│   └── divisions/        # Divisi-divisi
├── programs/             # Program-related files
│   ├── posters/          # Posters untuk programs
│   └── documents/        # Dokumen pendukung
└── site/                 # Site-wide assets
    ├── logo/             # Logo variants
    └── documents/        # General documents
```

#### File Naming Convention

- **Original files**: `{timestamp}_{original_filename}.{ext}`
- **Conversions**: `{original_filename}-{conversion_name}.{ext}`
- **Organized by date**: `{year}/{month}/{filename}.{ext}`

#### Storage Commands

```bash
# Create storage link (penting untuk file accessibility)
php artisan storage:link

# Clear media cache
php artisan media-library:clear

# Regenerate conversions
php artisan media-library:regenerate

# Clean orphaned media files
php artisan media-library:clean
```

### Image Optimization

#### Automatic Conversions

Sistem secara otomatis membuat multiple ukuran gambar:

1. **Original**: Ukuran asli untuk download high-quality
2. **Thumb**: 200x200px untuk preview kecil
3. **Card**: 300x300px untuk card layouts
4. **Preview**: 800x600px untuk lightbox preview
5. **Banner**: 1200x600px untuk hero sections

#### WebP Conversion

Semua gambar otomatis dikonversi ke WebP untuk optimal file size:

```php
public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('webp')
        ->format('webp')
        ->quality(85)
        ->nonQueued();
}
```

#### Lazy Loading Implementation

```vue
<template>
  <img 
    :src="image.src" 
    :srcset="image.srcset"
    :alt="image.alt"
    loading="lazy"
    class="w-full h-auto"
  />
</template>

<script setup>
const props = defineProps({
  image: Object,
  conversion: {
    type: String,
    default: 'thumb'
  }
});

const imageUrl = computed(() => {
  return props.image.getFirstMediaUrl('default', props.conversion);
});
</script>
```

### File Validation

#### Upload Validation Rules

```php
$rules = [
    'image' => [
        'required',
        'file',
        'mimes:jpeg,png,webp',
        'max:5120', // 5MB
        'dimensions:min_width=400,min_height=300',
    ],
    'document' => [
        'required',
        'file',
        'mimes:pdf,doc,docx',
        'max:10240', // 10MB
    ],
];
```

#### Custom Validation Messages

```php
$messages = [
    'image.required' => 'Cover image wajib diupload.',
    'image.mimes' => 'Format gambar harus JPEG, PNG, atau WebP.',
    'image.max' => 'Ukuran gambar maksimal 5MB.',
    'image.dimensions' => 'Gambar minimal 400x300px.',
];
```

### Backup dan Recovery

#### Media Backup Strategy

1. **Regular Backups**: Backup semua media files mingguan
2. **Cloud Storage**: Sync ke cloud storage (S3, Google Drive)
3. **Version Control**: Keep multiple versions dari important files
4. **Database Backup**: Backup media table references

#### Backup Commands

```bash
# Backup media directory
tar -czf media-backup-$(date +%Y%m%d).tar.gz storage/app/public/

# Backup database
php artisan backup:run --only-db

# Sync to cloud (jika menggunakan Laravel Backup)
php artisan backup:run --only-files
```

---

## SISTEM BAHASA DAN LOKALISASI

### Multi-language Support

Aplikasi mendukung multi-bahasa dengan sistem lokalisasi yang komprehensif, mendukung Bahasa Indonesia dan Bahasa Inggris sebagai default.

### Language Configuration

#### Locale Settings

```php
// config/app.php
return [
    'locale' => env('APP_LOCALE', 'id'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'id'),
    'faker_locale' => env('APP_FAKER_LOCALE', 'id_ID'),
];
```

#### Available Locales

```php
// config/app.php
'available_locales' => [
    'id' => 'Bahasa Indonesia',
    'en' => 'English',
],
```

### Language Files Structure

```
lang/
├── id/                      # Bahasa Indonesia
│   ├── actions.php         # Action labels
│   ├── auth.php            # Authentication messages
│   ├── http-statuses.php   # HTTP status messages
│   ├── pagination.php      # Pagination labels
│   ├── passwords.php       # Password reset messages
│   └── validation.php      # Validation messages
├── en/                      # English
│   ├── actions.php
│   ├── auth.php
│   ├── http-statuses.php
│   ├── pagination.php
│   ├── passwords.php
│   └── validation.php
├── id.json                 # JSON translations (ID)
└── en.json                 # JSON translations (EN)
```

### Custom Language Strings

#### PHP Language Files

```php
// lang/id/actions.php
return [
    'save' => 'Simpan',
    'cancel' => 'Batal',
    'delete' => 'Hapus',
    'edit' => 'Edit',
    'create' => 'Buat',
    'update' => 'Perbarui',
    'view' => 'Lihat',
    'search' => 'Cari',
    'filter' => 'Filter',
    'export' => 'Ekspor',
    'import' => 'Impor',
];

// lang/id/custom.php
return [
    'welcome_message' => 'Selamat datang di UKM PTQ',
    'hero_title' => 'Unit Kegiatan Mahasiswa',
    'hero_subtitle' => 'Pencak Silat Tenaga Dasar Qur\'ani',
    'latest_news' => 'Berita Terbaru',
    'organization_structure' => 'Struktur Organisasi',
    'work_programs' => 'Program Kerja',
    'history' => 'Sejarah',
    'contact_us' => 'Hubungi Kami',
];
```

#### JSON Language Files

```json
// lang/id.json
{
    "Welcome to UKM PTQ": "Selamat Datang di UKM PTQ",
    "Latest News": "Berita Terbaru",
    "Organization Structure": "Struktur Organisasi",
    "Work Programs": "Program Kerja",
    "History & Milestones": "Sejarah & Milestone",
    "Contact Us": "Hubungi Kami",
    "Read More": "Baca Selengkapnya",
    "Published on": "Diterbitkan pada",
    "Author": "Penulis",
    "Search posts...": "Cari berita...",
    "No posts found": "Tidak ada berita ditemukan",
    "Back to News": "Kembali ke Berita",
    "Chairman": "Ketua",
    "Vice Chairman": "Wakil Ketua",
    "Secretary": "Sekretaris",
    "Treasurer": "Bendahara",
    "Division": "Divisi",
    "Member": "Anggota",
    "Routine Programs": "Program Rutin",
    "Monthly Programs": "Program Bulanan",
    "Annual Programs": "Program Tahunan",
    "Coming Soon": "Segera Hadir",
    "Completed": "Selesai",
    "Schedule": "Jadwal",
    "Location": "Lokasi",
    "Type": "Tipe",
    "Status": "Status",
    "Active": "Aktif",
    "Inactive": "Tidak Aktif",
    "Save Changes": "Simpan Perubahan",
    "Delete Confirmation": "Konfirmasi Hapus",
    "Are you sure you want to delete this item?": "Apakah Anda yakin ingin menghapus item ini?",
    "This action cannot be undone": "Tindakan ini tidak dapat dibatalkan",
    "Cancel": "Batal",
    "Confirm": "Konfirmasi",
    "Success": "Sukses",
    "Error": "Error",
    "Warning": "Peringatan",
    "Info": "Info"
}
```

### Filament Localization

#### Resource Labels

```php
// Dalam Filament Resource
class PostResource extends Resource
{
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Data Berita';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    
    public static function getNavigationLabel(): string
    {
        return __('navigation.posts');
    }
}
```

#### Form Labels

```php
Forms\Components\TextInput::make('title')
    ->label(__('fields.title'))
    ->placeholder(__('placeholders.post_title'))
    ->helperText(__('helpers.post_title')),
```

#### Table Columns

```php
Tables\Columns\TextColumn::make('title')
    ->label(__('fields.title'))
    ->description(fn ($record) => __('fields.slug') . ': ' . $record->slug)
    ->tooltip(__('tooltips.click_to_view')),
```

### Dynamic Language Switching

#### Language Switcher Component

```vue
<template>
  <div class="language-switcher">
    <button 
      @click="switchLanguage('id')"
      :class="{ 'active': currentLocale === 'id' }"
      class="px-3 py-1 text-sm"
    >
      ID
    </button>
    <button 
      @click="switchLanguage('en')"
      :class="{ 'active': currentLocale === 'en' }"
      class="px-3 py-1 text-sm"
    >
      EN
    </button>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

const page = usePage();
const currentLocale = computed(() => page.props.locale || 'id');

const switchLanguage = async (locale) => {
  try {
    await axios.post('/language/switch', { locale });
    window.location.reload();
  } catch (error) {
    console.error('Language switch failed:', error);
  }
};
</script>
```

#### Language Controller

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:id,en'
        ]);

        Session::put('locale', $request->locale);
        App::setLocale($request->locale);

        return response()->json([
            'success' => true,
            'locale' => $request->locale
        ]);
    }
}
```

### Translation Management

#### Creating Language Files

```bash
# Generate new language file
php artisan lang:create id custom

# Add translation strings
php artisan lang:add id custom.welcome "Selamat Datang"

# Sync translations between languages
php artisan lang:sync id en
```

#### Best Practices for Translations

1. **Use Keys Instead of Full Strings**:
   ```php
   // Good
   __('navigation.home')
   
   // Avoid
   __('Home')
   ```

2. **Organize by Context**:
   ```php
   // navigation.php
   return [
       'home' => 'Beranda',
       'about' => 'Tentang',
       'contact' => 'Kontak',
   ];
   
   // forms.php
   return [
       'submit' => 'Kirim',
       'cancel' => 'Batal',
       'save' => 'Simpan',
   ];
   ```

3. **Handle Pluralization**:
   ```php
   // lang/id/messages.php
   return [
       'posts' => '{0} Tidak ada berita|{1} Satu berita|[2,*] :count berita',
   ];
   
   // Usage
   trans_choice('messages.posts', $count)
   ```

4. **Parameter Substitution**:
   ```php
   // lang/id/messages.php
   return [
       'welcome_user' => 'Selamat datang, :name!',
       'post_published' => 'Berita " :title " berhasil dipublikasikan pada :date',
   ];
   
   // Usage
   __('messages.welcome_user', ['name' => $user->name])
   ```

---

## PENGEMBANGAN DAN DEPLOYMENT

### Development Environment Setup

#### Prerequisites

- PHP 8.2 atau lebih tinggi
- Composer 2.x
- Node.js 18.x atau lebih tinggi
- NPM 8.x atau lebih tinggi
- SQLite atau MySQL/PostgreSQL
- Git

#### Local Development Installation

```bash
# 1. Clone repository
git clone https://github.com/your-org/ptq-web-new.git
cd ptq-web-new

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure database
# Edit .env file untuk database configuration
# DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite

# 7. Create database file (untuk SQLite)
touch database/database.sqlite

# 8. Run migrations
php artisan migrate

# 9. Run seeders (optional)
php artisan db:seed

# 10. Create storage link
php artisan storage:link

# 11. Build frontend assets
npm run build

# 12. Start development server
php artisan serve
```

#### Development Scripts

```json
// package.json
{
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "build:ssr": "vite build && vite build --ssr",
    "format": "prettier --write resources/",
    "format:check": "prettier --check resources/",
    "lint": "eslint . --fix",
    "lint:check": "eslint ."
  }
}
```

```json
// composer.json
{
  "scripts": {
    "setup": [
      "composer install",
      "@php -r \"file_exists('.env') || copy('.env.example', '.env');\"",
      "@php artisan key:generate",
      "@php artisan migrate --force",
      "npm install",
      "npm run build"
    ],
    "dev": [
      "Composer\\Config::disableProcessTimeout",
      "npx concurrently -c \"#93c5fd,#c4b5fd,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"npm run dev\" --names='server,queue,vite'"
    ],
    "test": [
      "@php artisan config:clear --ansi",
      "@php artisan test"
    ]
  }
}
```

### Build Process

#### Frontend Build

```bash
# Development build dengan hot reload
npm run dev

# Production build (optimized)
npm run build

# Build dengan Server-Side Rendering
npm run build:ssr
```

#### Backend Optimization

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize class loader
php artisan optimize

# Clear all caches
php artisan optimize:clear
```

### Deployment Process

#### Production Deployment Checklist

1. **Environment Configuration**:
   ```bash
   # Set production environment
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-domain.com
   
   # Database configuration
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

2. **Security Setup**:
   ```bash
   # Generate new app key untuk production
   php artisan key:generate --show
   
   # Setup proper file permissions
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   chown -R www-data:www-data storage
   chown -R www-data:www-data bootstrap/cache
   ```

3. **Database Migration**:
   ```bash
   # Backup existing database
   php artisan backup:run --only-db
   
   # Run migrations
   php artisan migrate --force
   
   # Seed necessary data
   php artisan db:seed --class=ProductionSeeder
   ```

4. **Asset Deployment**:
   ```bash
   # Build production assets
   npm run build
   
   # Optimize images
   php artisan media-library:regenerate
   
   # Clear and rebuild cache
   php artisan optimize
   ```

#### Server Configuration

##### Nginx Configuration

```nginx
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name your-domain.com;
    
    # SSL Configuration
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    
    # Document Root
    root /var/www/ptq-web-new/public;
    index index.php index.html;
    
    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains";
    
    # Logs
    access_log /var/log/nginx/ptq-access.log;
    error_log /var/log/nginx/ptq-error.log;
    
    # Handle PHP
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }
    
    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }
    
    # Optimize static files
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|webp|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
    }
    
    # Laravel routes
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # Admin panel
    location /admin {
        try_files $uri $uri/ /index.php?$query_string;
        
        # Additional security for admin
        # allow your-ip-address;
        # deny all;
    }
}
```

##### Apache Configuration

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    Redirect permanent / https://your-domain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName your-domain.com
    DocumentRoot /var/www/ptq-web-new/public
    
    # SSL Configuration
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    
    # Security Headers
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    
    # Directory Settings
    <Directory /var/www/ptq-web-new/public>
        AllowOverride All
        Require all granted
        
        # Disable directory browsing
        Options -Indexes
        
        # Enable URL rewriting
        RewriteEngine On
        
        # Handle trailing slashes
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule ^(.*)/$ /$1 [L,R=301]
        
        # Handle PHP files
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [L]
    </Directory>
    
    # Deny access to hidden files
    <FilesMatch "^\.">
        Require all denied
    </FilesMatch>
    
    # Optimize static files
    <FilesMatch "\.(jpg|jpeg|png|gif|ico|css|js|svg|webp|woff|woff2|ttf|eot)$">
        ExpiresActive On
        ExpiresDefault "access plus 1 year"
        Header set Cache-Control "public, immutable"
    </FilesMatch>
    
    # PHP Configuration
    php_value upload_max_filesize 10M
    php_value post_max_size 10M
    php_value memory_limit 256M
    
    # Logging
    ErrorLog ${APACHE_LOG_DIR}/ptq-error.log
    CustomLog ${APACHE_LOG_DIR}/ptq-access.log combined
</VirtualHost>
```

### Continuous Integration/Deployment (CI/CD)

#### GitHub Actions Workflow

```yaml
# .github/workflows/deploy.yml
name: Deploy to Production

on:
  push:
    branches: [ main ]
  pull_request:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: password
          MYSQL_DATABASE: testing
        ports:
          - 3306:3306
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        extensions: mbstring, mysql, sqlite, zip, gd
    
    - name: Copy .env
      run: php -r "file_exists('.env') || copy('.env.example', '.env');"
    
    - name: Install Dependencies
      run: composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
    
    - name: Generate key
      run: php artisan key:generate
    
    - name: Directory Permissions
      run: chmod -R 777 storage bootstrap/cache
    
    - name: Create Database
      run: |
        mkdir -p database
        touch database/database.sqlite
    
    - name: Run Migrations
      env:
        DB_CONNECTION: sqlite
        DB_DATABASE: database/database.sqlite
      run: php artisan migrate --force
    
    - name: Execute tests
      env:
        DB_CONNECTION: sqlite
        DB_DATABASE: database/database.sqlite
      run: vendor/bin/pest

  deploy:
    needs: test
    runs-on: ubuntu-latest
    if: github.ref == 'refs/heads/main'
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
    
    - name: Install Dependencies
      run: composer install --no-dev --optimize-autoloader
    
    - name: Install NPM Dependencies
      run: npm ci
    
    - name: Build Assets
      run: npm run build
    
    - name: Deploy to Server
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.SSH_KEY }}
        script: |
          cd /var/www/ptq-web-new
          git pull origin main
          composer install --no-dev --optimize-autoloader
          npm ci
          npm run build
          php artisan migrate --force
          php artisan optimize
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
          php artisan queue:restart
```

---

## PENGUJIAN DAN QUALITY ASSURANCE

### Testing Strategy

#### Unit Testing dengan Pest PHP

```php
// tests/Unit/Models/PostTest.php
<?php

use App\Models\Post;
use App\Models\User;

it('can create a post', function () {
    $user = User::factory()->create();
    
    $post = Post::create([
        'title' => 'Test Post',
        'slug' => 'test-post',
        'content' => 'This is test content',
        'status' => 'published',
        'user_id' => $user->id,
        'published_at' => now(),
    ]);
    
    expect($post)->toBeInstanceOf(Post::class);
    expect($post->title)->toBe('Test Post');
    expect($post->slug)->toBe('test-post');
});

it('generates excerpt from content', function () {
    $post = new Post([
        'content' => '<p>This is a long content that should be truncated for the excerpt.</p>'
    ]);
    
    expect($post->excerpt)->toBeString();
    expect(strlen($post->excerpt))->toBeLessThanOrEqual(120);
});

it('belongs to an author', function () {
    $post = Post::factory()->create();
    
    expect($post->author)->toBeInstanceOf(User::class);
});

it('can scope published posts', function () {
    Post::factory()->count(3)->create(['status' => 'published']);
    Post::factory()->count(2)->create(['status' => 'draft']);
    
    $publishedPosts = Post::published()->get();
    
    expect($publishedPosts)->toHaveCount(3);
});
```

#### Feature Testing

```php
// tests/Feature/PostManagementTest.php
<?php

use App\Models\User;
use App\Models\Post;

it('can display posts index page', function () {
    Post::factory()->count(5)->published()->create();
    
    $response = $this->get('/posts');
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('Post/Index')
             ->has('posts.data', 5)
    );
});

it('can search posts', function () {
    Post::factory()->create(['title' => 'Laravel Tutorial']);
    Post::factory()->create(['title' => 'Vue.js Guide']);
    Post::factory()->create(['title' => 'PHP Basics']);
    
    $response = $this->get('/posts?search=Laravel');
    
    $response->assertInertia(fn ($page) => 
        $page->has('posts.data', 1)
             ->where('filters.search', 'Laravel')
    );
});

it('can display single post', function () {
    $post = Post::factory()->published()->create();
    
    $response = $this->get("/posts/{$post->slug}");
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('Post/Show')
             ->where('post.title', $post->title)
    );
});

it('returns 404 for unpublished post', function () {
    $post = Post::factory()->create(['status' => 'draft']);
    
    $response = $this->get("/posts/{$post->slug}");
    
    $response->assertStatus(404);
});
```

#### Admin Panel Testing

```php
// tests/Feature/Admin/PostResourceTest.php
<?php

use App\Models\User;
use App\Models\Post;
use Livewire\Livewire;
use App\Filament\Resources\PostResource;
use Filament\Pages\Actions\CreateAction;

it('can render post resource', function () {
    $this->actingAs(User::factory()->create());
    
    $this->get(PostResource::getUrl())->assertStatus(200);
});

it('can create post', function () {
    $this->actingAs(User::factory()->create());
    
    Livewire::test(PostResource\Pages\CreatePost::class)
        ->set('data.title', 'New Post')
        ->set('data.slug', 'new-post')
        ->set('data.content', 'Post content')
        ->set('data.status', 'published')
        ->set('data.published_at', now())
        ->call('create')
        ->assertHasNoErrors();
    
    $this->assertDatabaseHas('posts', [
        'title' => 'New Post',
        'slug' => 'new-post',
    ]);
});

it('validates required fields', function () {
    $this->actingAs(User::factory()->create());
    
    Livewire::test(PostResource\Pages\CreatePost::class)
        ->set('data.title', '')
        ->set('data.slug', '')
        ->call('create')
        ->assertHasErrors(['data.title', 'data.slug']);
});
```

### Code Quality Tools

#### PHP Code Standards (Pint)

```bash
# Install Laravel Pint
composer require laravel/pint --dev

# Check code style
./vendor/bin/pint --test

# Fix code style
./vendor/bin/pint

# Custom configuration
# pint.json
{
    "preset": "laravel",
    "rules": {
        "simplified_null_return": true,
        "braces": false,
        "new_with_braces": false
    }
}
```

#### JavaScript Linting (ESLint)

```javascript
// eslint.config.js
import js from '@eslint/js'
import vue from 'eslint-plugin-vue'

export default [
  js.configs.recommended,
  ...vue.configs['flat/recommended'],
  {
    files: ['**/*.{js,vue}'],
    languageOptions: {
      ecmaVersion: 'latest',
      sourceType: 'module',
      globals: {
        window: 'readonly',
        document: 'readonly',
        console: 'readonly',
      }
    },
    rules: {
      'vue/multi-word-component-names': 'off',
      'vue/no-v-html': 'off',
      'no-unused-vars': 'warn',
      'no-console': 'warn',
    }
  }
]
```

#### Code Formatting (Prettier)

```javascript
// .prettierrc
{
  "semi": true,
  "singleQuote": true,
  "tabWidth": 2,
  "trailingComma": "es5",
  "printWidth": 80,
  "plugins": ["prettier-plugin-organize-imports", "prettier-plugin-tailwindcss"]
}
```

### Performance Testing

#### Database Query Optimization

```php
// tests/Feature/Performance/DatabasePerformanceTest.php
<?php

it('optimizes post queries', function () {
    // Create test data
    Post::factory()->count(100)->published()->create();
    
    // Test query performance
    $start = microtime(true);
    
    $posts = Post::with('author')
        ->published()
        ->latest('published_at')
        ->paginate(10);
    
    $end = microtime(true);
    $executionTime = ($end - $start) * 1000; // Convert to milliseconds
    
    // Assert query execution time
    expect($executionTime)->toBeLessThan(100); // Should complete in less than 100ms
    
    // Assert no N+1 queries
    expect($posts->items())->each->toHaveLoaded('author');
});

it('uses proper indexes', function () {
    $queries = [];
    
    DB::listen(function ($query) use (&$queries) {
        $queries[] = $query;
    });
    
    Post::where('status', 'published')
        ->where('published_at', '<=', now())
        ->get();
    
    // Check if query uses indexes
    expect($queries)->toHaveCount(1);
    expect($queries[0]->time)->toBeLessThan(50); // Query should be fast
});
```

#### Frontend Performance

```javascript
// tests/Frontend/PerformanceTest.js
import { test, expect } from '@playwright/test';

test('homepage loads quickly', async ({ page }) => {
  const startTime = Date.now();
  
  await page.goto('/');
  await page.waitForLoadState('networkidle');
  
  const loadTime = Date.now() - startTime;
  
  expect(loadTime).toBeLessThan(3000); // Should load in less than 3 seconds
});

test('images are optimized', async ({ page }) => {
  await page.goto('/posts');
  
  const images = await page.locator('img');
  const imageCount = await images.count();
  
  for (let i = 0; i < imageCount; i++) {
    const image = images.nth(i);
    const src = await image.getAttribute('src');
    
    // Check if images use WebP format
    expect(src).toMatch(/\.webp$/);
    
    // Check loading attribute
    const loading = await image.getAttribute('loading');
    expect(loading).toBe('lazy');
  }
});
```

### Security Testing

#### Security Headers Test

```php
// tests/Feature/Security/SecurityHeadersTest.php
<?php

it('sets proper security headers', function () {
    $response = $this->get('/');
    
    $response->assertHeader('X-Content-Type-Options', 'nosniff');
    $response->assertHeader('X-Frame-Options', 'DENY');
    $response->assertHeader('X-XSS-Protection', '1; mode=block');
    $response->assertHeader('Strict-Transport-Security');
    $response->assertHeader('Content-Security-Policy');
});

it('prevents clickjacking', function () {
    $response = $this->get('/');
    
    $response->assertHeader('X-Frame-Options', 'DENY');
    $response->assertHeader('Content-Security-Policy', 
        fn ($value) => str_contains($value, "frame-ancestors 'none'")
    );
});

it('prevents XSS attacks', function () {
    $maliciousInput = '<script>alert("XSS")</script>';
    
    $response = $this->post('/contact', [
        'message' => $maliciousInput
    ]);
    
    // Response should not contain the malicious script
    $response->assertDontSee($maliciousInput);
});
```

#### Authentication Security

```php
// tests/Feature/Security/AuthenticationTest.php
<?php

use App\Models\User;

it('prevents brute force attacks', function () {
    // Attempt multiple failed logins
    for ($i = 0; $i < 6; $i++) {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password'
        ]);
    }
    
    // Should be rate limited after 5 attempts
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'wrong-password'
    ]);
    
    $response->assertStatus(429); // Too Many Requests
});

it('requires strong passwords', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'weak', // Too weak
        'password_confirmation' => 'weak'
    ]);
    
    $response->assertSessionHasErrors('password');
});

it('enforces two-factor authentication', function () {
    $user = User::factory()->create([
        'two_factor_secret' => encrypt('secret'),
        'two_factor_confirmed_at' => now()
    ]);
    
    // Should require 2FA code after password login
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password'
    ]);
    
    $response->assertRedirect('/two-factor-challenge');
});
```

### Load Testing

#### Simple Load Test dengan Artillery

```yaml
# tests/load/homepage.yml
config:
  target: 'https://your-domain.com'
  phases:
    - duration: 60
      arrivalRate: 10
    - duration: 120
      arrivalRate: 20
    - duration: 60
      arrivalRate: 5
  
scenarios:
  - name: "Homepage Load Test"
    flow:
      - get:
          url: "/"
          expect:
            - statusCode: 200
            - contentType: html
      - think: 2
      
  - name: "News Page Load Test"
    flow:
      - get:
          url: "/posts"
          expect:
            - statusCode: 200
            - contentType: html
      - think: 3
      - get:
          url: "/posts/test-post"
          expect:
            - statusCode: 200
```

Run load test:
```bash
npm install -g artillery
artillery run tests/load/homepage.yml
```

### Monitoring dan Logging

#### Application Monitoring

```php
// app/Providers/AppServiceProvider.php
public function boot()
{
    // Log slow queries
    DB::listen(function ($query) {
        if ($query->time > 1000) { // Queries taking more than 1 second
            Log::warning('Slow query detected', [
                'sql' => $query->sql,
                'time' => $query->time,
                'bindings' => $query->bindings,
            ]);
        }
    });
    
    // Log memory usage
    if (app()->environment('production')) {
        register_shutdown_function(function () {
            $memoryPeak = memory_get_peak_usage(true) / 1024 / 1024; // Convert to MB
            if ($memoryPeak > 128) { // Log if memory usage exceeds 128MB
                Log::warning('High memory usage detected', [
                    'peak_memory_mb' => $memoryPeak,
                    'url' => request()->url(),
                ]);
            }
        });
    }
}
```

#### Health Check Endpoint

```php
// routes/web.php
Route::get('/health', function () {
    $checks = [
        'database' => DB::connection()->getPdo() ? 'ok' : 'fail',
        'storage' => is_writable(storage_path()) ? 'ok' : 'fail',
        'cache' => Cache::get('health_check_test', 'ok'),
        'queue' => Cache::get('queue_last_run', now()->subMinutes(5))->gt(now()->subMinutes(10)) ? 'ok' : 'warning',
    ];
    
    $allOk = !in_array('fail', $checks);
    
    return response()->json([
        'status' => $allOk ? 'healthy' : 'unhealthy',
        'timestamp' => now()->toIso8601String(),
        'checks' => $checks,
    ], $allOk ? 200 : 503);
});
```

---

## PERAWATAN DAN TROUBLESHOOTING

### Regular Maintenance Tasks

#### Daily Tasks

1. **Log Monitoring**:
   ```bash
   # Check error logs
   tail -f storage/logs/laravel.log | grep "ERROR"
   
   # Check for failed jobs
   php artisan queue:failed
   
   # Monitor recent visits
   php artisan tinker
   >>> Visit::whereDate('created_at', today())->count()
   ```

2. **Cache Management**:
   ```bash
   # Clear expired cache
   php artisan cache:prune-stale-tags
   
   # Check cache hit rate
   php artisan cache:stats
   ```

#### Weekly Tasks

1. **Database Maintenance**:
   ```bash
   # Optimize tables
   php artisan db:optimize
   
   # Check for slow queries
   grep "Query took" storage/logs/laravel.log | tail -20
   
   # Backup database
   php artisan backup:run --only-db
   ```

2. **File System Cleanup**:
   ```bash
   # Clear temporary files
   php artisan temporary:clean
   
   # Remove old logs (keep last 30 days)
   find storage/logs -name "laravel-*.log" -mtime +30 -delete
   
   # Optimize media files
   php artisan media-library:regenerate
   ```

#### Monthly Tasks

1. **Security Audit**:
   ```bash
   # Check for security updates
   composer audit
   npm audit
   
   # Review user activities
   php artisan user:activity-report
   
   # Update dependencies
   composer update --dry-run
   npm outdated
   ```

2. **Performance Audit**:
   ```bash
   # Generate performance report
   php artisan performance:report
   
   # Check disk usage
   du -sh storage/*
   
   # Review slowest queries
   php artisan query:analyze
   ```

### Common Issues dan Solusi

#### Database Issues

**Issue: Connection refused**
```
SQLSTATE[HY000] [2002] Connection refused
```

Solusi:
```bash
# Check database service
sudo systemctl status mysql

# Check connection parameters
php artisan tinker
>>> DB::connection()->getPdo()

# Reset database credentials
php artisan config:clear
php artisan cache:clear
```

**Issue: Table not found**
```
SQLSTATE[42S02]: Base table or view not found
```

Solusi:
```bash
# Run pending migrations
php artisan migrate:status
php artisan migrate

# Check if migration files exist
ls database/migrations/

# Re-create missing tables
php artisan migrate:fresh --seed
```

#### File Upload Issues

**Issue: File too large**
```
The file "image.jpg" exceeds your upload_max_filesize ini directive
```

Solusi:
```php
// Update php.ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300

// Update .htaccess
php_value upload_max_filesize 10M
php_value post_max_size 10M
```

**Issue: Storage link not working**
```
File not found in storage directory
```

Solusi:
```bash
# Re-create storage link
php artisan storage:link

# Check permissions
chmod -R 755 storage
chmod -R 755 public/storage

# Verify symlink
ls -la public/
```

#### Performance Issues

**Issue: Slow page load**
- Check for N+1 queries
- Optimize database queries
- Enable caching
- Compress images

**Issue: High memory usage**
- Check for memory leaks
- Optimize image processing
- Increase PHP memory limit
- Use queue for heavy tasks

#### Authentication Issues

**Issue: Login not working**
```
These credentials do not match our records
```

Solusi:
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear

# Check user existence
php artisan tinker
>>> User::where('email', 'user@example.com')->first()

# Reset password
php artisan tinker
>>> $user = User::find(1);
>>> $user->password = Hash::make('newpassword');
>>> $user->save();
```

**Issue: Two-factor authentication problems**
- Check time synchronization
- Verify secret key
- Regenerate QR code

### Backup dan Recovery Procedures

#### Automated Backup Setup

```bash
# Create backup script
# scripts/backup.sh
#!/bin/bash

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/ptq-web"
APP_DIR="/var/www/ptq-web-new"

# Create backup directory
mkdir -p $BACKUP_DIR

# Database backup
php $APP_DIR/artisan backup:run --only-db --filename=database_$DATE.sql

# Files backup
tar -czf $BACKUP_DIR/files_$DATE.tar.gz -C $APP_DIR storage/app/public

# Application backup (excluding vendor and node_modules)
tar -czf $BACKUP_DIR/app_$DATE.tar.gz \
  --exclude="$APP_DIR/vendor" \
  --exclude="$APP_DIR/node_modules" \
  --exclude="$APP_DIR/.git" \
  -C $APP_DIR .

# Keep only last 30 days of backups
find $BACKUP_DIR -name "*.tar.gz" -mtime +30 -delete
find $BACKUP_DIR -name "*.sql" -mtime +30 -delete

# Upload to cloud storage (optional)
aws s3 sync $BACKUP_DIR s3://your-backup-bucket/ptq-web/
```

Make script executable:
```bash
chmod +x scripts/backup.sh
```

Add to crontab:
```bash
# Backup setiap hari jam 2 pagi
0 2 * * * /var/www/ptq-web-new/scripts/backup.sh >> /var/log/ptq-backup.log 2>&1
```

#### Disaster Recovery

**Scenario: Complete server failure**

1. **Restore from Backup**:
   ```bash
   # Restore application files
   tar -xzf app_20241119_020000.tar.gz -C /var/www/ptq-web-new
   
   # Restore uploaded files
   tar -xzf files_20241119_020000.tar.gz -C /var/www/ptq-web-new/storage/app
   
   # Restore database
   mysql -u username -p database_name < database_20241119_020000.sql
   ```

2. **Post-Recovery Steps**:
   ```bash
   # Install dependencies
   composer install --no-dev --optimize-autoloader
   npm ci
   npm run build
   
   # Set proper permissions
   chmod -R 755 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   
   # Clear and rebuild cache
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   
   # Restart services
   sudo systemctl restart php8.2-fpm
   sudo systemctl restart nginx
   ```

### Monitoring dan Alerting

#### Application Health Monitoring

```php
// app/Console/Commands/HealthCheck.php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HealthCheck extends Command
{
    protected $signature = 'health:check';
    protected $description = 'Run comprehensive health check';

    public function handle()
    {
        $checks = [
            'database' => $this->checkDatabase(),
            'cache' => $this->checkCache(),
            'storage' => $this->checkStorage(),
            'queue' => $this->checkQueue(),
            'ssl' => $this->checkSSL(),
        ];

        $allHealthy = collect($checks)->every(fn ($check) => $check['status'] === 'healthy');

        if (!$allHealthy) {
            $this->alert('Health check failed!');
            $this->notifyAdmins($checks);
            return 1;
        }

        $this->info('All systems healthy!');
        return 0;
    }

    private function checkDatabase(): array
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'healthy', 'message' => 'Database connection OK'];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'message' => $e->getMessage()];
        }
    }

    private function checkCache(): array
    {
        try {
            Cache::put('health_check', 'test', 10);
            $value = Cache::get('health_check');
            return ['status' => 'healthy', 'message' => 'Cache working properly'];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'message' => $e->getMessage()];
        }
    }

    private function checkStorage(): array
    {
        try {
            $testFile = 'health_check_' . time() . '.txt';
            Storage::put($testFile, 'test');
            Storage::delete($testFile);
            return ['status' => 'healthy', 'message' => 'Storage accessible'];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'message' => $e->getMessage()];
        }
    }

    private function checkQueue(): array
    {
        $lastRun = Cache::get('queue_last_run', now()->subHours(2));
        if ($lastRun->diffInMinutes(now()) > 30) {
            return ['status' => 'warning', 'message' => 'Queue not running for 30+ minutes'];
        }
        return ['status' => 'healthy', 'message' => 'Queue running properly'];
    }

    private function checkSSL(): array
    {
        $cert = $this->getSSLCertificateInfo();
        if ($cert['days_until_expiry'] < 30) {
            return ['status' => 'warning', 'message' => "SSL expires in {$cert['days_until_expiry']} days"];
        }
        return ['status' => 'healthy', 'message' => 'SSL certificate valid'];
    }

    private function notifyAdmins(array $checks)
    {
        // Send notification to administrators
        $unhealthy = collect($checks)->filter(fn ($check) => $check['status'] !== 'healthy');
        
        // Implementation depends on notification system (email, Slack, etc.)
        \Mail::to(config('app.admin_email'))->send(new \App\Mail\HealthAlert($unhealthy));
    }
}
```

Add to scheduler:
```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->command('health:check')->everyFiveMinutes();
    $schedule->command('backup:run')->dailyAt('02:00');
    $schedule->command('media-library:clean')->weekly();
}
```

### Performance Optimization

#### Database Optimization

```sql
-- Add indexes for common queries
CREATE INDEX idx_posts_status_published_at ON posts(status, published_at);
CREATE INDEX idx_visits_created_at ON visits(created_at);
CREATE INDEX idx_structures_group_type_active ON structures(group_type, is_active);

-- Optimize slow queries
EXPLAIN SELECT * FROM posts WHERE status = 'published' ORDER BY published_at DESC;

-- Update statistics
ANALYZE TABLE posts;
ANALYZE TABLE visits;
```

#### Cache Optimization

```php
// Implement intelligent caching
// app/Services/PostService.php
<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostService
{
    public function getLatestPosts(int $limit = 3)
    {
        return Cache::remember(
            "posts.latest.{$limit}",
            now()->addHour(),
            fn () => Post::published()
                ->latest('published_at')
                ->limit($limit)
                ->get()
        );
    }

    public function getPostBySlug(string $slug)
    {
        return Cache::remember(
            "post.slug.{$slug}",
            now()->addHours(24),
            fn () => Post::where('slug', $slug)
                ->published()
                ->firstOrFail()
        );
    }

    public function clearPostCache(): void
    {
        Cache::tags(['posts'])->flush();
    }
}
```

#### Frontend Optimization

```javascript
// Implement lazy loading untuk images
// resources/js/Composables/useLazyLoad.js
import { ref, onMounted, onUnmounted } from 'vue';

export function useLazyLoad() {
  const images = ref([]);

  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.classList.add('loaded');
        observer.unobserve(img);
      }
    });
  });

  onMounted(() => {
    images.value = document.querySelectorAll('img[data-src]');
    images.value.forEach(img => imageObserver.observe(img));
  });

  onUnmounted(() => {
    imageObserver.disconnect();
  });
}
```

### Documentation Maintenance

#### API Documentation

```bash
# Generate API documentation
composer require --dev mpociot/laravel-apidoc-generator
php artisan apidoc:generate
```

#### Code Documentation

```bash
# Generate PHPDoc documentation
composer require --dev phpdocumentor/phpdocumentor
./vendor/bin/phpdoc -d app -f docs/api
```

#### Update Dependencies

```bash
# Check for outdated packages
composer outdated
npm outdated

# Update dependencies (testing required)
composer update
npm update

# Security audit
composer audit
npm audit
```

---

## KESIMPULAN

Dokumentasi ini menyediakan panduan komprehensif untuk pengembangan, deployment, dan perawatan aplikasi UKM PTQ Web. Aplikasi ini dibangun dengan teknologi modern dan best practices untuk memastikan keamanan, performa, dan skalabilitas.

### Ringkasan Fitur Utama

1. **Manajemen Konten Dinamis**:
   - Sistem berita dengan editor rich text
   - Manajemen struktur organisasi
   - Program kerja dan milestone
   - Pengaturan website dinamis

2. **Administrasi Professional**:
   - Filament admin panel yang modern
   - Role-based access control
   - Media management yang canggih
   - Dashboard dengan statistik real-time

3. **Frontend Responsif**:
   - Vue.js 3 dengan Inertia.js
   - Tailwind CSS untuk styling modern
   - Multi-language support (ID/EN)
   - Mobile-first responsive design

4. **Keamanan Terjamin**:
   - Laravel Fortify authentication
   - Two-factor authentication
   - CSRF protection
   - SQL injection prevention
   - XSS protection

5. **Performa Optimal**:
   - Query optimization
   - Image optimization dan WebP conversion
   - Response caching
   - Lazy loading untuk images

### Best Practices yang Diterapkan

- **Code Organization**: MVC pattern dengan service layer
- **Security**: Input validation, output escaping, secure headers
- **Performance**: Database indexing, caching, image optimization
- **Maintainability**: Comprehensive documentation, testing, CI/CD
- **Scalability**: Modular architecture, queue system, cloud-ready

### Roadmap Pengembangan

Fitur-fitur yang dapat ditambahkan di masa depan:

1. **Member Management System**:
   - Pendaftaran anggota online
   - Sistem keanggotaan dan iuran
   - Attendance tracking
   - Member portal dashboard

2. **Event Management**:
   - Pendaftaran event online
   - Sistem absensi digital
   - Event calendar dan reminder
   - Event documentation

3. **E-Learning Platform**:
   - Materi latihan digital
   - Video tutorial
   - Progress tracking
   - Assessment system

4. **Mobile Application**:
   - Native mobile app
   - Push notifications
   - Offline capability
   - Mobile-specific features

5. **Advanced Analytics**:
   - Website analytics dashboard
   - Member engagement metrics
   - Event performance analysis
   - Custom reporting tools

### Dukungan dan Maintenance

Untuk pertanyaan, bug reports, atau feature requests, silakan hubungi development team melalui:

- **Email**: [development@ukmptq.ac.id]
- **Issue Tracker**: [GitHub Issues]
- **Documentation**: [Wiki/Documentation Portal]

### Lisensi dan Legal

Aplikasi ini dikembangkan secara open-source dengan lisensi MIT. Pastikan untuk:

- Mematuhi lisensi dari third-party packages
- Menjaga keamanan dan privacy data pengguna
- Melakukan regular security updates
- Mematuhi regulasi data protection yang berlaku

---

**Catatan**: Dokumentasi ini akan diperbarui secara berkala sesuai dengan perkembangan aplikasi. Pastikan untuk selalu merujuk ke versi terbaru dari dokumentasi ini.