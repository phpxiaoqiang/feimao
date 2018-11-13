<?php

namespace backend\controllers;

use Yii;
use common\models\Yrclass;
use common\models\YrclassSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Student;
use common\models\Category;
use common\models\Studentxclass;
use common\models\Teacher;
use yii\data\ActiveDataProvider;
use backend\controllers\BaseController;
/**
 * YrclassController implements the CRUD actions for Yrclass model.
 */
class YrclassController extends BaseController
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
     * Lists all Yrclass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YrclassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Yrclass model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        var_dump($id);die;
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Yrclass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Yrclass();

        if ($model->load(Yii::$app->request->post())) {
            if(empty($_POST['YrClass']['teacher_id'])){
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            if($model->save()){
                $classes = Yrclass::find()->select('name')->where(['teacher_id'=>$model->teacher_id])->asArray()->all();
                $str = '';
                foreach($classes as $name) $str = $str.$name["name"].'/';
                Teacher::updateAll(['class'=>$str],["id"=>$model->teacher_id]);
                return $this->redirect(['view', 'id' => $model->id]);
            }else{

            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionDetails($id)
    {

        $id = Yii::$app->request->get('id');

//        $s_id = Studentxclass::find()->select(['s_id'])->where(['c_id' => $id])->asArray()->all();  //此方法返回 ['name' => '小伙儿'] 的所有数据；
//
//        $ids = array_column($s_id, 's_id');
//        $dataProvider = new ActiveDataProvider([
//            'query' => Student::find()->where(['in', 'id', $ids]),
//        ]);

        //    Student::findBySql('SELECT * FROM user')->all(); // 此方法是用 sql  语句查询 user 表里面的所有数据；

        return $this->render('detail', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Yrclass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $tid = Yrclass::find()->select('teacher_id')->where(['id'=>$id])->one()['teacher_id'];
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $classes = Yrclass::find()->select('name')->where(['teacher_id'=>$model->teacher_id])->asArray()->all();
                $str = '';
                foreach($classes as $name) $str = $str.$name["name"].'/';
                Teacher::updateAll(['class'=>$str],["id"=>$model->teacher_id]);
                //修改
                $classes = Yrclass::find()->select('name')->where(['teacher_id'=>$tid])->asArray()->all();
                $str = '';
                foreach($classes as $name) $str = $str.$name["name"].'/';
                Teacher::updateAll(['class'=>$str],["id"=>$tid]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Yrclass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $teacher = Yrclass::find()->where(['id'=>$id])->one();
        $this->findModel($id)->delete();
        Studentxclass::deleteAll(['c_id'=>$id]);
        $classes = Yrclass::find()->select('name')->where(['teacher_id'=>$teacher['teacher_id']])->asArray()->all();
        $str = '';
        foreach($classes as $name) $str = $str.$name["name"].'/';
        Teacher::updateAll(['class'=>$str],["id"=>$teacher['teacher_id']]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Yrclass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Yrclass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Yrclass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     public function actionExcel()

    {

        //查询教师数据
        $result = Yrclass::find()->asArray()->select(['name','cid','class_table','teacher_id','student_sum','is_graduation','start_time'])->all();
        dd($result);
        $Id = Yrclass::find()->asArray()->all();
        // dd($Id);
        // exit;
        foreach ($result as $key => $value) {
            # code...
            $model1 = Yrclass::findOne($Id[$key]['id']);
            $fenlei = $model1->hasOne(Category::className(),['id'=>'cid'])->asArray()->one();
            $result[$key]['cid'] = $fenlei['name'];

            $teacher =$model1->hasOne(Teacher::className(),['id'=>'teacher_id'])->asArray()->one();
            $result[$key]['teacher_id'] = $teacher['name']; 

            if($value['is_graduation'] == 1) {
                $result[$key]['is_graduation'] = "是";
            }else {
                $result[$key]['is_graduation'] = "否";

            }
        }
        // dd($result);
        // die;
        $dataResult = $result;      //todo:导出数据（自行设置） 
        $headTitle = "<h1>班级信息</h1>"; 
        $time = time();
        $title = date('Y-m-d',$time)."班级信息表"; 
        $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
        $titlename = "<tr> 
                    
                    
                    <th style='width:90px;' >班级名称</th> 
                    <th style='width:120px;'>课程分类</th> 
                    <th style='width:200px;'>课程表</th> 
                    <th style='width:120px;'>舞蹈老师</th> 

                    <th style='width:90px;'>学生人数</th> 
                    <th style='width:90px;'>是否毕业</th> 
                    <th style='width:140px;'>开班时间</th> 
                </tr>"; 
           $filename = $title.".xls"; 
           excelData($dataResult,$titlename,$headtitle,$filename); 
           
    }
  
}
