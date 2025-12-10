<#
Enable PHP extensions for the CLI on Windows: openssl, fileinfo, pdo_sqlite, zip.

What it does:
- Finds the `php.exe` used by your shell
- Locates or creates `php.ini` from `php.ini-production` or `php.ini-development`
- Backs up existing `php.ini` to `php.ini.bak.TIMESTAMP`
- Uncomments extension lines for openssl, fileinfo, pdo_sqlite, zip
- Sets `extension_dir` to the PHP `ext` folder
- Shows `php -m` output so you can confirm extensions are loaded

Usage (run as Administrator):
  Set-Location 'C:\path\to\project'
  powershell -NoProfile -ExecutionPolicy Bypass -File .\scripts\enable-php-extensions.ps1

Note: Modifies system PHP ini used by the CLI. Inspect the script before running.
#>

$ErrorActionPreference = 'Stop'

function Info($m) { Write-Host "[INFO]  $m" -ForegroundColor Cyan }
function Warn($m) { Write-Host "[WARN]  $m" -ForegroundColor Yellow }
function Err($m) { Write-Host "[ERROR] $m" -ForegroundColor Red }

Info 'Locating php.exe used by current shell...'
try {
    $phpCmd = Get-Command php -ErrorAction Stop
}
catch {
    Err 'php executable not found in PATH. Install PHP or add it to PATH and re-run.'
    exit 1
}

$phpExe = $phpCmd.Source
$phpDir = Split-Path $phpExe -Parent
Info "php.exe found: $phpExe"
Info "PHP directory: $phpDir"

$iniPath = Join-Path $phpDir 'php.ini'
if (Test-Path $iniPath) {
    Info "Found existing php.ini at: $iniPath"
    $backup = $iniPath + '.bak.' + (Get-Date).ToString('yyyyMMddHHmmss')
    Copy-Item $iniPath $backup -Force
    Info "Backed up existing php.ini to $backup"
}
else {
    # Try to create php.ini from common templates
    $prod = Join-Path $phpDir 'php.ini-production'
    $dev = Join-Path $phpDir 'php.ini-development'
    if (Test-Path $prod) {
        Copy-Item $prod $iniPath -Force
        Info 'Copied php.ini-production to php.ini'
    }
    elseif (Test-Path $dev) {
        Copy-Item $dev $iniPath -Force
        Info 'Copied php.ini-development to php.ini'
    }
    else {
        Warn "No php.ini template found in $phpDir. Creating minimal php.ini"
        '; Minimal php.ini created by script' | Out-File -FilePath $iniPath -Encoding ASCII
    }
}

# Read and modify php.ini content
$content = Get-Content $iniPath -Raw

# Ensure extension_dir points to the ext folder inside the PHP directory if it exists
$extDir = Join-Path $phpDir 'ext'
if (Test-Path $extDir) {
    $escapedExt = $extDir -replace '\\', '\\'
    if ($content -match '^[;\s]*extension_dir\s*=') {
        $content = $content -replace '^[;\s]*extension_dir\s*=.*', ('extension_dir = "' + $escapedExt + '"')
        Info "Set extension_dir to $extDir"
    }
    else {
        $newLine = 'extension_dir = "' + $escapedExt + '"'
        $content = $newLine + "`n" + $content
        Info "Added extension_dir = $extDir to php.ini"
    }
}
else {
    Warn "No ext directory found at $extDir — ensure PHP extensions directory exists."
}

# Uncomment extensions: openssl, fileinfo, pdo_sqlite, zip
$patterns = @(
    '^\s*;\s*extension\s*=\s*php_openssl\.dll',
    '^\s*;\s*extension\s*=\s*openssl',
    '^\s*;\s*extension\s*=\s*openssl\.dll',
    '^\s*;\s*extension\s*=\s*php_fileinfo\.dll',
    '^\s*;\s*extension\s*=\s*fileinfo',
    '^\s*;\s*extension\s*=\s*fileinfo\.dll',
    '^\s*;\s*extension\s*=\s*php_pdo_sqlite\.dll',
    '^\s*;\s*extension\s*=\s*pdo_sqlite',
    '^\s*;\s*extension\s*=\s*pdo_sqlite\.dll',
    '^\s*;\s*extension\s*=\s*php_zip\.dll',
    '^\s*;\s*extension\s*=\s*zip',
    '^\s*;\s*extension\s*=\s*zip\.dll'
)

foreach ($p in $patterns) {
    $content = ($content -split "`n") | ForEach-Object {
        if ($_ -match $p) { $_ -replace '^\s*;\s*', '' } else { $_ }
    } -join "`n"
}

# Also uncomment any other lines that reference these extensions (without php_ prefix)
$content = ($content -split "`n") | ForEach-Object {
    if ($_ -match '^\s*;\s*extension\s*=.*(openssl|fileinfo|pdo_sqlite|zip)') { $_ -replace '^\s*;\s*', '' } else { $_ }
} -join "`n"

# Write changes
Set-Content -Path $iniPath -Value $content -Encoding ASCII
Info "Updated php.ini at $iniPath"

Info 'Verifying extensions are now available in PHP modules...'
try {
    $modules = php -m 2>&1
    Write-Host $modules
    if ($modules -match 'openssl') {
        Info 'openssl appears enabled.'
    }
    else {
        Warn 'openssl not present in php -m output.'
    }
    if ($modules -match 'fileinfo') {
        Info 'fileinfo appears enabled.'
    }
    else {
        Warn 'fileinfo not present in php -m output.'
    }
    if ($modules -match 'pdo_sqlite') {
        Info 'pdo_sqlite appears enabled.'
    }
    else {
        Warn 'pdo_sqlite not present in php -m output.'
    }
    if ($modules -match 'zip') {
        Info 'zip appears enabled.'
    }
    else {
        Warn 'zip not present in php -m output.'
    }
}
catch {
    Err ('Failed to run php -m to verify modules: ' + $_)
}

Info 'Done. Extensions should now be available.'
