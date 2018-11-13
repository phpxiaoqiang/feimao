<?php

namespace frontend\controllers;

use common\models\Notice;
use yii\web\Controller;
use common\models\Counselor;
use common\models\Orders;
use EasyWeChat\Foundation\Application;

class NoticeaController extends Controller
{
    public function actionIndex()
    {
        \Yii::info('actionIndex 发通知', 'appadmin');
        $query = Notice::find()->where(['state' => 0])->all();

        foreach ($query as $item) {
            if ($item->start_time - time() <= 600 && $item->start_time - time() > 0) {
                $id = $item['id'];
                $oid = $item['oid'];
                $userOpenId = $item['user_openId'];
                $counselorOpenId = $item['counselor_openId'];
                $startTime = $item['start_time'];

                try {
                    self::sendCounselor($id, $oid, $counselorOpenId, $startTime);
                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    \Yii::info('咨询师 ' . $id . ' 发送失败', 'appadmin');
                }

                try {
                    self::sendUser($id, $oid, $userOpenId, $startTime);
                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    \Yii::info('用户 ' . $id . ' 发送失败', 'appadmin');
                }
            }
        }
    }

    public static function sendUser($id, $oid, $userId, $startTime)
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

        if ($res->errmsg == 'ok') {
            $query = Notice::find()->where(['id' => $id])->one();
            $query->state = 1;
            if ($query->save(0)) {
                echo $id . ' 发送成功';
                \Yii::info('用户 ' . $id . ' 发送成功', 'appadmin');
            }
        }

    }

    public static function sendCounselor($id, $oid, $counselorId, $startTime)
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

        if ($res->errmsg == 'ok') {
            $query = Notice::find()->where(['id' => $id])->one();
            $query->state = 1;
            if ($query->save(0)) {
                echo $id . ' 发送成功';
                \Yii::info('咨询师 ' . $id . ' 发送成功', 'appadmin');
            }
        }
    }

    public function actionTest()
    {
        $query = Notice::find()->where(['id' => 47])->one();
        $id = $query['id'];
        $oid = $query['oid'];
        $userOpenId = $query['user_openId'];
        $counselorOpenId = $query['counselor_openId'];
        $startTime = $query['start_time'];

        try {
            self::sendCounselor($id, $oid, $counselorOpenId, $startTime);
        } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
            \Yii::info('咨询师 ' . $id . ' 发送失败', 'appadmin');
        }

        try {
            self::sendUser($id, $oid, $userOpenId, $startTime);
        } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
            \Yii::info('用户 ' . $id . ' 发送失败', 'appadmin');
        }
    }
}