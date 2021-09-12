# Kids Protection Api

### Чтобы запустить сайт на локальном сервере, выполните эту команду в папке проекта

docker-compose build app && docker-compose up -d && docker-compose exec app composer install && touch database/database.sqlite && cp .env.example .env && docker-compose exec app php artisan migrate --seed && docker-compose exec app php artisan passport:install --force

Документация к api - https://childs.aumagency.ru/docs
Админ панель - https://childs.aumagency.ru/admin
