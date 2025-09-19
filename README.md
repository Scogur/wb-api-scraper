# Установка
```
composer install
```
```
php artisan migrate
```
```
php artisan app:fetch-api-data
```

## Добавить в .env:
```
WB_API_ADDRESS="http://109.73.206.144:6969/api/"
```
```
WB_API_KEY="E6kUTYrYwZq2tN4QEtyzsbEBk3ie"
```

# Тестовая база данных:
```
DB_CONNECTION=mysql
DB_HOST=sql.freedb.tech
DB_PORT=3306
DB_DATABASE=freedb_scogurbd
DB_USERNAME=freedb_scoguruser
DB_PASSWORD="D3@pp#MGnWJhM5P"
```
Таблицы, в которых хранятся данные: ```sales```, ```orders```, ```stocks```, ```incomes```
