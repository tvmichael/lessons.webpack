<?php

$params = require __DIR__ . '/params.php';

if($_SERVER['HTTP_HOST'] == 'localhost')
{
    $db = require __DIR__ . '/db_loc.php';
}
else
{
    $db = require __DIR__ . '/db.php';
}

$url = require __DIR__ . '/url.php';

$config = [
    'id' => 'basic',
    'name'=>'MiniSite',

    // set target language to be Ukraine
    'language' => 'uk',
    // set source language to be English
    'sourceLanguage' => 'en-US',

    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'defaultRoute'=> 'main/index',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            // 'enableCookieValidation' => false, // відключити 'cookie'
            'cookieValidationKey' => 'u_5m7I2sQRN2ZAPmZsrIZ_e78iEkzIvoVYC8d4Yr',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\advanced\AdvancedUser',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'maxSourceLines' => 50,
            'errorAction' => 'main/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $url,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app/main' => 'main.php',
                        'app/user' => 'user.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'converter' => [ // https://www.yiiframework.com/doc/guide/2.0/en/structure-assets
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'less' => ['css', 'lessc {from} {to} --no-color'],
                    'ts' => ['js', 'tsc --out {to} {from}'],
                ],
            ],
        ],
    ],
    'params' => $params,

    'controllerMap' => [
        // оголошує контролер "account", використовуючи назву класу
        // 'account' => 'app\controllers\UserController',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['188.163.120.*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
