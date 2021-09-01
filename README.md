docker-compose build app <br/>
docker-compose up -d <br/>
docker-compose exec app composer install <br/>
docker-compose exec app php artisan key:generate <br/>
docker-compose exec app php artisan migrate
