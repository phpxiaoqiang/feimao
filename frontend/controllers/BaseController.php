<?php
/**
 * Created by PhpStorm.
 * Wxuser: gengshaojing
 * Date: 2018/10/26
 * Time: 下午4:01
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{

    const SUCCESS_CODE = 200;

    /**
     * 返回格式
     * @var string
     */
    public $respose_format = 'Json';

    /**
     * 接口返回值
     * @var array
     */
    private $responseBody = ['status' => 200, 'data' => '', 'msg' => ''];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }


    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
//            return $this->redirect('/oauth/wxlogin')->send();
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }


    public function output($data, $status = self::SUCCESS_CODE, $msg = '')
    {
        $this->responseBody['data'] = $data;
        $this->responseBody['status'] = $status;
        $this->responseBody['msg'] = $msg;

        if (strtolower($this->respose_format) == 'json') {
            return $this->asJson($this->responseBody);
        }
        return $this->responseBody;
    }
}
