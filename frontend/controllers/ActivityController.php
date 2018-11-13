<?php
namespace frontend\controllers;
use common\models\ActivityCoupons;
// use common\models\Problem;
// use common\models\Vcomment;
use yii\data\Pagination;
use frontend\models\Wxuser;
use yii\db\Expression;
use Yii;
class ActivityController extends BaseController
{
	public function actionIndex(){


		return $this->render('index');
	}

	public function actionDetail(){
  		//用户id
  		$id = Yii::$app->user->id;
		// $isTrue =  ActivityCoupons::
		return $this->render('index',[

		]);
	}
}