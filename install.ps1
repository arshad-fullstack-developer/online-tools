Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Installing Dynamic Online Tools Platform" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Step 1: Install Composer dependencies
Write-Host "[1/4] Installing Composer dependencies..." -ForegroundColor Yellow
try {
    composer install
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Composer dependencies installed successfully!" -ForegroundColor Green
    } else {
        throw "Composer install failed"
    }
} catch {
    Write-Host "✗ ERROR: Composer install failed!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
    pause
    exit 1
}
Write-Host ""

# Step 2: Install npm dependencies
Write-Host "[2/4] Installing npm dependencies..." -ForegroundColor Yellow
try {
    npm install
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ npm dependencies installed successfully!" -ForegroundColor Green
    } else {
        throw "npm install failed"
    }
} catch {
    Write-Host "✗ ERROR: npm install failed!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
    pause
    exit 1
}
Write-Host ""

# Step 3: Setup environment file
Write-Host "[3/4] Setting up environment file..." -ForegroundColor Yellow
if (!(Test-Path .env)) {
    Copy-Item .env.example .env
    Write-Host "✓ .env file created!" -ForegroundColor Green
} else {
    Write-Host "✓ .env file already exists, skipping..." -ForegroundColor Green
}
Write-Host ""

# Step 4: Generate application key
Write-Host "[4/4] Generating application key..." -ForegroundColor Yellow
php artisan key:generate
Write-Host ""

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Installation Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Create database 'online_tools' in phpMyAdmin" -ForegroundColor White
Write-Host "2. Update .env file with your database credentials" -ForegroundColor White
Write-Host "3. Run: php artisan migrate --seed" -ForegroundColor White
Write-Host "4. Run: npm run dev (in one terminal)" -ForegroundColor White
Write-Host "5. Run: php artisan serve (in another terminal)" -ForegroundColor White
Write-Host ""
pause
