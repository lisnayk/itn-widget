<?php

$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'components' => [
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'MwnQ1Umg1VjAZfrgF6BC6qMhZPeBL1xz',
			"baseUrl"=>"",
	        'parsers' => [
        		'application/json' => 'yii\web\JsonParser',
    			]
    
		],
		'view' => [
			 'theme' => [
				 'pathMap' => [
					'@app/views' => '@app/views/adminlte',
					'@dektrium/user/views' => '@app/views/user',
				 ],
			 ],
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		
		'user' => [
			
			//'identityClass' => 'app\models\User',
			
			'enableAutoLogin' => true,
			//'class' => 'app\components\User',
    		'identityClass' => 'dektrium\user\models\User',

		],

		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			/*'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,*/

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
		'db' => require(__DIR__ . '/db.php'),
		
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing'=>false,
			'rules' => [
       			'' => 'site/index',
        		'<action>'=>'site/<action>',
        		['class' => 'yii\rest\UrlRule', 'controller' =>'rest\Events', 'pluralize'=>false ],
    		],
		],
		
	],
	'params' => $params,
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			"enableRegistration"=>false,
			"enablePasswordRecovery"=>false,
			"enableUnconfirmedLogin"=>true,
			"enableConfirmation"=>false,
			'cost' => 12,
        	'admins' => ['admin']
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
