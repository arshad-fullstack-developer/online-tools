# 🚀 Live Deployment Checklist

## Before Upload

- [ ] Run `npm run build` to compile assets
- [ ] Test locally with `php artisan serve`
- [ ] Backup your database
- [ ] Create `.env` file for production

---

## Files to Upload

Upload these files/folders to your server:

### ✅ Required Files
- [ ] `app/` folder
- [ ] `bootstrap/` folder
- [ ] `config/` folder
- [ ] `database/` folder (migrations & seeders)
- [ ] `public/` folder (with `.htaccess` inside)
- [ ] `resources/` folder
- [ ] `routes/` folder
- [ ] `storage/` folder
- [ ] `vendor/` folder (or run `composer install` on server)
- [ ] `.htaccess` (in root folder) ← **IMPORTANT**
- [ ] `.env` (create new for production)
- [ ] `artisan`
- [ ] `composer.json`
- [ ] `composer.lock`
- [ ] `package.json`

### ❌ Do NOT Upload
- [ ] `node_modules/` (too large)
- [ ] `.git/` (not needed)
- [ ] `.env.example` (use `.env` instead)
- [ ] `tests/` (optional)
- [ ] `*.md` files (optional)

---

## After Upload

### 1️⃣ Fix /public in URL
Choose ONE method:

**Method A: Change Document Root (Best)**
- [ ] Go to cPanel → Domains
- [ ] Set Document Root to `/public_html/public`
- [ ] Save changes

**Method B: Use .htaccess (Easiest)**
- [ ] Upload `.htaccess` to root folder (already created)
- [ ] Ensure `mod_rewrite` is enabled

### 2️⃣ Configure .env File
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3️⃣ Set File Permissions
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/app/public
```

### 4️⃣ Run Commands (via SSH or Terminal)
```bash
# Install dependencies (if vendor not uploaded)
composer install --optimize-autoloader --no-dev

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5️⃣ Import Database
- [ ] Export database from local (phpMyAdmin or command)
- [ ] Import to live database
- [ ] Update `.env` with live database credentials

---

## Testing

Visit these URLs to verify everything works:

- [ ] `https://yourdomain.com` → Homepage
- [ ] `https://yourdomain.com/about` → About page
- [ ] `https://yourdomain.com/tools` → Tools listing
- [ ] `https://yourdomain.com/tools/any-tool` → Tool page
- [ ] `https://yourdomain.com/blog` → Blog listing
- [ ] `https://yourdomain.com/contact` → Contact page
- [ ] `https://yourdomain.com/secure-access` → Admin login
- [ ] Test admin dashboard after login
- [ ] Test uploading images in admin
- [ ] Test creating/editing content

---

## Common Issues & Fixes

### ❌ 404 Error on All Pages
**Fix:**
- [ ] Check `.htaccess` exists in `public/` folder
- [ ] Enable `mod_rewrite` on server
- [ ] Contact hosting support

### ❌ 500 Internal Server Error
**Fix:**
- [ ] Check file permissions (755 for folders, 644 for files)
- [ ] Check error logs: `/storage/logs/laravel.log`
- [ ] Enable debug: `APP_DEBUG=true` temporarily

### ❌ Images Not Loading
**Fix:**
- [ ] Run `php artisan storage:link`
- [ ] Check `storage/app/public` folder exists
- [ ] Verify permissions: `chmod -R 775 storage`

### ❌ CSS/JS Not Loading
**Fix:**
- [ ] Check `public/build/` folder exists
- [ ] Run `npm run build` locally and re-upload
- [ ] Clear browser cache (Ctrl+F5)
- [ ] Set `ASSET_URL` in `.env`

### ❌ Database Connection Error
**Fix:**
- [ ] Verify database credentials in `.env`
- [ ] Check database exists on server
- [ ] Run `php artisan config:clear`

---

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_ENV=production` in `.env`
- [ ] Strong `APP_KEY` generated
- [ ] Database password is strong
- [ ] `.env` file is NOT publicly accessible
- [ ] `storage/` and `bootstrap/cache/` are writable
- [ ] SSL certificate installed (HTTPS)
- [ ] Change default admin password

---

## Performance Optimization

```bash
# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Enable OPcache (ask hosting support)
```

---

## Maintenance Mode

**Enable maintenance mode:**
```bash
php artisan down --secret="your-secret-key"
```

**Access site during maintenance:**
Visit: `https://yourdomain.com/your-secret-key`

**Disable maintenance mode:**
```bash
php artisan up
```

---

## Quick Commands Reference

```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database
php artisan migrate --force
php artisan db:seed --force

# Storage
php artisan storage:link

# Queue (if using)
php artisan queue:restart
```

---

## Support

If you need help:
1. Check `storage/logs/laravel.log` for errors
2. Enable debug mode temporarily: `APP_DEBUG=true`
3. Contact your hosting support for server issues
4. Check Laravel documentation: https://laravel.com/docs

---

## ✅ Deployment Complete!

Once all items are checked, your site should be live and working perfectly!

**Don't forget to:**
- Set `APP_DEBUG=false` after testing
- Test all functionality
- Monitor error logs for first few days
- Set up automated backups
