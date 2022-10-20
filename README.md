# Restful Api task

## Run with Docker

### `git clone https://github.com/emomovg/restful-api-task.git`
### `cd restful-api-task`
### `docker-compose up -d --build`

## Run Migrations and Seeders

### `docker exec -it restful-api-task_php_1 bash`
### `php -f App/Database/Migrations/run_migration.php`
### `php -f App/Database/Seeders/run_seeder.php`

## User's Data for testing

* Login: user_login
* Password: user_password
