# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

PHP labs for "Server Technologies and Backend Development" course at Zhytomyr Polytechnic State University.

**Course:** [learn.ztu.edu.ua](https://learn.ztu.edu.ua/course/view.php?id=7082)

## Development Commands

```bash
# Run a PHP script
php <filename>.php

# Start local development server (serves current directory on port 8000)
php -S localhost:8000

# Check PHP syntax without executing
php -l <filename>.php

# Run PHPUnit tests (if installed via Composer)
./vendor/bin/phpunit

# Run single test file
./vendor/bin/phpunit tests/<TestFile>.php

# Install dependencies (if composer.json exists)
composer install
```
