<?php

namespace backend\controllers;

use Yii;
use common\models\Subscribeclass;
use common\models\SubscribeclassSearch;
use common\models\Yzcategory;
// use yii\data\Sort;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BaseController;

/**
 * SubscribeclassController implements the CRUD actions for Subscribeclass model.
 */
class SubscribeclassController extends BaseController
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
     * Lists all Subscribeclass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubscribeclassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subscribeclass model.
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
     * Creates a new Subscribeclass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subscribeclass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subscribeclass model.
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
     * Deletes an existing Subscribeclass model.
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
     * Finds the Subscribeclass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subscribeclass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subscribeclass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     public function actionExcel()
    {   
     
        //查询预约数据
        $result = Subscribeclass::find()->select(['class_name','tel','p_name','dance','created_at'])->orderBy("created_at DESC")->asArray()->all();
        $dataResult = $result;      //todo:导出数据（自行设置） 

        // dd($result);
        $s = Subscribeclass::find()->select(['id','created_at'])->asArray()->orderBy("created_at DESC")->all();

        foreach($dataResult as $k=>$val) {
            $ss = Subscribeclass::findOne($s[$k]['id']);
            $class = $ss->hasOne(Yzcategory::className(),['id'=>'dance'])->asArray()->one();
            $dataResult[$k]['dance'] = $class['name'];
        }
        //查询舞种提示信息
        $dance = Yzcategory::find()->select('id,name')->asArray()->all();
        // dd($dance);
        // die;
       
        $headTitle = "<h1>预约信息</h1>"; 
        $time = time();
        $title = date('Y-m-d',$time)."预约信息表"; 
        $headtitle= "<tr style='height:50px;border-style:none;><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='11' >{$headTitle}</th></tr>"; 
        $titlename = "<tr> 
                    <th style='width:200px;' >课程名称</th> 
                    <th style='width:140px;'>手机号</th> 
                    <th style='width:100px;'>家长姓名</th> 
                    <th style='width:100px;'>舞种分类</th> 
                    <th style='width:140px;'>创建时间</th> 
                </tr>"; 
           $filename = $title.".xls"; 
           $this->excelData($dataResult,$titlename,$headtitle,$filename,$dance); 
           
    }
    //excel打印函数
    public function excelData($datas,$titlename,$title,$filename,$dance){ 
            $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>"; 
            $str .="<table border=1><head>".$titlename."</head>"; 
            // $str .= $title; 
            foreach ($datas  as $key=> $rt ) 
            { 
                $str .= "<tr>"; 
                foreach ( $rt as $k => $v ) 
                { 
                   
                    $str .= "<td>{$v}</td>"; 
                } 
                // die;
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
