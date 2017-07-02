<?php
return [
    'bootstrap' => ['assetsAutoCompress'],
    'language' => 'en',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'assetsAutoCompress' => [
            'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true,
            'htmlCompress' => true,
            'htmlCompressOptions' => [
                'extra' => true,
                'no-comments' => true,
            ],
        ],
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
