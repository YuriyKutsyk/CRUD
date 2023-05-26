## Requirements:
* PHP 8.1+
* Laravel 8+
* Composer
* MySQL 8.0+

## 1. Install PHP-8.1+

## 2. Install MySQL 8.0+

## 3. Install all the composer dependencies:

Install the composer (if it is not exists on the server):

[Composer installation manual](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

## 4. Clone the git repository:
https://github.com/YuriyKutsyk/Form-sending-email.git

Switch to the project directory:
```
cd [project directory]
```

## 5.Install composer dependencies:

cd folder

Execute:

```
composer install
```

## 6. Create the .env file to set the project configuration

Example:

```
# App
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:E7iWgdYlXko8hf6HeoHb/0+sT7EOubbLFudawxm+x28=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud
DB_USERNAME=root
DB_PASSWORD=

# Other
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

# Redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=

# AWS Configuration
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

## 7. Define database, APP_KEY in .env

## 8. php artisan migrate --seed

## 9. php artisan serve
