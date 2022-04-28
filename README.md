

## About Employee

This project is built using laravel framework. Its a simple CRUD operation for creating employeed

## How to configure and run project

This project is requires PHP 8.02 and above. you can check your PHP version by running this command on terminal / cmd

```
    php -v
```
if the version of PHP is lower than 8.02, you will need to upgrade the php. if the above command returns error, it shows that PHP is not installed. you can visit PHP site to get on how to install PHP on your server.
Also ensure that composer is installed and it is global.

- Download or clone this repository
- Navigate to the repository directory
- Run the following command to download the dependencies
    ```
        composer install
    ```
  
- Create a .env file and copy the content from .env.example to the .env file
- Set up your database and add the database credentials to your .env file
- Run your migration and seeder by running the following commands
```
php artisan migrate:fresh --seed  
```
- Generate the your application key by running
```
php artisan key:generate
```
- Give permission to user to write to storage folder. Don't use 777 for the permission because of security reason, rather give 755 permission to the storage
```angular2html
chmod -R 775 storage
```
- Run your web server by
    1.   Run through docker by setting up laravel sail ( Check Laravel documentation on how to set up sail).
    2. set up a virtual server and let it point to laravel public folder.
    3.  Run the laravel serve which create the port to navigate by typing the following command.
        ```
        php artisan serve
        ```
- open your web browser and point to the url. 

