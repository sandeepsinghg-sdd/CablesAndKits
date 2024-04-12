# Laravel share an encrypted message with a colleague.

## Install and run the project

### Clone the project
`https://github.com/sandeepsinghg-sdd/CablesAndKits.git`

### Composer install

`composer install`

### Copy the .env file
`cp .env.example .env`

### Create a database and update the database credentials
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=secure_message_app
DB_USERNAME=root
DB_PASSWORD=

```

### Run the migrations
`php artisan migrate`




### Start the server

`php artisan serve`

The server is located at [http://127.0.0.1:8000](http://127.0.0.1:8000)

You can login with the credentials shown...


Use the credentials below to log in: 

Email address: user@yopmail.com.
Password: password@123.

Creates a new registered user to whom you want to send a message.

To register a user,

http://127.0.0.1:8000/register



Note:- 

-usage of yopmail is highly recommended.

- send a message from user@yopmail.com. The decryption key will be automatically sent to the user's email whome you  want to send message. 

- You can only send messages to a registered user. 
- Copy the decryption key from the email address and use it to show messages. 







