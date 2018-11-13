<?php
$config = [
    'components' => [
//        'db'=> [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=39.107.126.36;dbname=meishanzi',
//            'username' => 'root',
//            'password' => 'mszroot123',
////            'charset' => 'utf8'
//            'charset' => 'utf8mb4'
//        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tep639z2GPKD4qzl8drYgP1hlb5YQ4bf',
        ],
    ],
];

if (!YII_ENV_TEST) {
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
