<?php

namespace backend\controllers;

use Symfony\Component\Yaml\Tests\B;
use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Qiniu;
use backend\controllers\BaseController;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends BaseController
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) ) {

            $file = $_FILES['Post']['tmp_name']['pic'];
            $name = $_FILES['Post']['name']['pic'];
            //上传文件的文件名
            $name = date( "YmdHis" ).'feimaokj.jpg';
            //  =              $name = rename($old,$name);
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
            if(move_uploaded_file($file,Yii::getAlias("@backend").'/web'.$upload_path.$name)){
//                echo "Successfully!";
                $model->pic = Yii::$app->params['IMG_PATH'].$name;
            }else{
                echo "Failed!";die;
            }
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pic = $model->pic;
        if ($model->load(Yii::$app->request->post()) ) {
//
            $file = $_FILES['Post']['tmp_name']['pic'];
            if (!empty($file)){
                $name = $_FILES['Post']['name']['pic'];
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
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
