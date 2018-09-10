# Laravel AdBoard TestCase

This is a simple AdBoard app with multiple user support.

## Installation

Clone the repository
```
git clone https://github.com/sayber/adboard.git
```

Then cd into the folder with this command
```
cd adboard
```

Then do a composer install
```
composer install
```

Then create a environment file using this command
```
rename .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_USERNAME`, `DB_PASSWORD`).

Then create a database named `board` and then do a database migration using this command-
```
php artisan migrate
```

At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```

```
php artisan storage:link
php artisan db:seed
````

## Run server

Run server using this command
```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.

