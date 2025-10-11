# Live Server Deployment Guide - Fix 404 Errors

## Common Issues & Solutions

### 1. ✅ .htaccess File (MOST IMPORTANT)
The `.htaccess` file in the `public` folder is **REQUIRED** for Laravel routing to work.

**Already created for you at:** `public/.htaccess`

Make sure this file is uploaded to your live server's public folder.

---

## Deployment Steps

### Step 1: Upload Files
Upload all files to your live server. Your directory structure should be:

```
/home/yourdomain/
├── public_html/  (or www/ or httpdocs/)
│   ├── .htaccess  ← MUST BE HERE
│   ├── index.php
│   ├── build/
│   └── storage/ (symlink)
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
└── vendor/
```

### Step 2: Remove /public from URL

You have **3 options** to remove `/public` from your URL:

---

#### **Option A: Change Document Root (BEST METHOD)**
Point your domain to the `public` folder.

**Via cPanel:**
1. Go to cPanel → Domains
2. Click on your domain
3. Set Document Root to `/public_html/public` or `/home/username/public_html/public`
4. Save changes

**Via Hosting Control Panel:**
- Look for "Document Root" or "Web Root" settings
- Change from `/public_html` to `/public_html/public`

---

#### **Option B: Use .htaccess Redirect (EASIEST)**
If you can't change document root, use the `.htaccess` file in root folder.

**Already created for you at:** `.htaccess` (in root folder)

This redirects all requests to the `public` folder automatically.

**File structure:**
```
/public_html/
├── .htaccess  ← Redirects to public folder
├── public/
│   ├── .htaccess  ← Laravel routing
│   ├── index.php
│   └── ...
├── app/
├── bootstrap/
└── ...
```

---

#### **Option C: Move Files (For Shared Hosting)**
If options A & B don't work, move public folder contents to root.

**Steps:**
1. Move everything from `public/` to root folder
2. Update `index.php` paths (change `__DIR__.'/../'` to `__DIR__.'/'`)
3. Update `public_path()` in `AppServiceProvider.php`

**⚠️ Not recommended** - Use Option A or B instead.

---

### Step 3: Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/app/public
```

### Step 4: Update .env File
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Step 5: Run Commands (via SSH)
```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate app key
php artisan key:generate

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link

# Run migrations
php artisan migrate --force
```

### Step 6: Build Assets
Before uploading, run locally:
```bash
npm install
npm run build
```

Then upload the `public/build` folder to your live server.

---

## Troubleshooting 404 Errors

### Issue 1: .htaccess Not Working
**Solution:** Enable mod_rewrite in Apache

Add to your Apache config or contact hosting support:
```apache
<Directory /path/to/your/public>
    AllowOverride All
</Directory>
```

### Issue 2: All Pages Show 404
**Checklist:**
- ✅ `.htaccess` exists in `public` folder
- ✅ `mod_rewrite` is enabled
- ✅ Document root points to `public` folder
- ✅ File permissions are correct (755)

### Issue 3: Homepage Works, Other Pages 404
**Solution:** This means `.htaccess` is not being read.

1. Check if `mod_rewrite` is enabled:
```bash
php -m | grep rewrite
```

2. Check Apache config allows `.htaccess`:
```apache
AllowOverride All
```

### Issue 4: Assets Not Loading
**Solution:** Run storage link command:
```bash
php artisan storage:link
```

---

## Quick Fix Commands

If you have SSH access, run these:

```bash
# Fix permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Nginx Configuration (If Using Nginx)

If your server uses Nginx instead of Apache, add this to your site config:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
}
```

---

## Testing Checklist

After deployment, test these URLs:
- ✅ Homepage: `https://yourdomain.com`
- ✅ About: `https://yourdomain.com/about`
- ✅ Tools: `https://yourdomain.com/tools`
- ✅ Blog: `https://yourdomain.com/blog`
- ✅ Contact: `https://yourdomain.com/contact`
- ✅ Admin: `https://yourdomain.com/secure-access`

---

## Need Help?

If 404 errors persist:
1. Check server error logs: `/var/log/apache2/error.log`
2. Enable debug mode temporarily: `APP_DEBUG=true` in `.env`
3. Contact your hosting support to enable `mod_rewrite`
4. Verify document root points to `public` folder
