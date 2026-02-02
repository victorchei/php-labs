# PHP Labs - Windows Setup Script
# Запускати в PowerShell від імені адміністратора

Write-Host "===================================" -ForegroundColor Cyan
Write-Host "  PHP Labs - Environment Setup" -ForegroundColor Cyan
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

# Check for administrator rights
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)
if (-not $isAdmin) {
    Write-Host "ERROR: Run PowerShell as administrator!" -ForegroundColor Red
    Write-Host "Right-click on PowerShell -> 'Run as Administrator'" -ForegroundColor Yellow
    exit 1
}

# Функція перевірки команди
function Test-Command {
    param($Command)
    return [bool](Get-Command -Name $Command -ErrorAction SilentlyContinue)
}

# Install Chocolatey
function Install-Chocolatey {
    Write-Host ">>> Checking Chocolatey..." -ForegroundColor Yellow

    if (Test-Command "choco") {
        Write-Host "Chocolatey already installed: $(choco --version)" -ForegroundColor Green
    }
    else {
        Write-Host "Installing Chocolatey..." -ForegroundColor Yellow
        Set-ExecutionPolicy Bypass -Scope Process -Force
        [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072
        Invoke-Expression ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))

        # Update PATH
        $env:Path = [System.Environment]::GetEnvironmentVariable("Path", "Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path", "User")

        Write-Host "Chocolatey installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install PHP
function Install-PHP {
    Write-Host ">>> Installing PHP..." -ForegroundColor Yellow

    if (Test-Command "php") {
        Write-Host "PHP already installed: $(php -v | Select-Object -First 1)" -ForegroundColor Green
    }
    else {
        choco install php -y
        refreshenv
        Write-Host "PHP installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install Composer
function Install-Composer {
    Write-Host ">>> Installing Composer..." -ForegroundColor Yellow

    if (Test-Command "composer") {
        Write-Host "Composer already installed: $(composer --version)" -ForegroundColor Green
    }
    else {
        choco install composer -y
        refreshenv
        Write-Host "Composer installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install MySQL
function Install-MySQL {
    Write-Host ">>> Installing MySQL..." -ForegroundColor Yellow

    if (Test-Command "mysql") {
        Write-Host "MySQL already installed: $(mysql --version)" -ForegroundColor Green
    }
    else {
        choco install mysql -y
        refreshenv
        Write-Host "MySQL installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Install Git (optional)
function Install-Git {
    Write-Host ">>> Checking Git..." -ForegroundColor Yellow

    if (Test-Command "git") {
        Write-Host "Git already installed: $(git --version)" -ForegroundColor Green
    }
    else {
        Write-Host "Installing Git..." -ForegroundColor Yellow
        choco install git -y
        refreshenv
        Write-Host "Git installed!" -ForegroundColor Green
    }
    Write-Host ""
}

# Main function
Write-Host "Starting installation..." -ForegroundColor Cyan
Write-Host ""

Install-Chocolatey
Install-PHP
Install-Composer
Install-MySQL
Install-Git

Write-Host "===================================" -ForegroundColor Cyan
Write-Host "  Installation completed!" -ForegroundColor Green
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "Version check:" -ForegroundColor Yellow
try { Write-Host "  PHP:      $(php -v | Select-Object -First 1)" -ForegroundColor White } catch { Write-Host "  PHP:      not installed" -ForegroundColor Red }
try { Write-Host "  Composer: $(composer --version 2>&1)" -ForegroundColor White } catch { Write-Host "  Composer: not installed" -ForegroundColor Red }
try { Write-Host "  MySQL:    $(mysql --version 2>&1)" -ForegroundColor White } catch { Write-Host "  MySQL:    not installed" -ForegroundColor Red }
try { Write-Host "  Git:      $(git --version)" -ForegroundColor White } catch { Write-Host "  Git:      not installed" -ForegroundColor Red }

Write-Host ""
Write-Host "Now you can run PHP files:" -ForegroundColor Yellow
Write-Host "  php filename.php" -ForegroundColor White
Write-Host ""
Write-Host "Or start a local server:" -ForegroundColor Yellow
Write-Host "  php -S localhost:8000" -ForegroundColor White
Write-Host ""
Write-Host "IMPORTANT: Restart the terminal to update PATH!" -ForegroundColor Magenta
Write-Host ""