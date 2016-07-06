<?php

Yii::setAlias('api', dirname(__DIR__)); // add api alias
$params = require(__DIR__ . '/params.php');
$config = [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    "controllerNamespace" => "api\controllers",
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'MwnQ1Umg1VjAZfrgF6BC6qMhZPeBL1xz',
            //"baseUrl"=>"",
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [

            'identityClass' => 'api\modules\v1\models\Clients',
            'enableSession' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            /* 'class' => 'yii\swiftmailer\Mailer',
              // send all mails to a file by default. You have to set
              // 'useFileTransport' to false and configure a transport
              // for the mailer to send real emails.
              'useFileTransport' => true, */

            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'andrey.lisnyak@gmail.com',
                'password' => 'AndreyID',
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/../../config/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site/index',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'v1/events',
                        'v1/logs',
                        'v1/auth'
                    ],
                    
                ],
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            "enableRegistration" => false,
            "enablePasswordRecovery" => false,
            "enableUnconfirmedLogin" => true,
            "enableConfirmation" => false,
            'cost' => 12,
            'admins' => ['admin']
        ],
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
