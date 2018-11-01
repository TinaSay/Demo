<?php

$config = [
    'id' => 'console',
    'bootstrap' => [
        'queue',
    ],
    'controllerMap' => [
        // Migrations for the specific project's module
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationTable' => '{{%migration}}',
            'useTablePrefix' => true,
            'interactive' => false,
            'migrationPath' => [
                '@app/migrations',
                '@yii/rbac/migrations',
                '@app/modules/auth/migrations',
                '@vendor/yii2-developer/yii2-storage/migrations',
                '@vendor/yii2-developer/yii2-content/migrations',
                '@vendor/yii2-developer/yii2-configure/migrations',
                '@vendor/yii2-developer/yii2-menu/src/migrations',
                '@app/modules/directory/migrations',
                '@tina/news/migrations',
                '@vendor/contrib/yii2-subscriber/migrations',
            ],
        ],
        'access' => [
            'class' => \krok\access\AccessController::class,
            'userIds' => [
                1,
            ],
            'rules' => [
                \app\modules\auth\rbac\AuthorRule::class,
            ],
            'config' => [
                [
                    'name' => 'system',
                    'controllers' => [
                        'default' => [
                            'index',
                            'flush-cache',
                        ],
                    ],
                ],
                [
                    'name' => 'tinymce/uploader',
                    'controllers' => [
                        'default' => [
                            'image',
                            'file',
                        ],
                    ],
                ],
                [
                    'name' => 'auth',
                    'controllers' => [
                        'auth' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                            'view',
                            'refresh-token',
                        ],
                        'log' => ['index'],
                        'social' => ['index'],
                        'profile' => ['index'],
                    ],
                ],
                [
                    'name' => 'content',
                    'controllers' => [
                        'default' => [],
                    ],
                ],
                [
                    'name' => 'backup',
                    'controllers' => [
                        'default' => [
                            'index',
                        ],
                        'make' => [
                            'filesystem',
                            'database',
                        ],
                        'download' => [
                            'filesystem',
                            'database',
                        ],
                    ],
                ],
                [
                    'name' => 'configure',
                    'controllers' => [
                        'default' => [
                            'list',
                            'save',
                        ],
                    ],
                ],
                [
                    'name' => 'search',
                    'controllers' => [
                        'sphinx' => ['index'],
                        'lucene' => ['index'],
                    ],
                ],
                [
                    'name' => 'menu',
                    'controllers' => [
                        'default' => [
                            'index',
                            'view',
                            'create',
                            'update',
                            'delete',
                            'update-all',
                            'module-menu-items',
                            'delete-image',
                        ],
                    ],
                ],
                [
                    'name' => 'directory',
                    'controllers' => [
                        'default' => [],
                    ],
                ],
                [
                    'name' => 'news',
                    'controllers' => [
                        'default' => [],
                        'group' => [],
                    ],
                ],
                [
                    'name' => 'subscriber',
                    'controllers' => [
                        'subscriber' => [
                            'index',
                            'create',
                            'update',
                            'view',
                            'delete',
                        ],
                        'subscription-group' => [
                            'index',
                            'create',
                            'update',
                            'view',
                            'delete',
                        ],
                    ],
                ],
                [
                    'name' => 'postManager',
                    'controllers' => [
                        'default' => [
                            'index',
                            'list',
                            'send',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'search' => [
            'class' => \krok\search\Module::class,
            'controllerNamespace' => 'krok\search\controllers\console',
        ],
    ],
    'components' => [
        'urlManager' => [
            'class' => \yii\di\ServiceLocator::class,
            'components' => [
                'frontend' => require(__DIR__ . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'urlManager.php'),
                'backend' => require(__DIR__ . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'urlManager.php'),
            ],
        ],
        'errorHandler' => [
            'class' => \krok\sentry\console\SentryErrorHandler::class,
            'sentry' => \krok\sentry\Sentry::class,
        ],
    ],
];

return \yii\helpers\ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . 'common.php'), $config);
