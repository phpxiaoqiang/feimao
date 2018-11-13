<?php

/**
 * 微信分享
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class WxshareController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionJssdk()
    {
        $ticket = $this->_getTicket();
        $noncestr = $this->_getRandChar(16);
        $timestamp = time();
        $url = $_REQUEST['url'];
        if (empty($url)) {
            echo $this->_echoJson(array('code' => 201, 'msg' => 'param error', 'data' => ''));
            return;
        }
        $signature = $this->_getSignature($noncestr, $ticket, $timestamp, $url);
        $data = array(
            'appId' => Yii::$app->params['WECHAT']['app_id'],
            'nonceStr' => $noncestr,
            'timestamp' => $timestamp,
            'url' => $url,
            'signature' => $signature,
            'rawString' => "jsapi_ticket=" . $ticket . "&noncestr=" . $noncestr . "&timestamp=" . $timestamp . "&url=" . $url
        );
        echo $this->_echoJson(array('code' => 200, 'msg' => 'OK', 'data' => $data));
        return;
    }

    /*
     * 获取随机字符串
     */

    private function _getRandChar($length)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];
        }
        return $str;
    }

    /*
     * 获取微信jsapiticket
     */

    private function _getTicket()
    {
        $token_access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . Yii::$app->params['WECHAT']['app_id'] . "&secret=" . Yii::$app->params['WECHAT']['secret'];
        $tokenres = file_get_contents($token_access_url);
        $tokenresult = json_decode($tokenres, true);
        $access_token = $tokenresult['access_token'];
        $jsapi_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $access_token . "&type=jsapi";
        $jsapires = file_get_contents($jsapi_url);
        $jsapiresult = json_decode($jsapires, true);
        $ticket = $jsapiresult['ticket'];
        return $ticket;
    }

    /*
     * 获取signature
     */

    private function _getSignature($noncestr, $ticket, $timestamp, $url)
    {
        $parameters = array("noncestr" => $noncestr,
            "jsapi_ticket" => $ticket,
            "timestamp" => $timestamp,
            "url" => $url);
        ksort($parameters);

        $string1 = "";
        foreach ($parameters as $key => $val) {
            $string1 .= $key . "=" . $val . "&";
        }
        $string1 = substr($string1, 0, -1);
        $signature = sha1($string1);
        return $signature;
    }

    /*
     * 转换为json数据
     * @param array $data
     * @return json
     */

    private function _echoJson($data)
    {
        header('Content-type: application/json;charset=utf-8');
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With,Accept");
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}
