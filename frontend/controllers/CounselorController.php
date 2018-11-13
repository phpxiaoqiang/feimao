<?php

namespace frontend\controllers;

use common\models\ActivityCoupons;
use common\models\Category;
use common\models\Counselor;
use common\models\Post;
use common\models\Subscribe;
use Yii;
use yii\data\Pagination;

class CounselorController extends BaseController
{

    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $data = Counselor::find()->where(['category_id' => $id, 'state' => 1])->with('label')->with('subscribe');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => '5']);
        $model = $data->offset($pages->offset)->limit($pages->limit)->orderBy('sort DESC')->asArray()->all();
        $name = Category::find()->select('name')->where(['id' => $id])->one();
//        var_dump($model);
//        return $this->output($model);
//        die;
        if (Yii::$app->request->isAjax) {

            return $this->renderPartial('list', [
                'model' => $model,
            ]);

        } else {
            return $this->render('index', [
                'model' => $model,
                'pages' => $pages,
                'name' => $name
            ]);
        }

    }

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $data = Counselor::find()->where(['id' => $id, 'state' => 1])->with('subscribe')->asArray()->one();
        $post = Post::find()->where(['counselor_id' => $id, 'state' => 1])->asArray()->limit(2)->orderBy('sort ASC')->all();
        return $this->render('detail', [
            'banner' => '213',
            'data' => $data,
            'post' => $post
        ]);
    }

    public function actionAppointment()
    {
        $id = Yii::$app->request->get('id');
        $data = Counselor::find()->where(['id' => $id, 'state' => 1])->one();
        $subscribe = Subscribe::find()->where(['counselor_id' => $id, 'state' => 1, 'is_buy' => 1])->asArray()->orderBy('subscribe_startTime ASC')->all();

        $isBuySubScribe = [];
        foreach ($subscribe as $value) {
           
            if (strtotime($value['subscribe_startTime']) > time() + 3600 * 12 ) {
                array_push($isBuySubScribe, $value);
            }
        }
        $coupon = ActivityCoupons::find()
            ->where(['p_id' => Yii::$app->user->id, 'state' => 0])
            ->andWhere(['>', 'expiretime', time()])
            ->asArray()->one();
        return $this->render('appointment', [
            'data' => $data,
            'subscribe' => $isBuySubScribe,
            'coupon' => $coupon
        ]);
    }

    public function actionAgreement()
    {

        return $this->render('agreement');
    }
}