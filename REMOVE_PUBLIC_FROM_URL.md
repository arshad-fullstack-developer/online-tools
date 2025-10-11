# How to Remove /public from URL

## Problem
Your site shows: `https://yourdomain.com/public/about` instead of `https://yourdomain.com/about`

---

## ✅ Solution 1: Change Document Root (RECOMMENDED)

This is the **best and most secure** method.

### For cPanel Hosting:
1. Login to cPanel
2. Go to **Domains** section
3. Click on your domain name
4. Find **Document Root** field
5. Change it from:
   - ❌ `/public_html` or `/home/username/public_html`
   - ✅ `/public_html/public` or `/home/username/public_html/public`
6. Click **Save** or **Update**

### For Plesk Hosting:
1. Login to Plesk
2. Go to **Domains** → Select your domain
3. Click **Hosting Settings**
4. Change **Document root** to: `/httpdocs/public`
5. Click **OK**

### For DirectAdmin:
1. Login to DirectAdmin
2. Go to **Domain Setup**
3. Click on your domain
4. Change **Document Root** to: `public_html/public`
5. Save changes

### For Custom VPS/Dedicated Server:
Edit your Apache virtual host config:

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /var/www/html/public  # Add /public here
    
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Then restart Apache:
```bash
sudo systemctl restart apache2
```

---

## ✅ Solution 2: Use .htaccess Redirect (EASIEST)

If you **cannot change document root**, use this method.

### Step 1: Create .htaccess in Root Folder

**File:** `.htaccess` (in root folder, NOT in public folder)

**Already created for you!** Just upload it to your server.

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Redirect all requests to public folder
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
```

### Step 2: Upload Files

Your file structure should be:
```
/public_html/  (or /home/username/public_html/)
├── .htaccess  ← THIS FILE redirects to public
├── .env
├── artisan
├── composer.json
├── public/
│   ├── .htaccess  ← Laravel routing rules
│   ├── index.php
│   ├── build/
│   └── storage/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
└── vendor/
```

### Step 3: Test
Visit: `https://yourdomain.com` (without /public)

---

## ✅ Solution 3: Move Public Contents to Root (NOT RECOMMENDED)

Only use this if Solutions 1 & 2 don't work.

### Step 1: Move Files
1. Move all files from `public/` folder to root folder
2. Delete empty `public/` folder

### Step 2: Update index.php

Edit `index.php` (now in root):

**Change this:**
```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

**To this:**
```php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

### Step 3: Update AppServiceProvider

Edit `app/Providers/AppServiceProvider.php`:

Add this to the `register()` method:

```php
public function register(): void
{
    // Set public path to root
    $this->app->bind('path.public', function() {
        return base_path();
    });
}
```

### Step 4: Update .env
```env
ASSET_URL=https://yourdomain.com
```

### ⚠️ Security Warning
This method exposes your `.env` file and other sensitive files to the web. Use Solutions 1 or 2 instead!

---

## Testing Your Setup

After applying any solution, test these URLs (should all work):

✅ `https://yourdomain.com` → Homepage  
✅ `https://yourdomain.com/about` → About page  
✅ `https://yourdomain.com/tools` → Tools page  
✅ `https://yourdomain.com/blog` → Blog page  
✅ `https://yourdomain.com/contact` → Contact page  
✅ `https://yourdomain.com/secure-access` → Admin login  

❌ `https://yourdomain.com/public/about` → Should NOT work or redirect

---

## Troubleshooting

### Issue: Still showing /public in URL

**Check:**
1. ✅ `.htaccess` file exists in root folder
2. ✅ `mod_rewrite` is enabled on server
3. ✅ Clear browser cache (Ctrl+F5)
4. ✅ Check if `.htaccess` is being read

**Test if .htaccess works:**
Add this to root `.htaccess`:
```apache
# TEST - Remove after testing
Redirect 301 /test.html https://google.com
```
Visit: `yourdomain.com/test.html` - Should redirect to Google

### Issue: 500 Internal Server Error

**Cause:** `mod_rewrite` not enabled or `.htaccess` not allowed

**Solution:**
1. Contact hosting support to enable `mod_rewrite`
2. Ask them to set `AllowOverride All` for your directory

### Issue: CSS/JS not loading

**Solution:**
Update `.env`:
```env
ASSET_URL=https://yourdomain.com
```

Then run:
```bash
php artisan config:cache
```

---

## Which Solution Should I Use?

| Solution | Difficulty | Security | Recommended |
|----------|-----------|----------|-------------|
| **Solution 1** (Document Root) | Medium | ⭐⭐⭐⭐⭐ Best | ✅ YES |
| **Solution 2** (.htaccess) | Easy | ⭐⭐⭐⭐ Good | ✅ YES |
| **Solution 3** (Move Files) | Hard | ⭐⭐ Poor | ❌ NO |

**Recommendation:** Try Solution 1 first. If you can't change document root, use Solution 2.

---

## Quick Commands After Deployment

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link
```

---

## Need Help?

If you're still having issues:
1. Check your hosting control panel documentation
2. Contact your hosting support
3. Share your hosting provider name for specific instructions
