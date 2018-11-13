<?php

namespace frontend\controllers;

use Yii;
use yii\debug\models\search\Log;
use yii\web\Controller;
use frontend\models\Wxuser;
use frontend\models\SignupForm;
use frontend\models\LoginForm;
use yii\helpers\ArrayHelper;
class OauthController extends Controller
{

    public $data = null;

    /**
     * 登录
     */
    public function actionWxlogin()
    {
        $loginUrl = $this->__CreateOauthUrlForCode();
//        echo $loginUrl;
        Header("Location: $loginUrl");
        exit;
    }

    /**
     * 微信登录回调
     */
    public function actionWxcallback()
    {
        // 获取code
        $code = Yii::$app->request->get('code');

        // 获取openId和access_token
        $data = $this->GetOpenidFromMp($code);
//        var_dump($data);die;
        if ($data) {

            $openId = $data['openid'];

            $access_token = $data['access_token'];
            $userInfo = Wxuser::findByOpenId($openId);
//            var_dump($userInfo);die;
            if(empty($userInfo)){
                $wxUserInfo = $this->_getWeixinUserInfo($access_token,$openId);
                $model = new SignupForm();
                if($model->load($wxUserInfo,'') && $model->signup()) {
                    $this->_login($wxUserInfo);
                }
            }else{
                $this->_login(ArrayHelper::toArray($userInfo));
            }
        }
    }

    private function _login($userInfo){
        $model = new LoginForm();
        if ($model->load($userInfo,'') && $model->login()) {
            $this->redirect('/index');
        }else{
            var_dump($model);
            die;
        }
    }

    /**
     * 获取微信用户信息
     * @param $access_token
     * @param $openId
     *
     * @return userinfo
     */
    private function _getWeixinUserInfo($access_token, $openId)
    {
        $url = $this->_CreateOauthUrlForUserInfo($access_token, $openId);
        $res = file_get_contents($url);
        $data = json_decode($res, true);
        return $data;
    }

    /**
     *
     * 通过code从工作平台获取openid机器access_token
     * @param string $code 微信跳转回来带上的code
     *
     * @return openid
     */
    private function GetOpenidFromMp($code)
    {
        $url = $this->__CreateOauthUrlForOpenid($code);
        $res = file_get_contents($url);
        $data = json_decode($res, true);
        return $data;
    }

    private function _CreateOauthUrlForUserInfo($access_token, $openid)
    {
        $urlObj['access_token'] = $access_token;
        $urlObj['openid'] = $openid;
        $urlObj['lang'] = Yii::$app->params['WECHAT']['lang'];
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/userinfo?" . $bizString;
    }

    /**
     *
     * 构造获取code的url连接
     * @param string $redirectUrl 微信服务器回跳的url，需要url编码
     *
     * @return 返回构造好的url
     */
    private function __CreateOauthUrlForCode()
    {
        $urlObj["appid"] = Yii::$app->params['WECHAT']['app_id'];
        $urlObj["redirect_uri"] = Yii::$app->params['WECHAT']['callback'];
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = Yii::$app->params['WECHAT']['scopes'];
        $urlObj["state"] = "STATE" . "#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?" . $bizString;
    }

    /**
     *
     * 构造获取open和access_toke的url地址
     * @param string $code，微信跳转带回的code
     *
     * @return 请求的url
     */
    private function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = Yii::$app->params['WECHAT']['app_id'];
        $urlObj["secret"] = Yii::$app->params['WECHAT']['secret'];
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?" . $bizString;
    }

    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v) {
            if ($k != "sign") {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }
}