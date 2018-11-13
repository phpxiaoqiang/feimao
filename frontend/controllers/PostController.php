<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use yii\data\Pagination;

class PostController extends BaseController
{
    public function actionIndex()
    {
         $id = Yii::$app->request->get('id');

         $data = Post::find();  //User为model层,在控制器刚开始use了field这个model,这儿可以直接写Field,开头大小写都可以,为了规范,我写的是大写

         if (!empty($id)){
             $pages = new Pagination(['totalCount' => $data->where(['counselor_id' => $id,'state' => 1])->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)

             $model = $data->offset($pages->offset)->where(['counselor_id' => $id,'state'=>1])->limit($pages->limit)->orderBy('sort DESC')->all();
        }else{
             $pages = new Pagination(['totalCount' => $data->where(['state' => 1])->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)

             $model = $data->offset($pages->offset)->where(['state'=>1])->limit($pages->limit)->orderBy('sort DESC')->all();
        }

        if (Yii::$app->request->isAjax) {

            return $this->renderPartial('list', [
                'model' => $model,
            ]);

        } else {
            return $this->render('index', [
                'model' => $model,
                'pages' => $pages,
                'id'=>$id
            ]);
        }
    }

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $post = Post::find()->where(['id' => $id])->one();
        return $this->render('detail', [
            'post' => $post
        ]);
    }

}