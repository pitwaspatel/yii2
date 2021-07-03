Yii2 Swagger Module
============

This module integrate [swagger-php](https://github.com/zircote/swagger-php) and [swagger-ui v3](https://github.com/swagger-api/swagger-ui).



[![Latest Stable Version](https://poser.pugx.org/ignatenkovnikita/yii2-swagger/v/stable)](https://packagist.org/packages/ignatenkovnikita/yii2-swagger) 
[![Total Downloads](https://poser.pugx.org/ignatenkovnikita/yii2-swagger/downloads)](https://packagist.org/packages/ignatenkovnikita/yii2-swagger) 
[![Latest Unstable Version](https://poser.pugx.org/ignatenkovnikita/yii2-swagger/v/unstable)](https://packagist.org/packages/ignatenkovnikita/yii2-swagger) 
[![License](https://poser.pugx.org/ignatenkovnikita/yii2-sendpulse/license)](https://packagist.org/packages/ignatenkovnikita/yii2-swagger)




Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require ignatenkovnikita/yii2-swagger:dev-master
```

or add

```
"ignatenkovnikita/yii2-swagger": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

You set url, where locate json file OR set path for scan

```php
'modules' => [
      ...
      'swagger' => [
            'class' => \ignatenkovnikita\swagger\Module::class,
        //  'url' => 'http://petstore.swagger.io/v2/swagger.json',
            'path' => '@frontend/modules/api',
            // disable page with your logic
            'isDisable' => function () {
                return false;
            },
            // replace placeholders in swagger content
            'afterRender' => function ($content) {
                $content = str_replace('{{host}}', 'http://example.com', $content);
                $content = str_replace('{{basePath}}', '/api/v1', $content);
                return $content;
            }
       ]
        ...
    ],
```


Now you open yourdomain.com/swagger and see API documentation


### TODO
- add cache
- add customization


## Donate

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](http://paypal.me/ignatenkovnikita)
