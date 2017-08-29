<?php
return [
    'bootstrap' => ['assetsAutoCompress'],
    'language' => 'en',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'assetsAutoCompress' => [
            'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true,
            'htmlCompressOptions' => ['extra' => true, 'no-comments' => true],
            'readFileTimeout' => 1,
        ] + (
            YII_ENV_PROD ?
            [
                'cssFileCompile' => false,
                'cssFileCompress' => false,
                'jsFileCompile' => false,
                'jsFileCompress' => false,
            ] :
            []
        ),
        'assetManager' => ['forceCopy' => YII_ENV_DEV],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'github' => [
                    'class' => 'Da\User\AuthClient\GitHub',
                    'clientId' => 'e103ef32566476231660',
                    'clientSecret' => '8aa035d5ff0cfb4820fd891a11660cafa42641ae',
                ],
            ],
        ],
        'assetManager' => ['forceCopy' => YII_ENV_DEV],
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
                'kvgrid' => [
                    'basePath' => '@vendor/kartik-v/yii2-grid/messages',
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'modules' => [
        'debug' => (YII_ENV_DEV ? ['allowedIPs' => ['*'], 'class' => 'yii\debug\Module'] : []),
        'gridview' => ['class' => '\kartik\grid\Module'],
    ],
];
