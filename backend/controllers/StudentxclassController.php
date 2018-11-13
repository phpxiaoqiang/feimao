<?php

namespace backend\controllers;


use common\models\Card;
use Yii;
use common\models\Studentxclass;
use common\models\StudentxclassSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Student;
use common\models\Yrclass;
use backend\controllers\BaseController;

/**
 * StudentxclassController implements the CRUD actions for Studentxclass model.
 */
class StudentxclassController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Studentxclass models.
     * @return mixed
     */
    public function actionIndex()
    {

        $counselorId = Yii::$app->request->get('id');
        $searchModel = new StudentxclassSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Studentxclass::find()->where(['c_id' => $counselorId]),
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Studentxclass model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Studentxclass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Studentxclass();

        $counselorId = Yii::$app->request->get('id');
        if ($model->load(Yii::$app->request->post())) {
           $s_id =  $_POST['Studentxclass']['s_id'];
//            var_dump($s_id);die;
           $student = Student::find()->where(['id'=>$s_id])->one();
            $model->s_id = $s_id;
            $model->c_id = $counselorId;
            $model->name = $student->name;
            $model->p_name = $student->parent_name;
            $model->s_tel = $student->parent_tel;
            if($model->save()){
                $count  =  Studentxclass::find()->where(['c_id'=>$counselorId])->count('id');
//              var_dump($count);die;
//                $class = YrClass::find()->where(['id'=>$counselorId])->one();
                $class = YrClass::findOne($counselorId);
                $class->student_sum = $count;
                $class->save();
            }
            //查询指定学生的班级
            $s = Student::find()->asArray()->where(['id'=>$s_id])->asArray()->one();
            $class = $s['class'];
            //给学生表更新班级
            $class = YrClass::find()->where(['id'=>$counselorId])->asArray()->one();
            $s = Student::findOne($s_id);
            $s->class = $class['name']."/".$s['class'];
            $s->update();
            // die;

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Studentxclass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Studentxclass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $counselorId =$model->c_id;

        //查询此次删除的班级
        $c = YrClass::find()->where(['id'=>$counselorId])->select('name')->asArray()->one();
        $c_name = $c['name'];
        //查询学生表中已经存在的班级并作分割处理
        $s_id = $model->s_id;
        $s_class = Student::find()->where(['id'=>$s_id])->select(['class'])->asArray()->one();
        $s_class = rtrim($s_class['class'],'/');
        // dd($s_class);
        // die;
        $arr = explode("/",$s_class);
        $array = "";
        foreach($arr as $val) {
            if($val != $c_name) {
                $array .= $val."/"; 
            }
        }

        //给学生表更新班级数据
        $s = Student::findOne($s_id);
        $s->class = $array;
        $s->update();
        // dd($array);
        // die;

        $det =$this->findModel($id)->delete();
//          var_dump($det);die;
          if ($det){
              $count  =  Studentxclass::find()->where(['c_id'=>$counselorId])->count('id');
              $class = YrClass::findOne($counselorId);
              $class->student_sum = $count;
              $class->save();
          }

         return $this->redirect(['index?id='. $counselorId]);
    }
    public function actionCardstauts(){
//        header("Content-type: text/html; charset=utf-8");
        $counselorId = Yii::$app->request->get('type');
//        var_dump($counselorId);die;
        $card = Card::find()->where(['id'=>$counselorId])->one();
        echo $card->hours.'金额:'.$card->money.'元';
    }
    /**
     * Finds the Studentxclass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Studentxclass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Studentxclass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
