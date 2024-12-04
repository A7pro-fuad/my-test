

 


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Blog Management System

A Blog Management System built with Laravel that allows admin to create, edit, manage, and publish blog posts efficiently. The system includes role-based access control, and a user-friendly interface for administrators.

## Features

- Role-based access control (Admin, User) to manage user permissions.
- Post Management.

- Media Support
Upload and manage images.

- Search and Filters
Search functionality for finding posts quickly.


# Installation
- PHP >= 8.1
- Composer
- Node.js >= 16.x
- MySQL


# Steps
- Clone the repository:

git clone https://github.com/A7pro-fuad/my-test.git
- cd blog-management
# Install dependencies:
- composer install
- npm install && npm run dev
- Set up environment variables:
- Rename .env.example to .env and update database credentials.

# Run migrations and seed the database:


- php artisan migrate --seed
- Generate the application key
php artisan key:generate
- Start the local development server:
- php artisan serve

# Usage
- Admin Dashboard: /
- Access the admin panel to manage posts.
- email : "admin@admin.com"
- password : password

- Users List: /
- Access the users to like posts.
- email : "user@user.com"
- password : password

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
