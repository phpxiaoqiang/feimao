<?php

/**
 * @Author: jiangyang
 * @Date:   2018-01-15 18:39:30
 * @Last Modified by:   jiangyang
 * @Last Modified time: 2018-01-15 21:28:43
 */

/**
 * @Author: jiangyang
 * @Date:   2017-12-09 17:32:33
 * @Last Modified by:   jiangyang
 * @Last Modified time: 2017-12-09 10:11:11
 */

namespace frontend\controllers;
use common\models\Vanswer;
use common\models\ActivityCoupons;
use common\models\TimestampBehavior;
use yii\data\Pagination;
use frontend\models\Wxuser;
use yii\db\Expression;
use Yii;
class CouponsController extends BaseController
{
    // public $layout = false; //不使用布局
    // public $layout = "coupons"; //设置使用的布局文件
    public function actionIndex(){
        $this->layout = false; //不使用布局
        $this->layout = "coupons"; //设置使用的布局文件
        return $this->render('index', [
        ]);
    }
    public function actionDetail(){
        $this->layout = false; //不使用布局
        $this->layout = "coupons"; //设置使用的布局文件
        
        $id = Yii::$app->user->id;
        // $id= 33;
        $isTrue =  ActivityCoupons::find()->where(['p_id'=>$id ])->one();
       // var_dump($isTrue);
        return $this->render('red', [
            'isTrue'=>$isTrue
        ]);
    }
    public function actionReceive(){
         
        $count =  ActivityCoupons::find()->count();
        // $user_id = Yii::$app->request->post('id');
        $user_id =Yii::$app->user->id;
        $isHave  = ActivityCoupons::find()->where(['p_id' => $user_id])->one(); 
       
       if(empty($isHave)){
         if (time()<1518019200) {
            if ($count<401) {
                    $id = Yii::$app->request->post('id');
                    $model = new ActivityCoupons();
                    $model->p_id =$id;
                    $model->expiretime =1518019200;
                    $model->money =0;
                    $model->state =0;
                    $model->receivetime = time();
                    $model->created_at =new Expression('NOW()');
                    $model->updated_at =new Expression('NOW()');
                    $model->save();
                    echo '1';
                }else{
                    echo '2';
                }
            }else{
                echo '3';
            }
       }else{
            echo '4';
       }
       
        
       
        // return $this->render('black', [
        // ]);
    }
    public function actionCoupons(){
        
        $this->layout = false; //不使用布局
        $this->layout = "coupons"; //设置使用的布局文件
        $id = Yii::$app->user->id;

        // $id =35;  
        $isState =  ActivityCoupons::find()->where(['p_id'=>$id,'state'=>0])->one();

        return $this->render('coupons', [
        'isState'=>$isState
        ]);
    }
}