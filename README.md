<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# used versions

    Laravel Framework 12.21.0
    Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12
    MYSQL 10.4.32-MariaDB

# installed plugins

    "laravel/ui": "^4.6",
    "yajra/laravel-datatables-buttons": "^12.1",
    "yajra/laravel-datatables-oracle": "^12.4"
# admin panel url
    /admin-login
# admin panel credential
    email => admin@dynamicforms.com
    password => Password#Admin

# before starting
    - create a database and add details in .env file
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=dynamicforms
        DB_USERNAME=root
        DB_PASSWORD=
    - create a test mail environment for sending emails add details in .env
        MAIL_MAILER=smtp
        MAIL_HOST=sandbox.smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=
        MAIL_PASSWORD=
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS=mail@dynamicforms.com
        MAIL_FROM_NAME="${APP_NAME}"
    - run composer install
    - run migrate with seed
    - run server 
    - run queue work
    - for admin panel go with the url 
        /admin-login
