<?php

namespace frontend\controllers;


use common\models\Student;
use Yii;
use yii\data\Pagination;
use common\models\Yrclass;
use common\models\Teacher;
use common\models\Studentxclass;
class OrderController extends BaseController
{
    public $select;

    public function actionIndex()
    {
        $state = Yii::$app->request->get('id');

        $id =Yii::$app->user->id;
//        $id =33;
        if($state =='teacher'){

            $teacher = Teacher::find()->where(['t_id'=>$id])->one();

            $model = Yrclass::find()->where(['teacher_id'=>$teacher->id])->orderBy(' id desc')->all();

        }else{
            $no_student = Student::find()->where(['p_id'=>$id])->exists();
            if ($no_student){
                $student = Student::find()->where(['p_id'=>$id])->one();

                $model = Studentxclass::find()->where(['s_id'=>$student->id])->orderBy(' id desc')->all();
//                $ids = array_column($msg, 'c_id');
//                $model = Yrclass::find()->where(['in' , 'id' , $ids])->all();
            }else{
                $model = '';
            }
        }

        return $this->render('index',[
            'model'=>$model
        ]);

//        $state = Yii::$app->request->get('state', '');
//        $uid = Yii::$app->user->id;
//        // $uid = '33';
//        $data = Orders::find();
//        if ($state !== '') {
//            $this->select = ['status' => $state, 'uid' => $uid];
//        } else {
//            $this->select = ['uid' => $uid];
//        }
//
//        $pages = new Pagination(['totalCount' => $data->where($this->select)->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)
//
//        $query = $data->offset($pages->offset)->where($this->select)->limit($pages->limit)->with('counselor')->with('subscribe')->orderBy('created_at DESC')->asArray()->all();
//
//        foreach ($query as $key => $value) {
//            $res = Comment::find()->where(['p_id' => $uid,'c_id'=>$value['cid'], 's_id' => $value['sid']])->all();
//            if ($res) {
//                $query[$key]['is_comment'] = true;
//            } else {
//                $query[$key]['is_comment'] = false;
//            }
//        }
//
//       // var_dump($query[$key]['is_comment']);
//       // die;
//        if (Yii::$app->request->isAjax) {
//
//            return $this->renderPartial('list', [
//                'model' => $query,
//            ]);
//
//        } else {
//            return $this->render('index', [
//                'model' => $query,
//                'pages' => $pages,
//            ]);
//        }

    }

    public function actionCancel($oid)
    {
        $model = Orders::find()->where(['oid' => $oid])->one();
        if ($model && $model->status != '2') {
            $model->status = '2';
            if ($model->save()) {
                return $this->output(true, 200, '修改成功');
            } else {
                return $this->output(false, 200, '修改失败');
            }
        } else {
            return $this->output(false, 200, '没有此订单');
        }
    }
}