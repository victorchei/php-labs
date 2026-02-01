#!/bin/bash

# PHP Labs - Setup Script
# Автоматична установка необхідного програмного забезпечення

set -e

echo "==================================="
echo "  PHP Labs - Установка середовища"
echo "==================================="
echo ""

# Detect OS
OS="unknown"
if [[ "$OSTYPE" == "darwin"* ]]; then
    OS="macos"
elif [[ "$OSTYPE" == "linux-gnu"* ]]; then
    if [ -f /etc/debian_version ]; then
        OS="debian"
    elif [ -f /etc/redhat-release ]; then
        OS="redhat"
    fi
fi

echo "Виявлена ОС: $OS"
echo ""

# Function to check if command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Install PHP
install_php() {
    echo ">>> Встановлення PHP..."

    if command_exists php; then
        echo "PHP вже встановлено: $(php -v | head -n 1)"
    else
        case $OS in
            macos)
                if command_exists brew; then
                    brew install php
                else
                    echo "Homebrew не знайдено. Встановлюю Homebrew..."
                    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
                    brew install php
                fi
                ;;
            debian)
                sudo apt update
                sudo apt install -y php php-cli php-mbstring php-xml php-curl php-mysql php-zip
                ;;
            redhat)
                sudo dnf install -y php php-cli php-mbstring php-xml php-curl php-mysql php-zip
                ;;
            *)
                echo "Невідома ОС. Встановіть PHP вручну."
                exit 1
                ;;
        esac
        echo "PHP встановлено: $(php -v | head -n 1)"
    fi
    echo ""
}

# Install Composer
install_composer() {
    echo ">>> Встановлення Composer..."

    if command_exists composer; then
        echo "Composer вже встановлено: $(composer --version)"
    else
        case $OS in
            macos)
                brew install composer
                ;;
            debian|redhat)
                php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                php composer-setup.php
                php -r "unlink('composer-setup.php');"
                sudo mv composer.phar /usr/local/bin/composer
                ;;
            *)
                echo "Невідома ОС. Встановіть Composer вручну."
                exit 1
                ;;
        esac
        echo "Composer встановлено: $(composer --version)"
    fi
    echo ""
}

# Install MySQL/MariaDB
install_mysql() {
    echo ">>> Встановлення MySQL/MariaDB..."

    if command_exists mysql; then
        echo "MySQL вже встановлено: $(mysql --version)"
    else
        case $OS in
            macos)
                brew install mysql
                brew services start mysql
                ;;
            debian)
                sudo apt install -y mariadb-server mariadb-client
                sudo systemctl start mariadb
                sudo systemctl enable mariadb
                ;;
            redhat)
                sudo dnf install -y mariadb-server mariadb
                sudo systemctl start mariadb
                sudo systemctl enable mariadb
                ;;
            *)
                echo "Невідома ОС. Встановіть MySQL вручну."
                exit 1
                ;;
        esac
        echo "MySQL/MariaDB встановлено"
    fi
    echo ""
}

# Main installation
echo "Починаю встановлення..."
echo ""

install_php
install_composer
install_mysql

echo "==================================="
echo "  Встановлення завершено!"
echo "==================================="
echo ""
echo "Перевірка версій:"
echo "  PHP:      $(php -v | head -n 1)"
echo "  Composer: $(composer --version 2>/dev/null || echo 'не встановлено')"
echo "  MySQL:    $(mysql --version 2>/dev/null || echo 'не встановлено')"
echo ""
echo "Тепер ви можете запускати PHP файли:"
echo "  php filename.php"
echo ""
echo "Або запустити локальний сервер:"
echo "  php -S localhost:8000"
echo ""
