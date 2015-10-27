<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language' => 'zh-CN',	
    'timeZone' => 'Asia/Shanghai',	
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123456',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        /*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@app/mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        */

         'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',            
                //'viewPath' => '@common/mail',
                /*            
                            // send all mails to a file by default. You have to set
                            // 'useFileTransport' to false and configure a transport
                            // for the mailer to send real emails.
                            'useFileTransport' => true,
                */            

                /*
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.163.com',
                    'username' => 'kzeng_pub@163.com',
                    'password' => 'kzeng123',
                    'port' => '25',
                    //'port' => '587',
                    //'encryption' => 'tls',
                ],
                */

                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.qq.com',
                    'username' => 'zengkai001@qq.com',
                    'password' => 'zk19810825',
                    'port' => '465',
                    'encryption' => 'ssl',
                ],

                'messageConfig' => [
                     'charset' => 'UTF-8',
                     'from' => ['zengkai001@qq.com'=>'admin'],
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
    ],
    'params' => $params,
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
