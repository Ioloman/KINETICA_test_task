Комментарии по установке:

1. Если Вы ранее использовали Laravel Sail и у Вас в Docker есть том sailmysql, то это название необходимо поменять. Объявляется он в файле docker-compose.yml на строке 84 и используется на строке 36.
2. Далее нужно установить зависимости. Самый удобный, на мой взгляд, способ - запустить контейнеры `docker-compose up -d` и скачать зависимости композером контейнера `docker exec -it <app_container> composer update`. Скорее всего названием контейнера с приложением будет "KINETICA_test_task_laravel.test_1".
3. Далее можно использовать Sail. Нужно перезагрузить контейнеры: `docker-compose down` и `./vendor/bin/sail up -d`. Последний шаг - миграция `./vendor/bin/sail artisan migrate`. Сайт должен быть доступен на localhost.
4. Если Sail не работает. Перезагрузка контейнеров - `docker-compose restart` и миграция - `docker exec -it <app_container> php artisan migrate`

В проекте использовались Laravel 8.40, Bootstrap 5, jQuery, tinyMCE как редактор текста, сборка - laravel-mix (API для webpack). Для разработки применялись Docker Desktop + WSL 2 + Visual Code. По времени потрачено примерно 4 вечера.
