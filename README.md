
### Install
+ symfony composer install
+ php bin/console assets:install
+ php bin/console doctrine:migration:migrate

**Example request:**
Body, raw, json. Method POST
```
{
"product": 1,
"productUuid" : "123e4567-e89b-12d3-a456-426655440000"
"taxNumber": "DE123456789",
"couponCode": "D15",
"paymentProcessor": "paypal"
}
```

**DataBase:**

docker-compose build
docker-compose up -d 


_PS_

_Затрачено времени - 4 часа.
Надо доделать упаковку php контейнера + nginx.
Токен должен быть выключен, но это не точно...
Необходимо базу наполнить тестовыми данными..._