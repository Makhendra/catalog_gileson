# catalog_gileson
Запуск:
 - npm install
 - заполнить .env
 - php artisan key:generate
 - php artisan migrate
 - php artisan db:seed
 - php artisan serve

 для крона:
 crontab -e
 * * * * * php /path_to_project/artisan schedule:run >>/dev/null 2>&1

Ответ на первое задание в корне, файл select.txt

Задание №1
В базе данных есть следующие таблицы:

CREATE TABLE orders(
	id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	order_number VARCHAR(100) NOT NULL
);

CREATE TABLE products(
	id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	title VARCHAR(100) NOT NULL
);

CREATE TABLE orders_products (
	order_id INT(10) NOT NULL, 
	product_id INT(10) NOT NULL
);


Напишите следующие SQL-запросы:
вывести список заказов вместе с количеством товаров в данных заказах
вывести все заказы, в которых больше 10 товаров
вывести два любых заказа, у которых максимальное количество общих товаров


Задание №2

Написать каталог товаров на Laravel.  
Базу данных необходимо регулярно пополнять с адреса https://markethot.ru/export/bestsp  


На главной странице можно увидеть 20 самых популярных товаров, а также перейти в одну из категорий. 
На странице категории будут отображаться товары данной категории.  
На главной странице есть поле для поиска по товарам. Товары можно искать по названию и описанию.  

Написать каталог товаров на Laravel.

Базу данных необходимо регулярно пополнять с адреса https://markethot.ru/export/bestsp

На главной странице можно увидеть 20 самых популярных товаров, а также перейти в одну из категорий. На странице категории будут отображаться товары данной категории.

На главной странице есть поле для поиска по товарам. Товары можно искать по названию и описанию.

Дизайн в данной задаче совершенно не важен!

Документация по полям JSON:
id - айди товара
title - название товара
image -  ссылка на изображение
description - описание товара
first_invoice - дата первой продажи товара
url - ссылка на товар на markethot.ru
price - минимальная цена товара
amount - количество всех вариаций

offers - вариации товарам (например iphone 6 64gb черный - вариация товара iphone 6)
offers.id - айди вариации
offers.price - цена вариации
offers.amount - количество вариации товара на складе
offers.sales  - единиц продано
offers.article - артикул вариации

categories - категории товара
categories.id - айди категории
categories.title - название категории
categories.alias -  slug категории, можно использовать в качестве пути для ссылки на категорию
categories.parent - родительская категория (у категорий есть иерархия)
