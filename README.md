# Тестовое задание с яблоками.

## Установка


1. Клонируем проект с GitHub:
    ````
    git clone https://github.com/jechevit/testApple.git
    ````
2. Открываем терминал и выполняем ```` init ```` выбрав  ```` dev ```` окружение.
3. Выполнить команду  ````composer update````.
4. Создать БД. Заполнить имя БД и реквизиты доступа в ````common/config/main-local.php````
5. Выполнить команду миграций ```` php yii migrate```` и команду для создания таблиц RBAC ````php yii migrate --migrationPath=@yii/rbac/migrations````.
   > Уточнение. После выполнения миграции будет создан пользователь admin (password: 567890). Ему нужно будет дать права, для этого в консоли выполнить ````php yii role/role````, затем ````php yii role/add 1````
6. Создать виртуальный хост для frontend и backend. Зайти на backend, авторизоваться и генерировать яблоки.
