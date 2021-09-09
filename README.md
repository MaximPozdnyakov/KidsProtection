# Kids Protection Api

### Чтобы запустить сайт на локальном сервере, выполните эту команду в папке проекта

docker-compose build app && docker-compose up -d && docker-compose exec app composer install && touch database/database.sqlite && cp .env.example .env && docker-compose exec app php artisan migrate && docker-compose exec app php artisan passport:install --force && docker-compose exec app php artisan db:seed && docker-compose exec app php artisan voyager:admin admin@gmail.com

Документация к api - http://localhost:3000
Админ панель - http://localhost:3000/admin , email: admin@gmail.com, password: SDGsdfn735F . Их можно поменять в .env файле.
