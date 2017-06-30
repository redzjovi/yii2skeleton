<?php
return [
    'language' => 'en',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => ['class' => 'yii\rbac\DbManager'],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'basePath' => '@common/messages',
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => ['app' => 'app.php'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
