#Laravel Echo example

Repo for nativescript app built with Vue [Example App Repo](https://github.com/happones/nativescript-laravel-echo)

**Prerequisites**

- php7.1
- mysql
- nodejs
- laravel-echo-server
- redis-server

Install dependencies

`$ composer install`

Configure you `.env` file and then

`$ php artisan migrate --seed`

`$ php artisan passport:install`

Create a tunnel for you api and socket service

`$ valet share // or ngrok` 

Share **laravel-echo-server** once run

`$ ngrok http 6001`