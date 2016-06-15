<?php


$db     = require(__DIR__ . '/../../config/db.php');
$params = require(__DIR__ . '/params.php');

return [
    'id' => 'app-api',
    'name'=>"app-api",
    'basePath' => dirname(__DIR__)."/..",    
    'bootstrap' => ['log'],
    'defaultRoute' => 'site',
    'components' => [        
        'request' => [
           //'cookieValidationKey' => 'MwnQ1Umg1VjAZfrgF6BC6qMhZPeBL1xz',
           //"baseUrl"=>"/web",
           'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/api.log',
                ],
            ],
        ],
        'user' => [
            
            //'identityClass' => 'app\models\User',
            
            'enableAutoLogin' => true,
            //'class' => 'app\components\User',
            'identityClass' => 'dektrium\user\models\User',

        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [

                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/events',
                ]
            ],        
        ],
        'db' => $db,
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\api\modules\v1\Module',
        ],
    ],
    'params' => $params,
];



