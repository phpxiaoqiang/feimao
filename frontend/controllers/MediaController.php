<?php

namespace frontend\controllers;

use common\models\Media;
use Yii;
use common\models\Counselor;
use yii\data\Pagination;

class MediaController extends BaseController
{
    public function actionIndex()
    {

        $data = Media::find();  //User为model层,在控制器刚开始use了field这个model,这儿可以直接写Field,开头大小写都可以,为了规范,我写的是大写
        $pages = new Pagination(['totalCount' => $data->where(['state' => 1])->count(), 'pageSize' => '5']);    //实例化分页类,带上参数(总条数,每页显示条数)
        $model = $data->offset($pages->offset)->where(['state' => 1])->limit($pages->limit)->orderBy('sort ASC')->all();
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

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $model = Media::find()->where(['id' => $id, 'state' => 1])->one();
        $sum = $model['playNum']+1;
        Media::updateAll(['playNum'=>$sum],['id'=>$id]);
        return $this->render('detail', [
            'model' => $model
        ]);
    }
//    public function actionUpdatenum(){
//        $id = Yii::$app->request->get('id');
//          $sum = $model['playNum']+1;
//        Media::updateAll(['playNum'=>$sum],['id'=>$id]);
//    }
}