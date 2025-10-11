@echo off
echo ========================================
echo Installing Dynamic Online Tools Platform
echo ========================================
echo.

echo [1/4] Installing Composer dependencies...
call composer install
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b %errorlevel%
)
echo Composer dependencies installed successfully!
echo.

echo [2/4] Installing npm dependencies...
call npm install
if %errorlevel% neq 0 (
    echo ERROR: npm install failed!
    pause
    exit /b %errorlevel%
)
echo npm dependencies installed successfully!
echo.

echo [3/4] Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo .env file created!
) else (
    echo .env file already exists, skipping...
)
echo.

echo [4/4] Generating application key...
php artisan key:generate
echo.

echo ========================================
echo Installation Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Create database 'online_tools' in phpMyAdmin
echo 2. Update .env file with your database credentials
echo 3. Run: php artisan migrate --seed
echo 4. Run: npm run dev (in one terminal)
echo 5. Run: php artisan serve (in another terminal)
echo.
pause
