# Installation Guide - Dynamic Online Tools Platform

## Prerequisites

Before you begin, ensure you have the following installed:

- **PHP 8.3** or higher
- **Composer** (latest version)
- **Node.js 18+** and **npm**
- **MySQL 8.0+** or **MariaDB 10.3+**
- **XAMPP** (or any other local server environment)

## Step-by-Step Installation

### 1. Navigate to Project Directory

```bash
cd g:/xampp/htdocs/online-tools
```

### 2. Install PHP Dependencies

```bash
composer install
```

This will install all Laravel dependencies including:
- Laravel 12
- Inertia.js Laravel adapter
- Laravel Breeze
- Spatie packages for sitemap and permissions

### 3. Install Node Dependencies

```bash
npm install
```

This will install:
- Vue.js 3
- Inertia.js Vue adapter
- TailwindCSS
- Vite
- Other frontend dependencies

### 4. Environment Configuration

Copy the example environment file:

```bash
copy .env.example .env
```

Edit `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_tools
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Create Database

Create a new MySQL database named `online_tools`:

**Option 1: Using phpMyAdmin**
1. Open http://localhost/phpmyadmin
2. Click "New" to create a database
3. Name it `online_tools`
4. Set collation to `utf8mb4_unicode_ci`

**Option 2: Using MySQL Command Line**
```sql
CREATE DATABASE online_tools CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This will:
- Create all necessary database tables
- Seed initial data including:
  - Admin user (email: admin@example.com, password: password)
  - 4 categories (Text Tools, Date Tools, Finance Tools, Developer Tools)
  - 10 pre-configured tools
  - Default settings

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Build Frontend Assets

**For Development:**
```bash
npm run dev
```

**For Production:**
```bash
npm run build
```

### 10. Start the Development Server

Open a new terminal and run:

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

## Default Login Credentials

**Admin Panel Access:**
- Email: `admin@example.com`
- Password: `password`

**Admin Dashboard URL:** http://localhost:8000/admin/dashboard

## Project Structure

```
online-tools/
├── app/
│   ├── Http/Controllers/          # Controllers
│   │   ├── Admin/                 # Admin controllers
│   │   ├── HomeController.php
│   │   ├── ToolController.php
│   │   └── CategoryController.php
│   └── Models/                    # Eloquent models
│       ├── Category.php
│       ├── Tool.php
│       ├── ToolAnalytic.php
│       └── Setting.php
├── database/
│   ├── migrations/                # Database migrations
│   └── seeders/                   # Database seeders
├── resources/
│   ├── js/
│   │   ├── Components/            # Vue components
│   │   │   └── Tools/             # Tool components
│   │   ├── Layouts/               # Layout components
│   │   ├── Pages/                 # Inertia pages
│   │   │   ├── Admin/             # Admin pages
│   │   │   ├── Categories/
│   │   │   └── Tools/
│   │   └── app.js                 # Main JS entry
│   ├── css/
│   │   └── app.css                # Tailwind CSS
│   └── views/
│       └── app.blade.php          # Main blade template
├── routes/
│   ├── web.php                    # Web routes
│   └── auth.php                   # Auth routes
├── public/                        # Public assets
├── .env.example                   # Environment example
├── composer.json                  # PHP dependencies
├── package.json                   # Node dependencies
├── vite.config.js                 # Vite configuration
└── tailwind.config.js             # Tailwind configuration
```

## Available Tools

The platform comes pre-configured with 10 tools:

### Text & String Tools
1. **Word Counter** - Count words, characters, sentences, and paragraphs
2. **Text Case Converter** - Convert text case (upper, lower, title, camel, snake)
3. **JSON Formatter** - Format and validate JSON
4. **Slug Generator** - Generate SEO-friendly URL slugs

### Date & Time Tools
5. **Age Calculator** - Calculate exact age from date of birth
6. **Date Difference Calculator** - Calculate difference between two dates

### Finance Tools
7. **Discount Calculator** - Calculate discounts and final prices
8. **Loan EMI Calculator** - Calculate monthly EMI and interest

### Developer Tools
9. **Base64 Encoder/Decoder** - Encode and decode Base64 strings
10. **Password Generator** - Generate strong random passwords

## Accessing the Application

### Public Website
- Homepage: http://localhost:8000
- Tool Pages: http://localhost:8000/tools/{slug}
- Category Pages: http://localhost:8000/categories/{slug}
- Sitemap: http://localhost:8000/sitemap.xml

### Admin Panel
- Dashboard: http://localhost:8000/admin/dashboard
- Manage Tools: http://localhost:8000/admin/tools
- Manage Categories: http://localhost:8000/admin/categories

## Common Issues & Solutions

### Issue: "Class not found" errors
**Solution:** Run `composer dump-autoload`

### Issue: "Vite manifest not found"
**Solution:** Run `npm run build` or ensure `npm run dev` is running

### Issue: Database connection error
**Solution:** 
1. Verify MySQL is running in XAMPP
2. Check database credentials in `.env`
3. Ensure database exists

### Issue: Permission denied errors
**Solution:** 
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Mix/Vite errors
**Solution:**
```bash
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
```

## Development Workflow

### Running in Development Mode

1. Start XAMPP (Apache + MySQL)
2. Open terminal in project directory
3. Run: `npm run dev` (keep this running)
4. Open another terminal
5. Run: `php artisan serve`
6. Access: http://localhost:8000

### Making Changes

**Frontend Changes (Vue/CSS):**
- Edit files in `resources/js/` or `resources/css/`
- Changes will hot-reload automatically with `npm run dev`

**Backend Changes (PHP/Laravel):**
- Edit files in `app/`, `routes/`, etc.
- Refresh browser to see changes

**Database Changes:**
- Create new migration: `php artisan make:migration create_table_name`
- Run migrations: `php artisan migrate`

## Production Deployment

### Build for Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Settings

Update `.env` for production:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

## Adding New Tools

### 1. Create Tool Component

Create a new Vue component in `resources/js/Components/Tools/YourTool.vue`

### 2. Register in Tool Show Page

Add your component import in `resources/js/Pages/Tools/Show.vue`

### 3. Add Tool via Admin Panel

1. Login to admin panel
2. Go to "Tools" → "Add New Tool"
3. Fill in the details
4. Set Component Name to match your Vue component
5. Save

## Support & Documentation

- **Laravel Documentation:** https://laravel.com/docs/12.x
- **Vue.js Documentation:** https://vuejs.org/guide/
- **Inertia.js Documentation:** https://inertiajs.com/
- **TailwindCSS Documentation:** https://tailwindcss.com/docs

## License

This project is open-sourced software licensed under the MIT license.
