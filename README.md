Запуск контейнеров Docker с приложением и БД:

`docker-compose up -d`

Далее необходимо выполнить миграции:

`docker exec -it <container> php artisan migrate` 
Скорее всего названием контейнера будет "KINETICA_test_task_laravel.test_1".

