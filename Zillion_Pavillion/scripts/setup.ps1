<#
Project setup helper for Windows PowerShell.

What this script does:
- Checks for PHP, Composer and Node/npm in PATH
- If Composer is missing, attempts to download and install `composer.phar` locally
- Copies `.env.example` to `.env` if missing and generates app key
- Installs PHP (composer) and JS (npm) dependencies when available
- Creates `database\database.sqlite` when using sqlite
- Runs database migrations

Usage: Run from project root in PowerShell (may need to run as a user with network access):
    Set-Location -Path .\
    .\scripts\setup.ps1

Note: The script may download Composer's installer. Inspect files before running in untrusted networks.
#>

$ErrorActionPreference = 'Stop'

function Write-Info($m) { Write-Host "[INFO]  $m" -ForegroundColor Cyan }
function Write-Warn($m) { Write-Host "[WARN]  $m" -ForegroundColor Yellow }
function Write-Err($m) { Write-Host "[ERROR] $m" -ForegroundColor Red }

function Command-Exists($cmd) {
    return [bool](Get-Command $cmd -ErrorAction SilentlyContinue)
}

Write-Info "Checking environment requirements..."

if (-not (Command-Exists php)) {
    Write-Err "PHP is not found in PATH. Install PHP (>=8.2) and re-run this script."
    exit 1
}

$phpVersion = & php -v 2>$null | Select-Object -First 1
Write-Info "PHP detected: $phpVersion"

# Composer detection: prefer global composer, fallback to local composer.phar
$composerCmd = $null
if (Command-Exists composer) {
    $composerCmd = 'composer'
    Write-Info "Composer found in PATH."
} elseif (Test-Path -Path './composer.phar') {
    $composerCmd = 'php ./composer.phar'
    Write-Info "Local composer.phar found. Will use php composer.phar."
} else {
    Write-Warn "Composer not found. Attempting to download Composer installer and install composer.phar locally."
    try {
        $installer = 'composer-setup.php'
        $installerUrl = 'https://getcomposer.org/installer'
        Write-Info "Downloading Composer installer from $installerUrl"
        Invoke-WebRequest -UseBasicParsing -Uri $installerUrl -OutFile $installer
        Write-Info "Running Composer installer..."
        & php $installer --install-dir=. --filename=composer.phar
        Remove-Item $installer -ErrorAction SilentlyContinue
        if (Test-Path -Path './composer.phar') {
            $composerCmd = 'php ./composer.phar'
            Write-Info "composer.phar installed locally."
        } else {
            Write-Err "Failed to install composer.phar automatically. Please install Composer manually: https://getcomposer.org/download/"
            exit 1
        }
    } catch {
        Write-Err "Composer download/install failed: $_"
        exit 1
    }
}

# Node/npm detection
if (Command-Exists npm) {
    Write-Info "npm detected in PATH."
    $hasNpm = $true
} else {
    Write-Warn "npm not found. Frontend assets won't be installed or built. Install Node.js (includes npm) to enable JS tooling."
    $hasNpm = $false
}

# Copy .env if needed
if (-not (Test-Path -Path './.env')) {
    if (Test-Path -Path './.env.example') {
        Copy-Item .env.example .env
        Write-Info "Created .env from .env.example"
    } else {
        Write-Warn ".env.example not found; please create a .env file before continuing."
    }
}

# Install PHP dependencies
Write-Info "Installing PHP dependencies via Composer..."
try {
    & cmd /c "$composerCmd install --no-interaction --prefer-dist"
    Write-Info "Composer install completed."
} catch {
    Write-Err "Composer install failed: $_"
    exit 1
}

# If npm is present, install JS deps
if ($hasNpm) {
    Write-Info "Installing npm dependencies..."
    try {
        & npm install
        Write-Info "npm install completed."
    } catch {
        Write-Warn "npm install failed: $_"
    }
}

# Generate application key
Write-Info "Generating application key (php artisan key:generate)..."
try {
    & php artisan key:generate
} catch {
    Write-Warn "php artisan key:generate failed: $_"
}

# Ensure sqlite file if DB_CONNECTION is sqlite
$envContent = @{}
if (Test-Path .env) {
    Get-Content .env | ForEach-Object {
        if ($_ -match '^(\w+)=(.*)$') { $envContent[$matches[1]] = $matches[2] }
    }
}

$dbConn = $envContent['DB_CONNECTION'] -or 'sqlite'
if ($dbConn -eq 'sqlite') {
    if (-not (Test-Path -Path 'database\database.sqlite')) {
        Write-Info "Creating SQLite file at database\database.sqlite"
        New-Item -ItemType File -Path database\database.sqlite | Out-Null
    }
}

# Run migrations
Write-Info "Running database migrations (php artisan migrate --force)..."
try {
    & php artisan migrate --force
    Write-Info "Migrations completed."
} catch {
    Write-Err "Migrations failed: $_"
    exit 1
}

Write-Info "Setup completed. You can start the dev server with: php artisan serve --host=127.0.0.1 --port=8000"
