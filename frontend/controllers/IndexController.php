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

        $data = Post::find();  //User为model层,在控制器刚开始use了field这个model,这儿可以直接写Field,开头大小写都可以,为了规范,我写的是大写
        $pages = new Pagination(['totalCount' => $data->where(['state' => 1])->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)
        $model = $data->offset($pages->offset)->where(['state'=>1])->limit($pages->limit)->orderBy('sort DESC')->all();
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('list', [
                'model' => $model,
            ]);
        } else {
            return $this->render('index', [
                'model' => $model,
                'pages' => $pages,
            ]);
        }
    }
    public function actionBespeak(){
        $id = Yii::$app->request->get('id');
        return $this->render('search');
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