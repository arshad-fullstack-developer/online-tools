@echo off
echo Configuring SQLite for Online Tools Platform...
echo.

REM Create SQLite database file
echo Creating SQLite database...
type nul > database\database.sqlite
echo SQLite database created at database\database.sqlite
echo.

REM Update .env file for SQLite
echo Updating .env file for SQLite...
powershell -Command "(Get-Content .env) -replace 'DB_CONNECTION=mysql', 'DB_CONNECTION=sqlite' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_HOST=127.0.0.1', '# DB_HOST=127.0.0.1' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PORT=3306', '# DB_PORT=3306' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_DATABASE=online_tools', '# DB_DATABASE=online_tools' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_USERNAME=root', '# DB_USERNAME=root' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PASSWORD=', '# DB_PASSWORD=' | Set-Content .env"
echo .env file updated!
echo.

echo Running migrations and seeders...
php artisan migrate:fresh --seed
echo.

echo ========================================
echo SQLite Setup Complete!
echo ========================================
echo.
echo Database file: database\database.sqlite
echo.
echo Next steps:
echo 1. Run: npm run dev (in one terminal)
echo 2. Run: php artisan serve (in another terminal)
echo 3. Visit: http://localhost:8000
echo 4. Admin: http://localhost:8000/admin/dashboard
echo 5. Login: admin@example.com / password
echo.
pause
