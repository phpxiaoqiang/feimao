<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller{

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

        // 判断是否登录
        if (Yii::$app->user->isGuest) {
            // 没有登录,登录,登录后,返回
            Yii::$app->user->setReturnUrl(Yii::$app->request->getUrl());  // 设置返回的url,登录后原路返回
            Yii::$app->user->loginRequired();
            Yii::$app->end();
        }
    }

    public function beforeAction($action){
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $permission = $controller.'/'.$action;
        if(\Yii::$app->user->can($permission))
            return true;
        else
            throw new \yii\web\UnauthorizedHttpException("对不起，你现在还没获此操作的权限！");
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