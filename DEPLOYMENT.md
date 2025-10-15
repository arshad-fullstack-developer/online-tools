# cPanel Deployment Guide

## Storage Path Fix

If images are not showing and require `/public/` in the URL, follow these steps:

### 1. .htaccess Fix (Already Applied)
The `.htaccess` file has been updated to automatically rewrite storage URLs from `/storage/` to `/public/storage/`.

### 2. Create Storage Symlink on Server

After uploading to cPanel, run this command via SSH or Terminal in cPanel:

```bash
php artisan storage:link
```

If you don't have SSH access, create the symlink manually:

1. Go to File Manager in cPanel
2. Navigate to `public_html` (or your Laravel root)
3. Create a symbolic link from `public/storage` to `../storage/app/public`

### 3. Alternative: Update Storage Path in Config

If the above doesn't work, you can update the storage URL in your `.env` file:

```env
APP_URL=https://toolxin.com
ASSET_URL=https://toolxin.com
FILESYSTEM_DISK=public
```

### 4. Clear Cache on Server

Run these commands after deployment:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 5. Set Correct Permissions

Ensure these directories have write permissions (755 or 775):

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## Common cPanel Issues

### Issue: 500 Internal Server Error
- Check `.env` file exists and is configured
- Run `php artisan key:generate`
- Check file permissions

### Issue: Database Connection Error
- Update `.env` with correct database credentials
- Ensure database user has all privileges

### Issue: Assets Not Loading
- Run `npm run build` before deployment
- Upload the `public/build` folder

### Issue: Routes Not Working
- Ensure `.htaccess` is uploaded
- Check if mod_rewrite is enabled

## Deployment Checklist

- [ ] Upload all files except `node_modules` and `.env`
- [ ] Create `.env` file on server (copy from `.env.example`)
- [ ] Run `php artisan key:generate`
- [ ] Run `php artisan storage:link`
- [ ] Set correct permissions on storage and cache
- [ ] Run `php artisan migrate` (if needed)
- [ ] Run `php artisan config:cache`
- [ ] Test image uploads and display
- [ ] Test all routes and pages

## Support

If issues persist, check:
1. PHP version (should be 8.1 or higher)
2. Required PHP extensions are installed
3. Apache mod_rewrite is enabled
4. Document root points to `public` folder
