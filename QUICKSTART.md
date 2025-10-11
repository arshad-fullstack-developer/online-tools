# Quick Start Guide

## 🚀 Get Started in 5 Minutes

### Step 1: Install Dependencies (2 minutes)

```bash
cd g:/xampp/htdocs/online-tools
composer install
npm install
```

### Step 2: Configure Environment (1 minute)

```bash
copy .env.example .env
php artisan key:generate
```

Edit `.env` and set your database name:
```env
DB_DATABASE=online_tools
```

### Step 3: Setup Database (1 minute)

1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create database: `online_tools`
3. Run migrations:

```bash
php artisan migrate --seed
```

### Step 4: Start Development (1 minute)

**Terminal 1:**
```bash
npm run dev
```

**Terminal 2:**
```bash
php artisan serve
```

### Step 5: Access Application

- **Website:** http://localhost:8000
- **Admin Panel:** http://localhost:8000/admin/dashboard
- **Login:** admin@example.com / password

## ✅ You're Done!

Your Dynamic Online Tools Platform is now running with:
- ✨ 10 pre-configured tools
- 📊 Admin dashboard with analytics
- 🎨 Beautiful responsive UI
- 🔍 SEO-optimized pages
- 📱 Mobile-friendly design

## 🛠️ Next Steps

1. **Customize Tools:** Go to Admin → Tools to edit existing tools
2. **Add Categories:** Create new tool categories
3. **Create Tools:** Build your own custom tools
4. **Configure SEO:** Update meta tags and descriptions
5. **Enable Analytics:** Add Google Analytics ID in settings

## 📚 Need Help?

See `INSTALLATION.md` for detailed instructions and troubleshooting.

## 🎯 Available Tools

### Text Tools
- Word Counter
- Text Case Converter
- JSON Formatter
- Slug Generator

### Date Tools
- Age Calculator
- Date Difference Calculator

### Finance Tools
- Discount Calculator
- Loan EMI Calculator

### Developer Tools
- Base64 Encoder/Decoder
- Password Generator

---

**Happy Building! 🎉**
