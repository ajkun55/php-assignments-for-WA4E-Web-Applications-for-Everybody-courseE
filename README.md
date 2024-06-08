This is my solution to assignments in php part of the course WA4E(https://www.wa4e.com/), thanks for the open course.

Each file folder stands for one assignment.

In this course, use XAMPP as php and mysql environment, also ngrok for deployment.

1. Getting Started with PHP, (folder: php), link: https://www.wa4e.com/assn/php/

2. A Guessing Game and HTTP GET Parameters, (folder: guess), link: https://www.wa4e.com/assn/guess/

3. Reversing an MD5 hash (password cracking), (folder: crack), link: https://www.wa4e.com/assn/crack/

4. Login and Rock Paper Scissors, (folder: rps), link: https://www.wa4e.com/assn/rps/

5. Automobiles and Databases, (folder: pdo), link: https://www.wa4e.com/assn/autosdb/

6. Automobiles, Sessions, and POST-Redirect, (folder: autosess), link: https://www.wa4e.com/assn/autosess/

7. Automobile Database CRUD, (folder: autoscrud), link: https://www.wa4e.com/assn/autoscrud/

Specification: 
Your program must be resistant to HTML Injection attempts. All data that comes from the users must be properly escaped using the htmlentities() function in PHP. You do not need to escape text that is generated by your program.

Your program must be resistant to SQL Injection attempts. This means that you should never concatenate user provided data with SQL to produce a query. You should always use a PDO prepared statement.

You must follow the POST-Redirect-GET pattern for all POST requests. This means when your program receives and processes a POST request, it must not generate any HTML as the HTTP response to that request. It must use the "header('Location: ...');" function and "return" to send the location header and redirect the browser to the same or a different page.

The database required buidling separately, use the commands e.g.

```
CREATE DATABASE misc DEFAULT CHARACTER SET utf8;

USE misc;

    CREATE TABLE autos (
        autos_id INTEGER NOT NULL KEY AUTO_INCREMENT,
        make VARCHAR(255),
        model VARCHAR(255),
        year INTEGER,
        mileage INTEGER
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

From the eighth project, the course start using javascript, I also upload them here.

8. Profile Database, (folder: res-profile), link: https://www.wa4e.com/assn/res-profile/
