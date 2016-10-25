Self-destructing messages
===============================

Small application for creating and viewing self-destructing messages

Based on [Yii 2 Basic](https://github.com/yiisoft/yii2-app-basic).

Libraries used:
 - [npm-asset/aes-js](https://www.npmjs.com/package/aes-js)
 - [npm-asset/js-md5](https://www.npmjs.com/package/js-md5)

Getting Started
---------------
* If you do not have [Composer](https://getcomposer.org/doc/00-intro.md), install it.
* Clone repo from [https://github.com/steel-archer/sdm](https://github.com/steel-archer/sdm)
```
git clone https://github.com/steel-archer/sdm sdm
```
* Go to your project directory.
```
cd sdm
```
* Initialize composer:
```
composer install
```
* Create (or use the existing MySQL db) and create file config/db.php with db credentials (##DB_NAME##, ##DB_USER##, ##DB_PASSWORD##) from template file config/db.php.template to provide project access to this db.
* Run migrations (enter y):
```
php yii migrate
```

Use it!
---------------
- [Create message](http://localhost/sdm/web/index.php/message/create)
- [View message](http://localhost/sdm/web/index.php/message/view)
