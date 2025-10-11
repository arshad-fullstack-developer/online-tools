# Setup Commands - Copy & Paste

## Option 1: Automated Installation

### Using Batch File (Recommended for Windows)
```bash
cd g:/xampp/htdocs/online-tools
install.bat
```

### Using PowerShell
```powershell
cd g:/xampp/htdocs/online-tools
.\install.ps1
```

---

## Option 2: Manual Installation

### Step 1: Navigate to Project Directory
```bash
cd g:/xampp/htdocs/online-tools
```

### Step 2: Install Composer Dependencies
```bash
composer install
```

**What this installs:**
- Laravel 12 framework
- Inertia.js Laravel adapter
- Laravel Breeze
- Spatie packages (sitemap, permissions)
- All other PHP dependencies

**Expected time:** 2-3 minutes

---

### Step 3: Install npm Dependencies
```bash
npm install
```

**What this installs:**
- Vue.js 3
- Inertia.js Vue adapter
- TailwindCSS
- Vite
- Headless UI
- Heroicons
- Lucide icons
- All other JavaScript dependencies

**Expected time:** 3-5 minutes

---

### Step 4: Setup Environment File
```bash
copy .env.example .env
```

---

### Step 5: Generate Application Key
```bash
php artisan key:generate
```

---

### Step 6: Create Database

**Option A: Using phpMyAdmin**
1. Open: http://localhost/phpmyadmin
2. Click "New" in the left sidebar
3. Database name: `online_tools`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

**Option B: Using MySQL Command Line**
```sql
CREATE DATABASE online_tools CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### Step 7: Configure Database

Edit `.env` file and update these lines:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_tools
DB_USERNAME=root
DB_PASSWORD=
```

---

### Step 8: Run Migrations and Seeders
```bash
php artisan migrate --seed
```

**What this does:**
- Creates all database tables
- Seeds admin user (admin@example.com / password)
- Seeds 4 categories
- Seeds 10 tools
- Seeds default settings

---

### Step 9: Create Storage Link
```bash
php artisan storage:link
```

---

### Step 10: Start Development Servers

**Terminal 1 - Frontend Dev Server:**
```bash
npm run dev
```
Keep this running!

**Terminal 2 - Laravel Server:**
```bash
php artisan serve
```

---

## ✅ Access Your Application

- **Website:** http://localhost:8000
- **Admin Panel:** http://localhost:8000/admin/dashboard
- **Login:** admin@example.com / password

---

## 🔧 Troubleshooting

### Issue: "composer: command not found"
**Solution:** Install Composer from https://getcomposer.org/

### Issue: "npm: command not found"
**Solution:** Install Node.js from https://nodejs.org/

### Issue: Composer install fails
**Solution:**
```bash
composer clear-cache
composer install --no-scripts
composer install
```

### Issue: npm install fails
**Solution:**
```bash
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
```

### Issue: "Class not found" errors
**Solution:**
```bash
composer dump-autoload
```

### Issue: Permission errors
**Solution:**
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Database connection error
**Solution:**
1. Ensure MySQL is running in XAMPP
2. Verify database name in .env
3. Check username and password
4. Ensure database exists

---

## 📦 What Gets Installed

### Composer Dependencies (~50MB)
- laravel/framework
- laravel/breeze
- inertiajs/inertia-laravel
- tightenco/ziggy
- spatie/laravel-sitemap
- spatie/laravel-permission
- And more...

### npm Dependencies (~200MB)
- vue
- @inertiajs/vue3
- @vitejs/plugin-vue
- tailwindcss
- @tailwindcss/forms
- @headlessui/vue
- @heroicons/vue
- lucide-vue-next
- vite
- axios
- And more...

---

## 🚀 After Installation

### Verify Installation
```bash
# Check Laravel version
php artisan --version

# Check if all routes are loaded
php artisan route:list

# Check database connection
php artisan migrate:status
```

### Build for Production
```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📝 Quick Reference

### Development Commands
```bash
# Start frontend dev server
npm run dev

# Start Laravel server
php artisan serve

# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create new migration
php artisan make:migration create_table_name

# Create new controller
php artisan make:controller ControllerName
```

### Production Commands
```bash
# Build assets
npm run build

# Optimize application
php artisan optimize

# Cache config
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

---

## ✨ You're All Set!

Your Dynamic Online Tools Platform is now ready for development!

**Next Steps:**
1. Explore the admin dashboard
2. Test all 10 tools
3. Create your first custom tool
4. Customize the design
5. Deploy to production

**Need Help?** Check the documentation files:
- README.md
- INSTALLATION.md
- FEATURES.md
- DEPLOYMENT.md
