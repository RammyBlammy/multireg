# Проект на Laravel

## Требования

- PHP >= 8.0
- Composer
- Laravel >= 10
- MySQL или другой поддерживаемый СУБД

## Установка

1. **Клонируйте репозиторий**

   ```bash
   git clone https://github.com/RammyBlammy/multireg.git
2. **Перейдите в папку проекта**
    ```bash
   cd multireg
   composer install
3. **Настройте файл .env**

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=имя_вашей_базы
    DB_USERNAME=ваш_пользователь
    DB_PASSWORD=ваш_пароль
4. **Создайте базу данных и выполните миграции**
    ```bash
   php artisan migrate
5. **Запустите команду для парсинга городов**
    
   ```bash
   php artisan parse:cities
6. **Создайте базу данных и выполните миграции**
    ```bash
   php artisan migrate
7. **Запустите сервер**
    
   ```bash
   php artisan serve

   Приложение доступно по адресу http://127.0.0.1:8000

8. **API для управления городами**

   
    ```bash
    Добавление города
    Метод: POST
    URL: http://127.0.0.1:8000/cities/
    Тело запроса (JSON):
    {
        "id":"99999",
        "name": "Привет",
        "slug": "privet"
    }
   
   Удаление города
    ```bash
    Метод: DELETE
    URL: http://127.0.0.1:8000/cities/{id}
