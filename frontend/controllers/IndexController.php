<?php

namespace frontend\controllers;
use common\models\Category;

use common\models\Post;
use common\models\Subscribeclass;
use common\models\Counselor;

use common\models\Student;
use Yii;
use yii\data\Pagination;

class IndexController extends BaseController
{
    public function actionIndex(){

            return $this->render('index');

    }
    public function actionService(){

        return $this->render('list');
    }
    /*预约*/
    public function actionAddapp(){

        $p_name = Yii::$app->request->get('p_name');
        $tel = Yii::$app->request->get('tel');
        $baby_name = Yii::$app->request->get('baby_name');
        $age = Yii::$app->request->get('age');
        $comment_text = Yii::$app->request->get('comment_text');
        $id =  Yii::$app->request->get('id');
        $wx_id = Yii::$app->user->id;
//        $wx_id = 35;
        $post = Post::find()->where(['id'=>$id])->one();
        $su = new Subscribeclass();
        $su->class_name = $post->title;
        $su->dance =$post->counselor_id;
        $su->tel  =$tel;
        $su->subscribe_mark =$comment_text;
        $su->p_name =$p_name;
        $su->s_name =$baby_name;
        $su->p_id = $wx_id;
        $su->cid = $id;
        $su->save();
        $ex_st = Student::find()->where(['p_id'=>$wx_id])->exists();
//        var_dump($ex_st);die;
        if (!$ex_st){
//            echo 'aaa';die;
            $model = new Student();
            $model->name =$baby_name;
            $model->sex = 0;
            $model->parent_name =$p_name;
            $model->age = $age;
            $model->parent_tel  = $tel;
            $model->p_id = $wx_id;
            $model->save();
        }


        if($su->save()){
           $psot = Post::find()->where(['id'=>$id])->one();
           $psot->sub_num +=1;
           $psot->save();
            echo '1';
        }else{
            echo '2';
        }

    }

}