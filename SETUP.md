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

### 5. Install packages (run once, BE1 task)
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

## ══════════════════════════════════
## OPTION B — GitHub Codespaces
## ══════════════════════════════════

GitHub Codespaces has PostgreSQL built-in! Here's how to use it:

### 1. Open Codespace
- Go to github.com/BpsKabupatenBerau/descan-2026
- Click "Code" → "Codespaces" → "Create codespace on main"
- Wait ~2 minutes for environment to boot

### 2. Check PostgreSQL status
```bash
# PostgreSQL is pre-installed in Codespaces
sudo service postgresql start
sudo -u postgres psql

# Inside psql:
CREATE DATABASE descan_2026;
CREATE USER descan_user WITH PASSWORD 'password';
GRANT ALL PRIVILEGES ON DATABASE descan_2026 TO descan_user;
ALTER USER descan_user CREATEDB;
\q
```

### 3. Configure .env (same as local, but these ports differ)
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=descan_2026
DB_USERNAME=descan_user
DB_PASSWORD=password
```

### 4. Continue from Step 4 in Option A (same commands)
```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### 5. Forward ports in Codespaces
- Codespaces auto-detects port 8000 when you run `php artisan serve`
- Click the "Ports" tab → port 8000 → "Open in Browser"
- For npm dev: port 5173 is also auto-forwarded

---

## ══════════════════════════════════
## GIT WORKFLOW (for the team)
## ══════════════════════════════════

```bash
# Day 1 setup (BE1 does this once):
git checkout main
git checkout -b develop
git push origin develop
# Then in GitHub Settings → set develop as default branch

# Everyone else:
git checkout develop
git pull origin develop
git checkout -b feature/your-name-task
# e.g. feature/be1-migrations, feature/fe1-beranda

# Daily:
git add .
git commit -m "feat: add migrations for statistik tables"
git push origin feature/be1-migrations

# When done: open Pull Request to develop on GitHub
# At least 1 person reviews before merge

# Stay up to date each morning:
git checkout develop && git pull origin develop
git checkout feature/your-branch && git merge develop
```

### Branch naming convention:
```
feature/be1-migrations       # Backend Dev 1 tasks
feature/be2-controllers      # Backend Dev 2 tasks
feature/fe1-public-pages     # Frontend Dev 1
feature/fe2-admin-panel      # Frontend Dev 2
hotfix/fix-spasial-form      # Bug fixes
```

---

## ══════════════════════════════════
## FILE STRUCTURE (BE1 owns these)
## ══════════════════════════════════

```
database/
  migrations/
    2025_01_01_000001_create_tahun_bulan_table.php
    2025_01_01_000002_create_users_table.php
    2025_01_01_000003_create_master_tables.php
    2025_01_01_000004_create_kategori_tables.php
    2025_01_01_000005_create_statistik_tables.php
    2025_01_01_000006_create_content_tables.php
  seeders/
    DatabaseSeeder.php

app/Models/
  User.php
  Tahun.php
  Bulan.php
  KategoriPublikasi.php
  Setting.php
  SatuanStatistik.php
  KategoriStatistik.php
  KategoriSpasial.php
  TabelStatistik.php
  InputDataTabel.php
  InputDataSpasial.php
  InputInfografis.php
  InputPublikasi.php
```

---

## ══════════════════════════════════
## DESIGN REFERENCE
## ══════════════════════════════════

All UI designs are in `/desain-web.zip`:
```
01-Beranda-OK.svg              → FE1 builds this
02a-Kependudukan-*.svg         → FE1
03-Spasial-Peta.svg            → FE1
04-Infografis-OK.svg           → FE1
05-Publikasi-OK.svg            → FE1
06-Login-Admin.svg             → FE2
07-Admin-Dashboard-OK.svg      → FE2
08~18-Admin-*.svg              → FE2
```

---

## ══════════════════════════════════
## QUICK COMMANDS REFERENCE
## ══════════════════════════════════

```bash
# Re-run migrations (fresh start)
php artisan migrate:fresh --seed

# Clear all caches
php artisan optimize:clear

# Generate Filament resource
php artisan make:filament-resource KategoriStatistik --generate

# Make a model + migration + seeder
php artisan make:model ModelName -ms

# Check routes
php artisan route:list

# Tail logs
php artisan pail
```

---

## Default Login
- URL:      http://localhost:8000/admin
- Email:    admin@descan.go.id
- Password: password
