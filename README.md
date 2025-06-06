<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<h1>
    projet par: ACHRAF BOUASRIA, ABDERRAHMANE TAHA , AYYOUB ESSAFI
</h1>


# PHP Project Setup Instructions

This guide will help you set up and run the project on your local machine.

## Prerequisites

- PHP (version 8.1 or higher)
- Required PHP Extensions:
    - zip
    - pdo_mysql
    - mysqli
    - xml
    - curl
    - mbstring
    - dom
    - session
- Composer (PHP package manager)
- MySQL
- Git

## Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Achraf10-bit/php_project.git
   cd php_project
   ```
2. **PHP Extensions Setup**
   - Open your php.ini file (usually found in your PHP installation directory)
   - Make sure the following extensions are enabled (remove semicolon ; if present):
     ```ini
     extension=zip
     extension=pdo_mysql
     extension=mysqli
     extension=xml
     extension=curl
     extension=mbstring
     ```

3. **Create Database**
   - Open MySQL/phpMyAdmin
   - Create a new database named `mydata` (or your preferred name)

4. **Environment Setup**
   - copy `.env.example` to `.env`
   - Edit `.env` file with your database settings:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mydata
   DB_USERNAME=root  # Your MySQL username
   DB_PASSWORD=      # Your MySQL password
   ```

5. **Install Dependencies and Setup**
   Run these commands in order:
   ```
   composer install
   php artisan key:generate
   php artisan session:table 
   php artisan migrate  
   php artisan db:seed  
   ```

## Troubleshooting

If you encounter any errors:

1. Make sure MySQL is running
2. Verify database name in `.env` matches the one you created
3. Check MySQL username and password in `.env` are correct
4. Ensure all prerequisites are installed correctly

## Need Help?

If you encounter any issues, please:
1. Check if all prerequisites are installed
2. Verify your database settings
3. Make sure you followed all steps in order

## Project Structure

- `app/` - Contains the core code of the application
- `database/` - Contains database migrations and seeders
- `resources/` - Contains views and assets
- `routes/` - Contains all route definitions
- `public/` - The public-facing directory

## Contributing

1. Create a new branch for your feature
2. Make your changes
3. Push to your branch
4. Create a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#   p h p _ p r o j e c t 
 
 
