# Deployment Guide

## 🚀 Production Deployment Checklist

### Pre-Deployment Steps

#### 1. Environment Configuration

Update your `.env` file for production:

```env
APP_NAME="Online Tools"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_secure_password

CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password
REDIS_PORT=6379
```

#### 2. Build Assets

```bash
npm run build
```

#### 3. Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

#### 4. Database Migration

```bash
php artisan migrate --force
php artisan db:seed --force
```

#### 5. Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 🌐 Deployment Options

### Option 1: Shared Hosting (cPanel)

#### Step 1: Upload Files

1. Compress your project: `zip -r online-tools.zip .`
2. Upload to hosting via FTP/cPanel File Manager
3. Extract in public_html or subdirectory

#### Step 2: Configure Database

1. Create MySQL database in cPanel
2. Create database user
3. Update `.env` with credentials

#### Step 3: Point Domain

1. If in subdirectory, create `.htaccess` redirect
2. Or point domain to `/public` folder

#### Step 4: Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
```

### Option 2: VPS (Ubuntu/Nginx)

#### Step 1: Install Requirements

```bash
sudo apt update
sudo apt install php8.3 php8.3-fpm php8.3-mysql php8.3-xml php8.3-mbstring php8.3-curl php8.3-zip
sudo apt install nginx mysql-server redis-server
sudo apt install composer nodejs npm
```

#### Step 2: Clone/Upload Project

```bash
cd /var/www
git clone your-repo.git online-tools
cd online-tools
composer install --optimize-autoloader --no-dev
npm install && npm run build
```

#### Step 3: Configure Nginx

Create `/etc/nginx/sites-available/online-tools`:

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/online-tools/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/online-tools /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

#### Step 4: SSL Certificate (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

#### Step 5: Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/online-tools
sudo chmod -R 755 /var/www/online-tools/storage
sudo chmod -R 755 /var/www/online-tools/bootstrap/cache
```

#### Step 6: Setup Queue Worker (Optional)

Create `/etc/systemd/system/online-tools-worker.service`:

```ini
[Unit]
Description=Online Tools Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/online-tools/artisan queue:work --sleep=3 --tries=3 --max-time=3600

[Install]
WantedBy=multi-user.target
```

Enable and start:
```bash
sudo systemctl enable online-tools-worker
sudo systemctl start online-tools-worker
```

### Option 3: Docker Deployment

#### Create Dockerfile

```dockerfile
FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application
COPY . .

# Install dependencies
RUN composer install --optimize-autoloader --no-dev
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage

EXPOSE 9000
CMD ["php-fpm"]
```

#### Docker Compose

```yaml
version: '3.8'
services:
  app:
    build: .
    volumes:
      - .:/var/www
    networks:
      - app-network

  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
    volumes:
      - .:/var/www
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
    networks:
      - app-network

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: online_tools
      MYSQL_ROOT_PASSWORD: secret
    volumes:
      - mysql-data:/var/lib/mysql
    networks:
      - app-network

  redis:
    image: redis:alpine
    networks:
      - app-network

networks:
  app-network:
    driver: bridge

volumes:
  mysql-data:
```

Deploy:
```bash
docker-compose up -d
docker-compose exec app php artisan migrate --seed
```

## 🔒 Security Hardening

### 1. Environment Security

- Never commit `.env` to version control
- Use strong database passwords
- Rotate APP_KEY regularly
- Enable HTTPS only

### 2. File Permissions

```bash
# Directories
find . -type d -exec chmod 755 {} \;

# Files
find . -type f -exec chmod 644 {} \;

# Storage and cache
chmod -R 775 storage bootstrap/cache
```

### 3. Disable Directory Listing

Add to `.htaccess`:
```apache
Options -Indexes
```

### 4. Hide Laravel Version

Remove from headers in production

### 5. Rate Limiting

Already configured in routes, adjust as needed

### 6. Database Security

- Use separate database user with limited privileges
- Enable SSL for database connections
- Regular backups

## 📊 Performance Optimization

### 1. Enable OPcache

In `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
```

### 2. Use Redis Cache

```env
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### 3. CDN Integration

- Upload assets to CDN
- Update `APP_URL` to CDN URL
- Configure asset URLs

### 4. Database Optimization

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. Enable Gzip Compression

Nginx:
```nginx
gzip on;
gzip_vary on;
gzip_types text/plain text/css application/json application/javascript text/xml application/xml;
```

## 🔄 Continuous Deployment

### GitHub Actions Example

`.github/workflows/deploy.yml`:

```yaml
name: Deploy

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.3
      
      - name: Install Dependencies
        run: composer install --no-dev --optimize-autoloader
      
      - name: Build Assets
        run: |
          npm install
          npm run build
      
      - name: Deploy to Server
        uses: appleboy/scp-action@master
        with:
          host: ${{ secrets.HOST }}
          username: ${{ secrets.USERNAME }}
          key: ${{ secrets.SSH_KEY }}
          source: "."
          target: "/var/www/online-tools"
      
      - name: Run Migrations
        uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.HOST }}
          username: ${{ secrets.USERNAME }}
          key: ${{ secrets.SSH_KEY }}
          script: |
            cd /var/www/online-tools
            php artisan migrate --force
            php artisan optimize
```

## 📈 Monitoring

### 1. Error Logging

Configure in `.env`:
```env
LOG_CHANNEL=stack
LOG_LEVEL=error
```

### 2. Application Monitoring

- Install Laravel Telescope (dev only)
- Use services like New Relic, Datadog
- Monitor server resources

### 3. Uptime Monitoring

- Use UptimeRobot or Pingdom
- Set up alerts for downtime

## 🔧 Maintenance Mode

Enable maintenance:
```bash
php artisan down --secret="your-secret-token"
```

Access during maintenance:
```
https://yourdomain.com/your-secret-token
```

Disable maintenance:
```bash
php artisan up
```

## 📦 Backup Strategy

### Database Backup

```bash
# Daily backup script
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql
```

### File Backup

```bash
# Backup storage and uploads
tar -czf backup_$(date +%Y%m%d).tar.gz storage public/uploads
```

### Automated Backups

Use cron jobs or Laravel backup packages like `spatie/laravel-backup`

## 🆘 Troubleshooting

### Issue: 500 Internal Server Error
- Check storage permissions
- Review error logs
- Clear cache: `php artisan cache:clear`

### Issue: Assets not loading
- Run `npm run build`
- Check public path configuration
- Verify CDN settings

### Issue: Database connection failed
- Verify credentials in `.env`
- Check database server status
- Ensure database exists

### Issue: Queue not processing
- Check queue worker status
- Restart queue: `php artisan queue:restart`
- Review failed jobs: `php artisan queue:failed`

## ✅ Post-Deployment Checklist

- [ ] SSL certificate installed and working
- [ ] Database migrated successfully
- [ ] All environment variables set correctly
- [ ] File permissions configured
- [ ] Cache and optimization commands run
- [ ] Sitemap accessible
- [ ] Admin panel accessible
- [ ] All tools working correctly
- [ ] Error logging configured
- [ ] Backup system in place
- [ ] Monitoring tools setup
- [ ] Performance tested
- [ ] Security headers configured
- [ ] SEO meta tags verified

---

**Your Dynamic Online Tools Platform is now live! 🎉**
