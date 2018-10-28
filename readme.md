# Free for Coffee
気軽にコーヒーを飲みながらお話できる相手を探せるWebサービスです。
自分の翌日のスケジュールを登録し、話し相手を選択すると、
お互いの空いている時間を提案してくれます。


## requirements
see [Laravel Requirements](https://laravel.com/docs/5.7/installation#installation)


## installation

``` bash


# install dependencies for PHP
$ composer install

# create db file for sqlite
$ touch database/database.sqlite

# create db
$ php artisan migrate

# set up test data
$ php artisan db:seed

# install dependencies for npm
$ npm install

# build for production with minification
$ npm run dev

# run
$ php artisan serve
```
