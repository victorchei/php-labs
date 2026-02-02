# Налаштування середовища розробки

[← Повернутися до основної документації](../README.md)

Інструкції для встановлення необхідного програмного забезпечення на різних платформах.

---

## Необхідне ПЗ

### Базове (ЛР 1-5)

- **PHP 8.x** — інтерпретатор PHP
- **Git** — система контролю версій

### Для Laravel (ЛР 6-7)

- **Composer** — менеджер пакетів PHP
- **MySQL/MariaDB** — база даних

---

## Скрипти автоматичної установки

| Скрипт               | Платформа   | Опис                           |
| -------------------- | ----------- | ------------------------------ |
| `install-basic.sh`   | macOS/Linux | Базове: PHP, Git               |
| `install-basic.ps1`  | Windows     | Базове: PHP, Git               |
| `install-laravel.sh` | macOS/Linux | Laravel: Composer, MySQL       |
| `install-laravel.ps1`| Windows     | Laravel: Composer, MySQL       |
| `install.sh`         | macOS/Linux | Повне встановлення (все разом) |
| `install.ps1`        | Windows     | Повне встановлення (все разом) |

---

## Windows

### Базове встановлення (ЛР 1-5)

```powershell
cd setup
.\install-basic.ps1
```

### Встановлення для Laravel (ЛР 6-7)

```powershell
cd setup
.\install-laravel.ps1
```

### Повне встановлення

```powershell
cd setup
.\install.ps1
```

### Примітка про кодування

> Якщо при запуску скрипта з'являється помилка або "кракозябри", переконайтесь, що файл збережено у кодуванні **UTF-8 без BOM**.

### Альтернативні варіанти

#### WSL (рекомендовано)

```powershell
wsl --install
```

Після перезавантаження відкрийте Ubuntu (WSL) та використовуйте bash скрипти.

#### XAMPP

1. Завантажте [XAMPP](https://www.apachefriends.org/download.html)
2. Встановіть з компонентами: Apache, MySQL, PHP
3. Додайте PHP до PATH: `C:\xampp\php`

---

## macOS

### Базове встановлення (ЛР 1-5)

```bash
cd setup
chmod +x install-basic.sh
./install-basic.sh
```

### Встановлення для Laravel (ЛР 6-7)

```bash
cd setup
chmod +x install-laravel.sh
./install-laravel.sh
```

### Повне встановлення

```bash
cd setup
chmod +x install.sh
./install.sh
```

### Вручну (Homebrew)

```bash
# Базове
brew install php git

# Для Laravel
brew install composer mysql
brew services start mysql
```

---

## Linux

### Базове встановлення (ЛР 1-5)

```bash
cd setup
chmod +x install-basic.sh
./install-basic.sh
```

### Встановлення для Laravel (ЛР 6-7)

```bash
cd setup
chmod +x install-laravel.sh
./install-laravel.sh
```

### Повне встановлення

```bash
cd setup
chmod +x install.sh
./install.sh
```

### Вручну (Ubuntu/Debian)

```bash
# Базове
sudo apt update
sudo apt install -y php php-cli php-mbstring php-xml php-curl git

# Для Laravel
sudo apt install -y composer mariadb-server mariadb-client php-mysql php-zip
sudo systemctl start mariadb
sudo systemctl enable mariadb
```

---

## Перевірка встановлення

### Базове

```bash
php -v          # PHP 8.x
git --version   # git version 2.x
```

### Laravel

```bash
composer -V     # Composer version 2.x
mysql --version # mysql Ver 8.x або MariaDB
```

---

## Запуск проєкту

```bash
cd php-labs
php -S localhost:8000
```

Відкрийте в браузері: <http://localhost:8000>
