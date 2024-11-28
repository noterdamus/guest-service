Установка и запуск(первый запуск)
1. Клонировать репозиторий
2. Перейти в директорию docker
3. Запустить Docker-контейнеры (docker-compose up --build -d)
4. Установить зависимости
   4.1 docker exec -it guest-service-app bash
   4.2 composer install
   4.3 php artisan migrate

Последующие запуски (выполняются из директории docker)
-запустить контейнеры (docker-compose up -d)
-остановить контейнеры (docker-compose down)

API
Все маршруты API доступны по адресу: http://localhost:8080/api
1. Получение всех гостей
   GET /guests
   пример ответа:
   [
   {
   "id": 1,
   "first_name": "Иван",
   "last_name": "Иванов",
   "email": "test@test.ru",
   "phone": "+71234567890",
   "country": "Россия",
   "created_at": "2024-11-28T12:00:00.000000Z",
   "updated_at": "2024-11-28T12:00:00.000000Z"
   }
   ]
2. Получить данные гостя
   GET /guests/{id}
   пример ответа:
   {
   "id": 1,
   "first_name": "Иван",
   "last_name": "Иванов",
   "email": "test@test.ru",
   "phone": "+71234567890",
   "country": "Россия",
   "created_at": "2024-11-28T12:00:00.000000Z",
   "updated_at": "2024-11-28T12:00:00.000000Z"
   }
3. Создать гостя
   POST /guests
   пример тела запроса:
   {
   "first_name": "Иван",
   "last_name": "Иванов",
   "email": "test@test.ru",
   "phone": "+71234567890"
   "country": "Россия",
   }

   пример ответа:
   {
   "id": 1,
   "first_name": "Иван",
   "last_name": "Иванов",
   "email": "test@test.ru",
   "phone": "+71234567890",
   "country": "Россия",
   "created_at": "2024-11-28T12:00:00.000000Z",
   "updated_at": "2024-11-28T12:00:00.000000Z"
   }
4. Обновить данные гостя
   PUT /guests/{id}
   пример тела запроса:
   {
   "first_name": "Петя",
   "last_name": "Иванов",
   "email": "test@test.ru",
   "phone": "+71234567890"
   "country": "Россия",
   }

        ответ:
            []
5. Удалить гостя
   DELETE /guests/{id}
   ответ:
   []

Каждый ответ API содержит два отладочных заголовка:
X-Debug-Time: Время выполнения запроса в миллисекундах.
X-Debug-Memory: Использованная память в КБ.