<?php

namespace backend\controllers;

use Yii;
use common\models\Problem;
use common\models\ProblemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Qiniu;
use backend\controllers\BaseController;
use yii\data\Pagination;
/**
 * ProblemController implements the CRUD actions for Problem model.
 */
class ProblemController extends BaseController
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
     * Lists all Problem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProblemSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $cid = Yii::$app->request->get('id');
        // $eid = Yii::$app->request->get('eid'); 
        $dataProvider = new ActiveDataProvider([
            'query' => Problem::find()->where(['c_id' => $cid]),
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Problem model.
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
     * Creates a new Problem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Problem();
        $cid = Yii::$app->request->get('id');
        // $eid = Yii::$app->request->get('eid'); 
        if ($model->load(Yii::$app->request->post())) {
            $pic_path = $_FILES['Problem']['tmp_name']['pic'];

            $qiniu = new Qiniu();
            $key = 'problem_v_'.time();
            $qiniu->uploadFile($pic_path, $key);
            $model->pic = $qiniu->getLink($key);
            $model->c_id =$cid;
            // $model->e_id =$eid;
            if ($model->save()) {
                // header('Location: http://www.example.com/');
                return $this->redirect(array('index','id' => $cid));
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Problem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pic = $model->pic;
       if ($model->load(Yii::$app->request->post())) {
            // echo $model->load(Yii::$app->request->post());die;
            // var_dump($_FILES);die;
            $pic_path = $_FILES['Problem']['tmp_name']['pic']; 
              // var_dump($pic_path);die;
            if (!$pic_path) {
                $model->pic = $pic;
            } else {
                $qiniu = new Qiniu();
                $key = 'problem_v_'.time();
                $qiniu->uploadFile($pic_path, $key);
                $model->pic = $qiniu->getLink($key);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Problem model.
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
     * Finds the Problem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Problem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Problem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
