<?php

namespace frontend\controllers;

use common\libraries\sms\api_demo\SmsDemo;
use common\models\ActivityCoupons;
use common\models\Counselor;
use common\models\Notice;
use common\models\Orders;
use common\models\Subscribe;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use frontend\models\Wxuser;
use Yii;
use yii\web\Controller;
use frontend\controllers\NoticeController;

class WxpayController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $queryParams = Yii::$app->request->queryParams;
        // 1.获取 时间段预约 状态
        $sid = $queryParams['sid'];
        $sidResult = Subscribe::find()->where(['id' => $sid])->asArray()->one();
        $sidState = $sidResult['state'];
        if ($sidState == '1') {

            $type = $queryParams['order-type'];
            $sidCounselorId = $sidResult['counselor_id'];
            $counselor = Counselor::find()->where(['id' => $sidCounselorId])->asArray()->one();

            // 获取价钱
            $price = '';
            if ($type == '1') {
                $price = $counselor['subscribe_price'];
            } else if ($type == '2') {
                $price = $counselor['subscribe_voice_price'];
            }
            $oid = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            // 下订单（订单入库）
            $model = new Orders();
            $data['title'] = '咨询师订单' . $oid;
            $data['oid'] = $oid;
            $data['uid'] = Yii::$app->user->id;
            $data['username'] = $queryParams['username'];
            $data['age'] = $queryParams['age'];
            $data['sex'] = (int)$queryParams['sex'];
            $data['cid'] = (int)$queryParams['cid'];
            $data['price'] = $price;
            $data['sid'] = $queryParams['sid'];
            $data['type'] = $queryParams['order-type'];
            $data['describe'] = $queryParams['describe'];
            $data['phone'] = $queryParams['phone'];
            if ($queryParams['coupon']) {
                $data['coupon'] = $queryParams['coupon'];
                if ($model->load($data, '') && $model->save()) {
                    $order = Orders::find()->where(['oid' => $oid])->one();
                    $order->status = '1';
                    if ($order->save(0)) {
                        $result = Subscribe::find()->where(['id' => $order->sid])->one();
                        $result->is_buy = '0';
                        $result->save(0);

                        $coupon = ActivityCoupons::find()->where(['p_id' => Yii::$app->user->id, 'state' => 0])->one();
                        $coupon->state = 1;
                        $coupon->o_id = $order->oid;
                        $coupon->save(0);

                        $this->createNotice($order);
                        $this->sendSuccessSms($order);
                        try {
                            $this->sendBuySuccessNotice($order);
                        } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                            \Yii::info($e->getMessage(), 'error');
                        }
                        //                发送给老师通知
                        try {
                            $oid = $order->oid;
                            $counselorId = Counselor::find()->where(['id' => $order->cid])->one()->uid;
                            $start_time = strtotime(Subscribe::find()->where(['id' => $order->sid])->one()->subscribe_startTime);
                            NoticeController::sendCounselor($oid,$counselorId,$start_time);
                        } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                            \Yii::info($e->getMessage(), 'error');
                        }

                        $this->redirect('/wxpay/success')->send();
                    } else {
                        $this->redirect('/wxpay/fail')->send();
                    }
                } else {
                    $this->redirect('/wxpay/fail')->send();
                }
                return true;
            }

            if ($model->load($data, '') && $model->save()) {
                $jsApiParameters = $this->send($model['title'], $model['oid'], $model['price']);

                return $this->renderPartial('index', [
                    'jsApiParameters' => $jsApiParameters
                ]);
            } else {
                var_dump($model->errors);
            }

        } else {
            return $this->output(true, 200, '该时间已被预约');
        }
    }

    public function actionOrderpay()
    {
        $oid = Yii::$app->request->get('oid');
        $order = Orders::find()->where(['oid' => $oid])->asArray()->one();
        if ($order) {
            $sid = $order['sid'];
            $sidResult = Subscribe::find()->where(['id' => $sid])->asArray()->one();
            $sidState = $sidResult['is_buy'];
            if ($sidState == '1') {
                $jsApiParameters = $this->send($order['title'], $order['oid'], $order['price']);

                return $this->renderPartial('index', [
                    'jsApiParameters' => $jsApiParameters
                ]);
            } else {
                return $this->output(true, 200, '该时间已被预约');
            }
        } else {
            return $this->output(true, 200, '没有该订单');
        }
    }

    public function send($title, $oid, $price)
    {
        $config = \Yii::$app->params['WECHAT'];
        $wxApp = new Application($config);
        $payment = $wxApp->payment;
        $attributes = [
            'trade_type' => Order::JSAPI,
            'body' => $title,
            'detail' => $title,
            'out_trade_no' => $oid,
            'total_fee' => $price,
            'openid' => Yii::$app->user->identity->openid,
            'is_subscribe' => 'Y'
        ];
        $order = new Order($attributes);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            $json = $payment->configForPayment($prepayId);
            return $json;
        } else {
            return $result;
        }
    }

    public function actionNotify()
    {
        \Yii::info('微信notify', 'notify');
        $config = \Yii::$app->params['WECHAT'];
        $wxApp = new Application($config);
        $payment = $wxApp->payment;
        $response = $payment->handleNotify(function ($notify, $successful) {
            \Yii::info('微信支付完成通知', 'appadmin');
            if ($successful) {
                $order_arr = json_decode($notify, true);
                $outTradeNo = $order_arr['out_trade_no'];
                // $order_arr就是微信异步通知给服务器的信息
                $order = Orders::find()->where(['oid' => $outTradeNo])->one();

                if (!$order) { // 如果订单不存在
                    return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
                }

                if ($order->status == '1') { // 假设订单字段“支付时间”不为空代表已经支付
                    return true; // 已经支付成功了就不再更新了
                }

                $sid = $order->sid;
                $cid = $order->cid;
                $order->status = '1';
                if ($order->save(0)) {
                    \Yii::info("修改成功", 'appadmin');
                    $result = Subscribe::find()->where(['id' => $sid])->one();
                    $result->is_buy = '0';
                    $result->save(0);
                    $this->createNotice($order);
                    $counselor = Counselor::find()->where(['id' => $cid])->one();
                    $counselor->subscribe_num += 1;
                    $counselor->save(0);
                } else {
                    \Yii::info("修改失败", 'appadmin');
                }
                $this->sendSuccessSms($order);

//                发送给用户通知
                try {
                    $this->sendBuySuccessNotice($order);
                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    \Yii::info($e->getMessage(), 'error');
                }

//                发送给老师通知
                try {
                    $oid = $order->oid;
                    $counselorId = Counselor::find()->where(['id' => $order->cid])->one()->uid;
                    $start_time = strtotime(Subscribe::find()->where(['id' => $order->sid])->one()->subscribe_startTime);
                    NoticeController::sendCounselor($oid,$counselorId,$start_time);
//                    $this->sendBuySuccessNotice($order);
                } catch (\EasyWeChat\Core\Exceptions\HttpException $e) {
                    \Yii::info($e->getMessage(), 'error');
                }

                return true;
            }
        });
        $response->send();
    }

    public function sendSuccessSms($order)
    {
        $phone = $order->phone;
        $counselorName = Counselor::find()->where(['id' => $order->cid])->one()->name;
        $subscribeTime = Subscribe::find()->where(['id' => $order->sid])->one()->subscribe_startTime;
        $data = array(  // 短信模板中字段的值
            "time" => date('Y-m-d H:i:s', time()),
            "teacher" => $counselorName,
            "start" => $subscribeTime
        );
        $response = SmsDemo::sendSms($phone, $data);
        if ($response->Message !== 'OK') {
            SmsDemo::sendSms($phone, $data);
        }
    }

    /**
     * 发送购买成功通知
     */
    public function sendBuySuccessNotice($order)
    {
        $uid = $order->uid;
        $userOpenId = Wxuser::find()->where(['id' => $uid])->one()->openid;

        $cid = $order->cid;
        $counselorName = Counselor::find()->where(['id' => $cid])->one()->name;

        $config = \Yii::$app->params['WECHAT'];
        $wxApp = new Application($config);
        $notice = $wxApp->notice;
        $templateId = 'BPQiD0PrW8902yf2o4tEYbW6CcMrIIVP8ZJGs91pRK4';
        $data = array(
            "first" => "您已预约成功！",
            "keyword1" => $order->oid,
            "keyword2" => 'Chic原醉-' . $counselorName . '咨询师',
            "keyword3" => $order->price / 100 . '元',
            "remark" => $order['describe'],
        );
        $res = $notice->uses($templateId)->withUrl('http://chicyuanzui.com/order/index')->andData($data)->andReceiver($userOpenId)->send();
    }

    public function createNotice($order)
    {
        $data['oid'] = $order->oid;
        $data['user_openId'] = Wxuser::find()->where(['id' => $order->uid])->one()->openid;
        $data['counselor_openId'] = Counselor::find()->where(['id' => $order->cid])->one()->uid;
        $data['start_time'] = strtotime(Subscribe::find()->where(['id' => $order->sid])->one()->subscribe_startTime);

        $model = new Notice();
        if ($model->load($data, '') && $model->validate()) {
            $model->save();
        } else {
            var_dump($model->getErrors());
        }
    }

    // 成功
    public function actionSuccess()
    {
        return $this->render('success');
    }

    // 失败
    public function actionFail()
    {
        return $this->render('fail');
    }

//    public function actionRefund()
//    {
//        $oid = Yii::$app->request->post('oid', '');
//        $oid = '2017111297830';
//        $result = Orders::find()->where(['oid' => $oid])->one();
//        if ($result) {
//            $config = \Yii::$app->params['WECHAT'];
//            $wxApp = new Application($config);
//            $payment = $wxApp->payment;
//            $refund = $payment->refund($oid, 'refund_' . $oid, $result['price']);
//            /*
//             * 退款成功
//             * 1. 修改订单状态 status 改为3
//             * 2. sid 改为可以购买
//             */
//            $result->status = 3;
//            $result->save(0);
//            $subscribe = Subscribe::find()->where(['id' => $result['sid']])->one();
//            $subscribe->is_buy = 1;
//            $subscribe->save(0);
//            $notice = Notice::find()->where(['oid' => $result['oid']])->one();
//            $notice->delete();
//            if ($refund['result_code'] === 'SUCCESS') {
//                return $this->output('退款成功');
//            } else if ($refund['result_code'] === 'FAIL') {
//                return $this->output($refund['err_code_des']);
//            }
//        } else {
//            return $this->output('没有该订单');
//        }
//    }
}