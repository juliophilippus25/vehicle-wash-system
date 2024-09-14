# Vehicle Washing Service System

## About Application

This is a simple application for managing a vehicle washing service.

## Features

- **Dashboard**: Overview of the service metrics and statistics.
- **Vehicle Types**: Manage different types of vehicles serviced.
- **Customers**: Manage customer information and details.
- **Transactions**: Record and manage service transactions.

## How to install

- Clone the repository
- Run the command in the terminal "composer install" for install dependencies
- Run the command in the terimal "php artisan key:generate" for generate application key
- Copy .env.example to .env and update with your database configuration
- Run the command in the terminal "php artisan migrate" (Make sure you have created your own database)
- Run the command in the terminal "php artisan db:seed" 
- Run the command in the terminal "php artisan serve"
- Check database\seeders\UsersTableSeeder.php for the default admin username and password.
- Enjoy!

## Access Application
- Start your local server using XAMPP, Laragon, or another environment, and open your browser at the URL provided by "php artisan serve" output.

## Made with Laravel

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Template by Modernize

[Modernize Documentation](https://github.com/adminmart/Modernize-bootstrap-free)
