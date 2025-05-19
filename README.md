# Стек

- php8.2 (laravel 11)
- nodejs
- mariadb
- nginx


## Сборка

```bash

docker compose --env-file .docker.env up -d
```

### В Mariadb контейнере

```bash

docker exec -i mdb mariadb -uroot -ppassword -e "CREATE DATABASE IF NOT EXISTS app;" 


```

### В PHP контейнере

```bash

docker exec -it php bash
cp .env.example .env
```

### Изменить в `.env` раздел DB на

```dotenv
DB_CONNECTION=mariadb
DB_HOST=mdb
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=password
```

```bash

composer install
php artisan key:generate
php artisan migrate:fresh --seed
```

<http://localhost:81>