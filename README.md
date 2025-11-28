# PlusFlix

PlusFlix is a movie catalog and streaming availability tracker designed to help users quickly find where films can be watched online.  
The system allows browsing movies, checking their detailed information, and displaying platforms where they are available.  
It also provides an admin panel for managing data and supports user ratings.

---

## Tech Stack
- **PHP 8.1+**
- **Symfony Framework**
- **SQLite**
- **Composer**
- **Twig**
- **CSS / Bootstrap**
- **Symfony CLI**

---

# Getting Started  
Follow these steps to run PlusFlix from scratch.

---

## Install PHP (required version: 8.2.29)

Check if PHP is installed:
php -v

If not installed download PHP from: https://windows.php.net/download

## Install Composer

Check if Composer is installed:
composer -v

If not installed download PHP from: https://getcomposer.org/download

## Install Symfony CLI

Run in PowerShell (non admin):
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression

Restart machine, then in PowerShell:
scoop install symfony-cli

## Run project

Go to project directory

Run in PowerShell/Windows Terminal:
symfony serve

The Web server is listening on: http://127.0.0.1:8000

## Run fixtures

php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

## Debug mode

Open .env file and comment line 20: APP_DEBUG=0
