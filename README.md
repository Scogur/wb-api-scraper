# Установка

## Выполнить команды:
```
composer install
```
```
php artisan migrate
```

## Изменить в .env данные о бд и добавить следующие строки:
```
WB_API_ADDRESS="http://109.73.206.144:6969/api/"
```
```
WB_API_KEY="E6kUTYrYwZq2tN4QEtyzsbEBk3ie"
```

# Добавление новой компании
```
php artisan app:app:add-new-company --name=company_name
```
Вместо company_name вписать название компании.

# Добавление нового аккаунта
```
php artisan app:app:add-new-account --company-id=id --name=account_name
```
Вместо company_name вписать название компании, вместо id вписать id существующей компании.

# Добавление нового API сервиса
```
php artisan app:app:add-new-api-service --name=service_name
```
Вместо service_name вписать название сервиса.

# Добавление нового типа токена
```
php artisan app:app:add-new-token-type --name=type_name
```
Вместо type_name вписать название типа токена.

# Добавление нового токена
```
php artisan app:app:add-new-api-token --account-id=acc_id --api-service-id=serv_id --token-type-id=type_id --value=token_value
```
Вместо acc_id вписать id аккаунта, вместо serv_id вписать id сервиса, вместо type_id вписать id типа токена, вместо token_value вписать значение токена.

# Запуск сохранения данных из api
```
php artisan app:fetch-api-data --account=account_id
```
Вместо account_id вписать действительный id аккаунта.
<p> Для загрузки новых данных использовать опцию --fresh </p>


# Запуск в docker compose:
Добавить изменения в .env.
```
docker compose up
```
```
docker compose exec app bash
```
Выполнить необходимые команды из установки.

# Автоматическая загрузка данных
Загрузка происходит 2 раза в день в 8 и 20 часов.
Для добавления аккаунта в список для автоматической загрузки необходимо добавить id аккаунта в ```config/api.php```