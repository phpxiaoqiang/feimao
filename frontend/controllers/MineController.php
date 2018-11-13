<?php

namespace frontend\controllers;

use common\models\Counselor;
use common\models\Orders;
use Yii;
use frontend\models\Wxuser;
use yii\data\Pagination;
use common\models\Teacher;

class MineController extends BaseController
{
    public $select;
    public function actionIndex()
    {
        $id = Yii::$app->user->id;
//        $id =33;
        $is_teacher  = Teacher::find()->where(['t_id'=>$id,'is_ob'=>1])->exists();
//        var_dump($is_teacher);die;
        $data = Wxuser::find();
        return $this->render('index', [
            'data' => $data,
            'is_teacher'=>$is_teacher
        ]);
    }

    public function actionSubscribe(){
        $role = Yii::$app->user->identity->role;
//        $role = '1';
        if($role == '0'){
            $id = Yii::$app->user->id;
            $data = Orders::find();
            $this->select = ['uid'=>$id,'status' => 1];
            $pages = new Pagination(['totalCount' => $data->where($this->select)->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)
            $query = $data->offset($pages->offset)->where($this->select)->limit($pages->limit)->with('subscribe')->with('counselor')->orderBy('created_at DESC')->all();

            if (Yii::$app->request->isAjax) {
                return $this->renderPartial('u_list', [
                    'model' => $query,
                ]);

            } else {
                return $this->render('u_subscribe',[
                    'model' => $query,
                    'pages' => $pages,
                ]);
            }
        }else if($role == '1'){
            $data = Orders::find();
            $cid = Counselor::find()->where(['uid'=>Yii::$app->user->identity->openid])->one()->id;
//            $cid = Counselor::find()->where(['uid'=>'oqr-81FtYoMGVJTvbI3QyHhgOL_Q'])->one()->id;
            $this->select = ['cid'=>$cid,'status' => 1];
            $pages = new Pagination(['totalCount' => $data->where($this->select)->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)
            $query = $data->offset($pages->offset)->where($this->select)->limit($pages->limit)->with('subscribe')->with('user')->orderBy('created_at DESC')->asArray()->all();
//            return $this->output($query);
            if (Yii::$app->request->isAjax) {
                return $this->renderPartial('c_list', [
                    'model' => $query,
                ]);
            } else {
                return $this->render('c_subscribe',[
                    'model' => $query,
                    'pages' => $pages,
                ]);
            }
        }
    }

}