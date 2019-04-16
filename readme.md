# ATB Test

## Init and Setting

1. Prepare
- Install the package manager [composer](https://getcomposer.org/download/).
- In MySQL: create a database with name atb-test.

2. Init and setting database
- Run command lines to clone source:
```bash
git clone https://github.com/huynv1011/atb-test.git atb-test
cd atb-test
cp .env.example .env
```
- Update .env file to set security key and connect database:
```bash
APP_KEY=enter_random_string

DB_CONNECTION=mysql
DB_HOST=enter_database_host
DB_PORT=enter_database_port_number
DB_DATABASE=atb-test
DB_USERNAME=enter_database_username
DB_PASSWORD=enter_database_password
```
- Install packages and init database:
```bash
composer install
php artisan migrate
php artisan db:seed
```

## APIs
1. Get all users
- [GET] /api/users
2. Create a user
- [POST] /api/users
- Input Body form data:
```bash
fullname
phone
```
3. Get a user
- [GET] /api/users/{id}

4. Update a user
- [PUT] /api/users/{id}
- Input Body x-www-form-urlencoded:
```bash
fullname
phone
```
5. Delete a user
- [DELETE] /api/users/{id}

## Running the tests
```bash
vendor/bin/phpunit
```
