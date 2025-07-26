
# PHP Login and Registration System

This project is a simple and secure login and registration system built using PHP, MySQL, and Bootstrap. It includes user registration with validation, secure login with password hashing, session management, and a protected dashboard page.

## Features

- User registration with input validation
- Secure password storage using `password_hash()`
- User login with session authentication
- Protected dashboard page
- Logout functionality
- Clean UI using Bootstrap 5
- Prepared statements to prevent SQL injection
- Error handling with feedback messages

## File Structure

```markdown

project-folder/
│
├── index.php              # User dashboard (requires login)
├── login.php              # Login form and logic
├── logout.php             # Logout script
├── registration.php       # Registration form and logic
├── database.php           # Database connection script
├── style.css              # Optional custom styles
└── README.md              # Project documentation

```

## Database Setup

1. Create a MySQL database named:

```

login-register

````

2. Create a `users` table using the following SQL:

```sql
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
````

## Configuration

Update your `database.php` file with the correct database credentials:

```php
<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "your_mysql_password";
$dbName = "login-register";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

## How to Use

1. Place the project files inside your web server directory (e.g., `htdocs` in XAMPP or `www` in WAMP).
2. Start your Apache and MySQL servers.
3. Open your browser and go to:

```
http://localhost/project-folder/registration.php
```

4. Register a new user.
5. Log in at:

```
http://localhost/project-folder/login.php
```

6. Upon successful login, you will be redirected to `index.php`.
7. Use the `logout.php` file to log out of the session.

## Code Overview

### registration.php

* Validates inputs
* Checks for duplicate email
* Hashes the password
* Stores new user using a prepared statement
* Shows success or error messages

### login.php

* Validates login inputs
* Fetches user by email
* Verifies hashed password using `password_verify()`
* Creates a session on successful login
* Redirects to the dashboard

### logout.php

* Destroys the session and redirects to the login page

### index.php

* Displays a dashboard if the user is logged in
* Redirects to login if session is not set

## Security Best Practices

* Passwords are hashed using PHP's `password_hash()`
* Login uses `password_verify()` for secure password checking
* SQL queries use prepared statements to avoid SQL injection
* Input validation and error handling are included
* Session authentication protects dashboard access

## Requirements

* PHP 7.x or higher
* MySQL or MariaDB
* Apache or any local web server
* Bootstrap 5 (included via CDN)
