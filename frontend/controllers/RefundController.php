<?php

namespace frontend\controllers;

use common\models\Counselor;
use common\models\Notice;
use common\models\Orders;
use common\models\Subscribe;
use EasyWeChat\Foundation\Application;
use Yii;
use yii\web\Controller;

class RefundController extends BaseController
{
    public function actionIndex()
    {
        $oid = Yii::$app->request->post('oid', '');
        $result = Orders::find()->where(['oid' => $oid])->one();
        if ($result) {
            $config = \Yii::$app->params['WECHAT'];
            $wxApp = new Application($config);
            $payment = $wxApp->payment;
            $refund = $payment->refund($oid, 'refund_' . $oid, $result['price']);
            /*
             * 退款成功
             * 1. 修改订单状态 status 改为3
             * 2. sid 改为可以购买
             */
            $result->status = 3;
            $result->save(0);
            $subscribe = Subscribe::find()->where(['id' => $result['sid']])->one();
            $subscribe->is_buy = 1;
            $subscribe->save(0);
            $notice = Notice::find()->where(['oid' => $result['oid']])->one();
            $notice->delete();
            if ($refund['result_code'] === 'SUCCESS') {

                try {
                    $this->cancelNotice($result);
                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    \Yii::info($e->getMessage(), 'error');
                }

                return $this->output('退款成功');
            } else if ($refund['result_code'] === 'FAIL') {
                return $this->output($refund['err_code_des']);
            }
        } else {
            return $this->output('没有该订单');
        }
    }

    public function cancelNotice($order)
    {
        $userName = $order->username;
        $price = $order->price;
        $counselorId = Counselor::find()->where(['id' => $order->cid])->one()->uid;
        $start_time = strtotime(Subscribe::find()->where(['id' => $order->sid])->one()->subscribe_startTime);
        $config = \Yii::$app->params['WECHAT'];
        $wxApp = new Application($config);
        $notice = $wxApp->notice;
        $templateId = 'BC7F-HbSnNSnjte7wQMePjBusn0GbmpIqF5gjb7aeWI';
        $data = array(
            "first" => "用户" . $userName . "的订单已取消",
            "keyword1" => "¥" . $price / 100 . "元",
            "keyword2" => "用户" . $userName . "于" . $order->updated_at . "时间购买的订单已取消",
            "remark" => date("Y-m-d H:i:s", $start_time) . "的预约已取消",
        );
        $notice->uses($templateId)->withUrl('http://chicyuanzui.com')
            ->andData($data)
            ->andReceiver($counselorId)
            ->send();

    }

//    public function actionCancel()
//    {
//        $order = Orders::findOne(174);
//        $userName = $order->username;
//        $price = $order->price;
//        $counselorId = Counselor::find()->where(['id' => $order->cid])->one()->uid;
//        $start_time = strtotime(Subscribe::find()->where(['id' => $order->sid])->one()->subscribe_startTime);
//        $config = \Yii::$app->params['WECHAT'];
//        $wxApp = new Application($config);
//        $notice = $wxApp->notice;
//        $templateId = 'BC7F-HbSnNSnjte7wQMePjBusn0GbmpIqF5gjb7aeWI';
//        $data = array(
//            "first" => "用户" . $userName . "的订单已取消",
//            "keyword1" => "¥" . $price / 100 . "元",
//            "keyword2" => "用户" . $userName . "于" . $order->updated_at . "时间购买的订单已取消",
//            "remark" => date("Y-m-d H:i:s", $start_time) . "的预约已取消",
//        );
//        $notice->uses($templateId)->withUrl('http://chicyuanzui.com/order/index')
//            ->andData($data)
//            ->andReceiver($counselorId)
//            ->send();
//
//    }
}