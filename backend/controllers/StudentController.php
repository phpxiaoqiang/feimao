<?php

namespace backend\controllers;
//引入导出excel辅助文件
// require_once(__DIR__ .'/../excel/PHPExcel.php');
// require_once(__DIR__ .'/../excel/PHPExcel/Writer/Excel2007.php');
// require_once(__DIR__ .'/../excel/PHPExcel/IOFactory.php');
use PHPExcel;
use Yii;
use common\models\Student;
use common\models\Post;
use common\models\StudentSearch;
use common\models\Yrclass;
use common\models\Card;
use common\models\Line;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Studentxclass;
use backend\controllers\BaseController;
 
/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends BaseController
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();
        $yrmodel = new Yrclass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $yrmodel = new Yrclass();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $name = $_POST['Student']['name'];
            if (!empty($name)){
                Studentxclass::updateAll(['name'=>$name],['s_id'=>$id]);
//                Studentxclass::find()->where(['s_id'=>$id])->updateAll(['name'=>$name]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       $model = Studentxclass::find()->where(['s_id'=>$id])->exists();
//       var_dump($model);die;
       if (!$model){
           $this->findModel($id)->delete();
           return $this->redirect(['index']);
       }else{
           echo '<script>alert("该学生已经存在班级，无法删除");window.location.href="/student/index";</script>';
       }

    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   
     public function actionExcel()
    {
        //查询学生表数据
        $result = Student::find()->select(['name','sex','age','parent_name','parent_tel','school','card_type','class','mark'])->asArray()->all();
        $r = Student::find()->asArray()->all();
        // dd($r);
        // die;
        foreach($result as $key => $val) {
            $s = Student::findOne($r[$key]['id']);
            $c = $s->hasOne(Card::className(),['id'=>'card_type'])->asArray()->one();
            $result[$key]['card_type'] = $c['name'];
        }
        // die;
        //查询卡类型作为提示信息
        $card = Card::find()->select('id,name')->asArray()->all();
       

        // dd($card);
        // die;
        $dataResult = $result;      //todo:导出数据（自行设置） 
        $headTitle = "<h1>学生信息</h1>";
        $time = time(); 
        $title = date('Y-m-d',$time)."学生信息表"; 
        $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
        $titlename = "<tr> 
               
                    <th style='width:70px;' >姓名</th> 
                    <th style='width:40px;'>性别</th> 
                    <th style='width:70px;'>年龄</th> 
                    <th style='width:90px;'>家长姓名</th> 
                    <th style='width:200px;'>家长联系方式</th> 
                    <th style='width:200px;'>学校</th> 
                    <th style='width:70px;'>卡类型</th> 
                    <th style='width:200px;'>班级</th> 
                    <th style='width:200px;'>备注</th> 
                     
                </tr>"; 
           $filename = $title.".xls"; 
          $this->excelData($dataResult,$titlename,$headtitle,$filename,$card); 
           
    }
    public function excelData($datas,$titlename,$title,$filename,$card){ 
            $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>"; 
            $str .="<table border=1><head>".$titlename."</head>"; 
            // $str .= $title; 
            foreach ($datas  as $key=> $rt ) 
            { 
                $str .= "<tr>"; 
                foreach ( $rt as $k => $v ) 
                { 
                    // dd($k);
                    if($k == 'sex') {
                        switch ($v) {
                            case 1:  $v = "男";
                                # code...
                                break;
                            case 0: $v = "女";
                                break;
                                
                            default:
                                # code...
                                break;
                        }
                    }
                    if($k == 'card_type') {
                        switch ($v) {
                            case 1: $v = $card[0]['name']; 
                                # code...
                                break;
                             case 2: $v = $card[1]['name']; 
                            # code...
                            break;
                             case 3: $v = $card[2]['name']; 
                            # code...
                            break;
                            
                            default:
                                # code...
                                break;
                        }
                    }
                    // die;
                    $str .= "<td>{$v}</td>"; 
                } 
                $str .= "</tr>\n"; 
            } 
            $str .= "</table></body></html>"; 
            header( "Content-Type: application/vnd.ms-excel; name='excel'" ); 
            header( "Content-type: application/octet-stream" ); 
            header( "Content-Disposition: attachment; filename=".$filename ); 
            header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" ); 
            header( "Pragma: no-cache" ); 
            header( "Expires: 0" ); 
            exit( $str ); 
        } 

    

}
