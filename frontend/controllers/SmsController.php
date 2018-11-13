<?php
/**
 * Created by PhpStorm.
 * User: gengshaojing
 * Date: 2018/1/16
 * Time: 上午11:27
 */

namespace frontend\controllers;

use common\libraries\sms\api_demo\SmsDemo;

class SmsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        header('Content-Type: text/plain; charset=utf-8');
        $phone = '13717963020';
        $data = array(  // 短信模板中字段的值
            "time" => date('Y-m-d H:i:s', time()),
            "teacher" => '耿少京',
            "start" => '过几年再开始'
        );
        $response = SmsDemo::sendSms($phone, $data);
        echo "发送短信(sendSms)接口返回的结果:\n";
        var_dump($response);
        if ($response->Message === 'OK') {
            echo '我发送成功了';
        }
    }
}