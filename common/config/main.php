<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' =>[
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'flushInterval' => 1,
            'targets' => [
                'db' =>[
                    'categories' => ['appadmin'],
                    'class' => 'yii\log\DbTarget',
                    'exportInterval' => 1,
                    'logTable' => '{{%system_log}}',
                    'logVars' => [],
                ],
            ],
        ],
        "urlManager" => [
            "enablePrettyUrl" => true,
            "enableStrictParsing" => false,
            "showScriptName" => false,
            "suffix" => "",
            "rules" => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"
            ],
        ],
    ],
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@backend/web/uploads/yirantianshiimg/',
            'uploadUrl' => 'http://image.yirantianshi.com/',
            'imageAllowExtensions'=>['jpg','jpeg','png','gif']
        ],
    ],
];
