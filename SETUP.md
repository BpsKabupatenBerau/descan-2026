# 🚀 DESCAN 2026 — Setup Guide (Backend Dev 1)
# github.com/BpsKabupatenBerau/descan-2026

## Stack
- PHP 8.4.20 | Laravel 12 | Filament (latest) | PostgreSQL 13

---

## ══════════════════════════════════
## OPTION A — Local PC (PostgreSQL 13)
## ══════════════════════════════════

### 1. Clone & install
```bash
git clone https://github.com/BpsKabupatenBerau/descan-2026.git
cd descan-2026
git checkout -b feature/backend-setup   # your branch

composer install
npm install
cp .env.example .env
php artisan key:generate
```

### 2. Create PostgreSQL database
```bash
# Open psql
psql -U postgres

# Inside psql:
CREATE DATABASE descan_2026;
CREATE USER descan_user WITH PASSWORD 'your_password';
GRANT ALL PRIVILEGES ON DATABASE descan_2026 TO descan_user;
\q
```

### 3. Configure .env
```env
APP_NAME="DESCAN 2026"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=descan_2026
DB_USERNAME=descan_user
DB_PASSWORD=your_password

# Storage
FILESYSTEM_DISK=public

# Cache & Sessions
CACHE_STORE=file
SESSION_DRIVER=file
```

### 4. Run migrations + seed
```bash
php artisan migrate --seed
php artisan storage:link
```

### 5. Install packages
```bash
# Admin panel
composer require filament/filament:"^3.0" -W

# File uploads
composer require spatie/laravel-medialibrary

# Slugs
composer require spatie/laravel-sluggable

# Excel export (for download button)
composer require maatwebsite/excel

# PDF export
composer require barryvdh/laravel-dompdf
```

### 6. Setup Filament
```bash
php artisan filament:install --panels
# When asked about panel ID: type "admin"
# When asked about route: type "/admin"

# Create admin user (or use seeder: admin@descan.go.id / password)
php artisan make:filament-user
```

### 7. Run development server
```bash
# Option A: all-in-one (if you added the "dev" script to composer.json)
composer run dev

# Option B: manual (2 terminals)
php artisan serve
npm run dev
```

---

## Default Login
- URL:      http://localhost:8000/admin
- Email:    admin@descan.go.id
- Password: password
