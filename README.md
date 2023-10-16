### Запуск проекта:

1. `docker compose up -d --build`
2. `docker compose exec -u laravel web sh -c "composer install"`
3. `docker compose exec -u laravel web sh -c "php artisan key:generate"`
4. `docker compose exec -u laravel web sh -c "php artisan migrate"`
5. [http://localhost:8080/](http://localhost:8080/)
