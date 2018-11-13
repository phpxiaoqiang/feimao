<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'qiniu' => [
        'ak' => 'iv23YFozIRthmYqd2l3AYHdAhNfn5ICW1cL7v3zC',
        'sk' => 'oeCANoZe9j1FAEHuGojWuHM0EZXDagijlyk7IfdO',
        'domain' => 'http://ovv0jgblz.bkt.clouddn.com',
        'bucket' => 'images'
    ],
    'WECHAT' => [
        'app_id' => 'wx2525ccd5ac0abcbf',         // AppID
        'secret' => '289d1a2b966723e8b403cf0889c17f42',     // AppSecret
        'scopes' => 'snsapi_userinfo',
        'callback' => 'http://m.yirantianshi.com/oauth/wxcallback',
        'lang' => 'zh_CN',
        'payment' => [
            'merchant_id'        => '1488944182',
            'key'                => 'CKW5fhpckCcY8fs2xXAHK93A94FFYGsu',
            'cert_path'          => dirname(dirname(dirname(__FILE__))).'/frontend/web/cert/apiclient_cert.pem', // XXX: 绝对路径！！！！
            'key_path'           => dirname(dirname(dirname(__FILE__))).'/frontend/web/cert/apiclient_key.pem',      // XXX: 绝对路径！！！！
            'notify_url'         => 'http://m.yirantianshi.com/wxpay/notify',       // 你也可以在下单时单独设置来想覆盖它
        ],
    ],
    'IMG_PATH' => 'http://image.yirantianshi.com/'
];
