<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Task Management Project Setup
Task management with CREATE, EDIT,UPDATE,DELETE feature. 

**1. Requirements**
- PHP >= 8.0
- Composer
- MySQL


**2. Install dependencies**
- ```composer install```

**3. Configure environment variables**
 - Copy the .env.example file to .env and update the database settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=
```

**4. Generate application key**
- ```php artisan key:generate```

**5. Run migrations**
- ```php artisan migrate```

**6. Start the local server**
- ```php artisan serve```
- Now the app will be available at: http://localhost:8000

**7. Projects Seeder**
- Need some projects for create task
- ```php artisan db:seed --class=UserSeeder```