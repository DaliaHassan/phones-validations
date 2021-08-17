Phone Validation Application
========================

The application is used to list and categorize country phone numbers.

Requirements
------------
* Docker

Installation
-----
After downloading the project

```bash
$ cd phones-validations/
$ docker-compose up
```

Then access the application in your browser at the given URL (<http://localhost:8880/>).

Tests
-----

Execute this command to run tests:

```bash
$ cd phones-validations/
$ ./vendor/bin/simple-phpunit tests/PhoneValidation.php
```


