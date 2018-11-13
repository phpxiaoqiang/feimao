<?php

namespace frontend\controllers;

use common\models\Counselor;
use common\models\Notice;
use common\models\Orders;
use EasyWeChat\Foundation\Application;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\HttpException;

class NoticeController extends Controller
{
    public function actionIndex()
    {
        \Yii::info("发通知了", 'appadmin');
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $result = Notice::find()->where(['between', 'start_time', $beginToday, $endToday])->all();
        foreach ($result as $value) {
            if ($value->start_time - time() <= 600 && $value->start_time - time() > 0) {
                $oid = $value['oid'];
                $userOpenId = $value['user_openId'];
                $counselorOpenId = $value['counselor_openId'];
                $startTime = $value['start_time'];

                try {
                    self::sendUser($oid, $userOpenId, $startTime);
//                    $this->sendUser($oid, $userOpenId, $startTime);
                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    \Yii::info($e->getMessage(), 'error');
                }
                try {
                    self::sendCounselor($oid, $counselorOpenId, $startTime);
//                    $this->sendCounselor($oid, $counselorOpenId, $startTime);
                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    \Yii::info($e->getMessage(), 'error');
                }
            }
        }
    }

    public static function sendUser($oid, $userId, $startTime)
    {
        $config = \Yii::$app->params['WECHAT'];
        $wxApp = new Application($config);
        $notice = $wxApp->notice;
        $templateId = 'fqeGVtyMordnfThyxGm3-8DfviqLMjMTsXZWDDCrd4U';
        $order = Orders::find()->where(['oid' => $oid])->asArray()->one();
        $result = Counselor::find()->where(['id' => $order['cid']])->asArray()->one();
        $data = array(
            "first" => "有新预约，请及时确认！",
            "keyword1" => "您预约的" . $result['name'] . "老师，咨询即将开始。",
            "keyword2" => date("Y-m-d H:i:s", $startTime),
            "keyword3" => "请您在" . date("Y-m-d H:i:s", $startTime) . '准时进入',
            "remark" => "戳这里可以进入聊天页面哦:-D",
        );
        $res = $notice->uses($templateId)->withUrl('http://chicyuanzui.com/chat/index?oid=' . $oid)->andData($data)->andReceiver($userId)->send();
    }

    public static function sendCounselor($oid, $counselorId, $startTime)
    {
        $config = \Yii::$app->params['WECHAT'];
        $wxApp = new Application($config);
        $notice = $wxApp->notice;
        $templateId = 'fqeGVtyMordnfThyxGm3-8DfviqLMjMTsXZWDDCrd4U';
        $order = Orders::find()->where(['oid' => $oid])->one();
        $data = array(
            "first" => "有新预约，请及时确认！",
            "keyword1" => $order['username'] . "," . $order['sex'] . "岁，有预约需求，等待您的咨询",
            "keyword2" => date("Y-m-d H:i:s", $startTime),
            "keyword3" => "请您在" . date("Y-m-d H:i:s", $startTime) . '准时进入',
            "remark" => $order['describe'],
        );
        $res = $notice->uses($templateId)->withUrl('http://chicyuanzui.com/chat/index?oid=' . $oid)->andData($data)->andReceiver($counselorId)->send();
    }
}

