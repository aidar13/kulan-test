# Kulan-test-project

1. clone project
   ```git clone https://github.com/aidar13/kulan-test.git```
2. open project ```cd kulan-test```
3. up docker ```docker-compose up -d```
4. add ```127.0.0.1  kulan-oil.loc``` to /etc/hosts file
5. enter to db container: ```docker exec -it my-db /bin/bash```
   enter to mysql: ```mysql -uroot -p``` password is: **docker**
   create database: ```create database kulan;``` and exit from container
6. enter to app container ```docker-compose exec app bash```
7. run migration  ```php artisan migrate --seed```
8. generate key ```php artisan key:generate```
9. Go to link: http://kulan-oil.loc:81/
10. Generate OAuth Password Client ```php artisan passport:client --password``` and copy **Client secret**,
    run: ```php artisan passport:keys```


# Next testing RESTAPI with Postman

1. Чтобы регистрироваться: Auth/register
2. Скопированный **Client secret** вставить в variables->client_secret 
3. Дальше нужно получить торен: Auth/get-token, скопировать access_token и вставить в variables->token
4. Получение городов: Application->cities 
5. Чтобы создать заявку: Application->create
6. Отклонить заявку: Application->reject
7. Объединять несколько заявок: Application->merge applications
8. Назначение администраторов: User->attachRole


