# Nature SaaS Platform

Professional educational SaaS platform built with PHP 8.3.

---

# Requirements

- PHP 8.3+
- Composer
- MySQL 8+
- Laragon/XAMPP/Linux stack

---

# Installation

## Clone repository

git clone https://github.com/jamartinezv2023/nature.git

---

## Install dependencies

composer install

---

## Configure environment

cp .env.example .env

---

## Import database

Import:

database/migrations/001_full_saas_schema.sql

---

## Run server

php -S localhost:8000 -t public

---

# Architecture

- PSR-4
- Dependency Injection
- Repository Pattern
- Service Layer
- Bootstrap Application
- Clean Architecture inspired

---

# Testing

php vendor/bin/phpunit

