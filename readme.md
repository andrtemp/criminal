<h2>Интсрукция по установке</h2>

- Скачать и установить локальные сервер Apache(для windows XAMPP) https://www.apachefriends.org/ru/index.html
- Установить Node JS https://nodejs.org/uk/
- Закинуть данный проект, а именно все содержимое папки в корень сервера (не папку, а СОДЕРЖИМОЕ)
- Создать БД в MySQL и вписать ее название и доступы к серверу БД в файл `.env` поля:
 `DB_DATABASE=`имя базы данных
 `DB_USERNAME=`имя пользователя
 `DB_PASSWORD=`пароль
- Открыть консоль и перейти в папку с проектом на сервере
- Поменять права на чтение и на запись папке `storage`
- Запустить команды `composer update` `php artisan key:generate` `php artisan migrate` и `php artisan storage:link`
- Запустить команды `npm install` и `npm run dev`
- Открыть в браузере http://localhost и радоваться

<h3>Использование</h3>
- Первый пользователь, гистрированный в системе будет админом
- Он может создавать и редактировать записи 
- Любой залогиненый пользователь может только просмотривать инфу из приложения

<h3>Полезне ссылки</h3>
- https://pureinfotech.com/install-xampp-windows-10/
- http://webupblog.ru/kak-ustanovit-node-js-na-windows/
- https://gist.github.com/hootlex/da59b91c628a6688ceb1
- https://laravel.ru/docs/v5/quickstart
- https://laravel-news.com/your-first-laravel-application
- https://www.youtube.com/watch?v=D5MZaCmpxvM