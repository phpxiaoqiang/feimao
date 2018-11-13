<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute'=>'index/index',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [],  // 去除 jquery.js
                    'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],  // 去除 bootstrap.css
                    'sourcePath' => null, // 防止在 frontend/web/asset 下生产文件
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [],  // 去除 bootstrap.js
                    'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'frontend\models\Wxuser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
