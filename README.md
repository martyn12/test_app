##Установка##
+ Скопировать репозиторий
+ В терминале в директории
+ Установить зависимости
```
composer install
```
+ Скопировать файл env.example в .env
```
cp .env.example .env
```
```
php artisan key:generate
```
+ Установить соединение с БД в .env
+ Сгенерировать симлинк
```
php artisan storage:link
```
+ Запустить миграции
```
php artisan migrate
```
+ Запустить сидер для категорий и пользователя с ролью admin(email: admin@gmail.com password: 12345678)
```
php artisan db:seed
```
+ Запустить сервер
