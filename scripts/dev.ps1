$ErrorActionPreference = "Stop"

$root = Resolve-Path (Join-Path $PSScriptRoot "..")
$port = if ($env:APP_DEV_PORT) { $env:APP_DEV_PORT } else { "8000" }

Write-Host "Development server: http://127.0.0.1:$port"
Write-Host "Starting Vite..."

$vite = Start-Process `
    -FilePath "npm.cmd" `
    -ArgumentList @("run", "dev", "--", "--host", "127.0.0.1") `
    -WorkingDirectory $root `
    -NoNewWindow `
    -PassThru

try {
    Write-Host "Starting Laravel..."
    php artisan serve --host=127.0.0.1 --port=$port
}
finally {
    if ($vite -and -not $vite.HasExited) {
        Stop-Process -Id $vite.Id -Force
        Write-Host "Stopped Vite."
    }
}
