<?php

/**
 * @Author: jiangyang
 * @Date:   2017-12-09 17:32:33
 * @Last Modified by:   jiangyang
 * @Last Modified time: 2017-12-09 10:11:11
 */

namespace frontend\controllers;
use common\models\Vanswer;
use common\models\Problem;
use common\models\Vcomment;
use yii\data\Pagination;
use frontend\models\Wxuser;
use yii\db\Expression;
use Yii;
class BigvController extends BaseController
{
    public function actionIndex(){
    	
    	// $model = Vanswer::find()->where(['state'=>1])->select('id,name,pic')->limit(3)->orderBy('sort ASC')->asArray()->all();
        
        $data = Vanswer::find()->where([ 'state' => 1]);
        // var_dump($data);
        // var_dump($data->count());die;
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => '5']);
       
        $model = $data->offset($pages->offset)->limit($pages->limit)->orderBy('sort DESC')->asArray()->all();
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

    public function actionDetail(){

        $id = Yii::$app->request->get('id');
        
        $bigv = Vanswer::find()->where(['id'=>$id ,'state' => 1])->one();
        $problem = Problem::find()->where(['c_id'=>$id ,'state' => 1])->all();
        $data = Vcomment::find()
            ->alias('c')
            ->select(['content','c.created_at','w.nickname','w.headimgurl'])
            ->leftJoin('yz_wxuser as w', ' c.p_id =w.id')->where(['e_id'=>$id ,'state' => 1])->asArray();
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => '5']);
       
        $model = $data->offset($pages->offset)->limit($pages->limit)->orderBy('c.id DESC')->asArray()->all();
        if (Yii::$app->request->isAjax) {

            return $this->renderPartial('commentlist', [
                'model' => $model,
            ]);

        } else {
            return $this->render('detail', [
                'model' => $model,
                'pages' => $pages,
                'bigv'=>$bigv,
                'problem'=>$problem
            ]);
        }
      
    }

    public function actionComment(){
        
        $area = Yii::$app->request->post('area');
        $eid = Yii::$app->request->post('_id');
        if (!empty($area)) {

            $pid = Yii::$app->user->id;
            $model = new Vcomment();
            $model->p_id = $pid;
            $model->e_id =$eid;
            $model->content =$area;
            $model->score =1;
            $model->state =1;
            $model->created_at =  new Expression('NOW()');
            if($model->save()){
                return $this->redirect(['detail', 'id' => $eid]);
            }else{
                return $this->render('comment');
            }
        }
       
        return $this->render('comment');
    }
    
    public function actionAudio(){

        $id = Yii::$app->request->get('id');
        $model = Problem::find()->where(['id'=>$id ,'state' => 1])->one();
        $problem = Problem::find()->where(['<>','id',$id])->andwhere(['c_id'=>$model->c_id,'state'=>1])->all();
        return $this->render('audio',[
            'model'=>$model,
            'problem'=>$problem
        ]);
    }
}