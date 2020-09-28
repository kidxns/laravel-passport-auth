# LARAVEL PASSPORT AUTH
Laravel Passport is an OAuth2 server and API authentication package.

## Installation prerequisites
- PHP 7+, MySQL, and Apache (all three at once can use XAMPP.)
- Composer
- Laravel 7,8
- Laravel Passport
- Postman, cURL, API Testing

## How to settup the project you clone
* `cd laravel-passport-auth`
* `composer install`
* `coppy (window) cp (macos) .env.example .env`
* `php artisan key:generate`

## How to run
- Create new a database on localhost
- Open .env file on the project to settup environment configuration 
    DB_DATABASE= [database name]
    DB_USERNAME= [database user name]
    DB_PASSWORD= [database password]

- Migrate the database
    `php artisan migrate`


## Documentation
[Documentation for Laravel Passport can be found on the Laravel website.]
(http://https://laravel.com/docs/master/passport)


## License
Laravel Passport is open-sourced software licensed under the MIT license.
