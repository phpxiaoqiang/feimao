<?php

namespace backend\controllers;

use Yii;
use common\models\Teacher;
use common\models\TeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BaseController;
/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends BaseController
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
     * 
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teacher model.
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
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teacher();

        if ($model->load(Yii::$app->request->post()) ) {

            $file = $_FILES['Teacher']['tmp_name']['pic'];
            if (!empty($file)) {
                $name = $_FILES['Teacher']['name']['pic'];
                $name = date("YmdHis") . 'feimaokj.jpg';
//
                $type = strtolower(substr($name, strrpos($name, '.') + 1)); //得到文件类型，并且都转化成小写
                $allow_type = array('jpg', 'jpeg', 'gif', 'png'); //定义允许上传的类型
                //判断文件类型是否被允许上传
                if (!in_array($type, $allow_type)) {
                    //如果不被允许，则直接停止程序运行
                    return;
                }
                //判断是否是通过HTTP POST上传的
                if (!is_uploaded_file($file)) {
                    //如果不是通过HTTP POST上传的
                    return;
                }
                $upload_path = "/uploads/yirantianshiimg/"; //上传文件的存放路径
                if (move_uploaded_file($file, Yii::getAlias("@backend") . '/web' . $upload_path . $name)) {
//                echo "Successfully!";
                    $model->pic = Yii::$app->params['IMG_PATH'] . $name;
                } else {
                    echo "Failed!";
                    die;
                }
            }
            if ($model->save()){
//                $this->refresh();
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pic = $model->pic;
        if ($model->load(Yii::$app->request->post())) {

            $file = $_FILES['Teacher']['tmp_name']['pic'];
            if (!empty($file)){
                $name = $_FILES['Teacher']['name']['pic'];
                //上传文件的文件名
                $name = date( "YmdHis" ).'feimaokj.jpg';
//                $name = rename($old,$name);
                $type = strtolower(substr($name,strrpos($name,'.')+1));
                $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
                //判断文件类型是否被允许上传
                if(!in_array($type, $allow_type)){
                    //如果不被允许，则直接停止程序运行
                    return ;
                }
                //判断是否是通过HTTP POST上传的
                if(!is_uploaded_file($file)){
                    //如果不是通过HTTP POST上传的
                    return ;
                }
                $upload_path = "/uploads/yirantianshiimg/"; //上传文件的存放路径
                if(move_uploaded_file($file,Yii::getAlias("@backend").'/web/'.$upload_path.$name)){

//                    $model->pic ='http://img.yirantianshi.com/'.$name;
                    $model->pic = Yii::$app->params['IMG_PATH'].$name;
                }else{
                    echo "Failed!";die;
                }
            }else{
                $model->pic = $pic;

            }
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Teacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     public function actionExcel()
    {
        //查询教师数据
        $result = Teacher::find()->select(['name','sex','age','major','class','mark','is_ob'])->asArray()->all();
        // dd($result);
        // die;
        $dataResult = $result;      //todo:导出数据（自行设置） 
        $headTitle = "<h1>教师信息</h1>"; 
        $time = time();
        $title = date('Y-m-d',$time)."教师信息表"; 
        $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
        $titlename = "<tr> 
                    <th style='width:70px;' >姓名</th> 
                    <th style='width:70px;'>性别</th> 
                    <th style='width:90px;'>年龄</th> 
                    <th style='width:120px;'>专业</th> 
                    <th style='width:140px;'>班级</th> 
                    <th style='width:200px;'>备注</th> 
                    <th style='width:140px;'>是否在职</th> 
                </tr>"; 
           $filename = $title.".xls"; 
           $this->excelData($dataResult,$titlename,$headtitle,$filename); 
           
    }
    public function excelData($datas,$titlename,$title,$filename){ 
            $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>"; 
            $str .="<table border=1><head>".$titlename."</head>"; 
            // $str .= $title; 
            foreach ($datas  as $key=> $rt ) 
            { 
                $str .= "<tr>"; 
                foreach ( $rt as $key => $v ) 
                { 

                    if($key == 'sex') {
                       switch ($v) {
                           case 1: $v = "男";
                               # code...
                               break;
                           
                           default:$v = "女";
                               # code...
                               break;
                       }
                    }
                     if($key == 'is_ob') {
                       switch ($v) {
                           case 1: $v = "在职";
                               # code...
                               break;
                           
                           default:$v = "离职";
                               # code...
                               break;
                       }
                    }
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