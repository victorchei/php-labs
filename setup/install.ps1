# PHP Labs - Windows Setup Script
# Запускати в PowerShell від імені адміністратора

Write-Host "===================================" -ForegroundColor Cyan
Write-Host "  PHP Labs - Установка середовища" -ForegroundColor Cyan
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

# Перевірка прав адміністратора
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)
if (-not $isAdmin) {
    Write-Host "ПОМИЛКА: Запустіть PowerShell від імені адміністратора!" -ForegroundColor Red
    Write-Host "Клацніть правою кнопкою на PowerShell -> 'Run as Administrator'" -ForegroundColor Yellow
    exit 1
}

# Функція перевірки команди
function Test-Command {
    param($Command)
    return [bool](Get-Command -Name $Command -ErrorAction SilentlyContinue)
}

# Встановлення Chocolatey
function Install-Chocolatey {
    Write-Host ">>> Перевірка Chocolatey..." -ForegroundColor Yellow

    if (Test-Command "choco") {
        Write-Host "Chocolatey вже встановлено: $(choco --version)" -ForegroundColor Green
    } else {
        Write-Host "Встановлюю Chocolatey..." -ForegroundColor Yellow
        Set-ExecutionPolicy Bypass -Scope Process -Force
        [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072
        Invoke-Expression ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))

        # Оновити PATH
        $env:Path = [System.Environment]::GetEnvironmentVariable("Path", "Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path", "User")

        Write-Host "Chocolatey встановлено!" -ForegroundColor Green
    }
    Write-Host ""
}

# Встановлення PHP
function Install-PHP {
    Write-Host ">>> Встановлення PHP..." -ForegroundColor Yellow

    if (Test-Command "php") {
        Write-Host "PHP вже встановлено: $(php -v | Select-Object -First 1)" -ForegroundColor Green
    } else {
        choco install php -y
        refreshenv
        Write-Host "PHP встановлено!" -ForegroundColor Green
    }
    Write-Host ""
}

# Встановлення Composer
function Install-Composer {
    Write-Host ">>> Встановлення Composer..." -ForegroundColor Yellow

    if (Test-Command "composer") {
        Write-Host "Composer вже встановлено: $(composer --version)" -ForegroundColor Green
    } else {
        choco install composer -y
        refreshenv
        Write-Host "Composer встановлено!" -ForegroundColor Green
    }
    Write-Host ""
}

# Встановлення MySQL
function Install-MySQL {
    Write-Host ">>> Встановлення MySQL..." -ForegroundColor Yellow

    if (Test-Command "mysql") {
        Write-Host "MySQL вже встановлено: $(mysql --version)" -ForegroundColor Green
    } else {
        choco install mysql -y
        refreshenv
        Write-Host "MySQL встановлено!" -ForegroundColor Green
    }
    Write-Host ""
}

# Встановлення Git (опціонально)
function Install-Git {
    Write-Host ">>> Перевірка Git..." -ForegroundColor Yellow

    if (Test-Command "git") {
        Write-Host "Git вже встановлено: $(git --version)" -ForegroundColor Green
    } else {
        Write-Host "Встановлюю Git..." -ForegroundColor Yellow
        choco install git -y
        refreshenv
        Write-Host "Git встановлено!" -ForegroundColor Green
    }
    Write-Host ""
}

# Головна функція
Write-Host "Починаю встановлення..." -ForegroundColor Cyan
Write-Host ""

Install-Chocolatey
Install-PHP
Install-Composer
Install-MySQL
Install-Git

Write-Host "===================================" -ForegroundColor Cyan
Write-Host "  Встановлення завершено!" -ForegroundColor Green
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "Перевірка версій:" -ForegroundColor Yellow
try { Write-Host "  PHP:      $(php -v | Select-Object -First 1)" -ForegroundColor White } catch { Write-Host "  PHP:      не встановлено" -ForegroundColor Red }
try { Write-Host "  Composer: $(composer --version 2>&1)" -ForegroundColor White } catch { Write-Host "  Composer: не встановлено" -ForegroundColor Red }
try { Write-Host "  MySQL:    $(mysql --version 2>&1)" -ForegroundColor White } catch { Write-Host "  MySQL:    не встановлено" -ForegroundColor Red }
try { Write-Host "  Git:      $(git --version)" -ForegroundColor White } catch { Write-Host "  Git:      не встановлено" -ForegroundColor Red }

Write-Host ""
Write-Host "Тепер ви можете запускати PHP файли:" -ForegroundColor Yellow
Write-Host "  php filename.php" -ForegroundColor White
Write-Host ""
Write-Host "Або запустити локальний сервер:" -ForegroundColor Yellow
Write-Host "  php -S localhost:8000" -ForegroundColor White
Write-Host ""
Write-Host "ВАЖЛИВО: Перезапустіть термінал для оновлення PATH!" -ForegroundColor Magenta
Write-Host ""
