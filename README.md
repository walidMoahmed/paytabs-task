# PayTabs task

## How to run the application:

### Setting up the DB:

    Create Database

### Add database Configuration to .env file

    DB_DATABASE=Your_Database_Name
    DB_USERNAME=Your_Database_User_name
    DB_PASSWORD=Your_Database_Password

### Run Command

    composer install
    php artisan key:generate

### Run migrations & seeds

    php artisan migrate 
    php artisan db:seed

### Run project 

    php artisan serve
