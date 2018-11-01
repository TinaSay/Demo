Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist contrib/yii2-news "*"
```

or add

```
"contrib/yii2-news": "*"
```

to the require section of your `composer.json` file.

Configure
---------

backend:

```
    'modules' => [
        'news' => [
            'class' => \tina\news\Module::class,
            'viewPath' => '@tina/news/views/backend',
            'controllerNamespace' => 'tina\news\controllers\backend',
        ],
    ],
```

frontend:

```
    'modules' => [
        'news' => [
            'class' => \tina\news\Module::class,
            'viewPath' => '@tina/news/views/frontend',
            'controllerNamespace' => 'tina\news\controllers\frontend',
        ],
    ],

```

params:

```
    'menu' => [
        [
            'label' => 'News',
            'items' => [
                [
                    'label' => 'News',
                    'url' => ['/news/default'],
                ],
                [
                    'label' => 'News Group',
                    'url' => ['/news/group'],
                ],
            ],
        ],
    ],
```

console:

```
    'migrate' => [
        'class' => \yii\console\controllers\MigrateController::class,
        'migrationTable' => '{{%migration}}',
        'interactive' => false,
        'migrationPath' => [
                '@tina/news/migrations',
        ],
    ],
    'access' => [
        'class' => \krok\access\AccessController::class,
        'config' => [
            [
                'name' => 'news',
                'controllers' => [
                    'default' => [],
                    'group' => [],
                ],
            ],
        ],
    ],
```
