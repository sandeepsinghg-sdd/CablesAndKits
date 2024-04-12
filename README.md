# Laravel share an encrypted message with a colleague.


## Install and run the project

### Clone the project
`git clone https://github.com/ktechhub/laravel-todo-app.git`

### Composer install

`composer install`

### Copy the .env file
`cp .env.example .env`

### Create a database and update the database credentials
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo
DB_USERNAME=root
DB_PASSWORD=
```

### Run the migrations
`php artisan migrate`

### Run the seeder for the default user and todo items
`php artisan db:seed`

This creates a new user with the credentials below:

```
Email: kalkulus@ktechhub.com
Password: ktechhub
```

### Start the server

`php artisan serve`

The server is located at [http://127.0.0.1:8000](http://127.0.0.1:8000)

You can login with the credentials shown... 
