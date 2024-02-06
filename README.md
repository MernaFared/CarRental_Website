<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Running Project
 **1.  after colne or download source code :** <br>
<br>
       ```cd projectName``` <br>
       <br>
         ```composer install ```
        

 **2. Create Environment File:**<br>
 Copy the .env.example file to .env. This file contains configuration options for your Laravel application. <br>
 
    cp .env.example .env 


**3. Generate Application Key: Run the php artisan key:** <br>
        generate command to generate an application key. This key is used for encryption and should be kept secret.<br>
```
   php artisan key:generate
```
**4. Set Up Database:** <br>
Configure your database connection in the .env file. Set the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD variables according to your database setup.

**5. Run Database Migrations:** <br>
Run the database migrations to create the necessary tables in the database.<br>
  ```
php artisan migrate
```
Run Database Seeder (Optional):

the project has seeders, you can run them to populate the database with sample data:
bash

php artisan db:seed
**6.  Serve the Application:** <br>
You can serve the application using Laravel's built-in development server by running the php artisan serve command. This will start a development server at http://localhost:8000.<br>
```
php artisan serve
 ```
 
 
