<?php

namespace backend\controllers;

use Yii;
use common\models\Vanswer;
use common\models\VanwerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Qiniu;
use backend\controllers\BaseController;
use yii\data\Pagination;
/**
 * VanwerController implements the CRUD actions for Vanswer model.
 */
class VanwerController extends BaseController
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
     * Lists all Vanswer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VanwerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vanswer model.
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
     * Creates a new Vanswer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vanswer();

        
        if ($model->load(Yii::$app->request->post())) {
            $pic_path = $_FILES['Vanswer']['tmp_name']['pic'];

            $small_pic_path = $_FILES['Vanswer']['tmp_name']['small_pic'];
            $qiniu = new Qiniu();
            $key = 'big_v_'.time();
            $qiniu->uploadFile($pic_path, $key);
            $model->pic = $qiniu->getLink($key);

            $key_small = 'big_v_small'.time();
            $qiniu->uploadFile($small_pic_path,$key_small);
            $model->small_pic = $qiniu->getLink($key_small);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vanswer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pic = $model->pic;
        $small_pic = $model->small_pic;

        if ($model->load(Yii::$app->request->post())) {
            $pic_path = $_FILES['Vanswer']['tmp_name']['pic'];
            // var_dump($pic_path);die;
            if (!$pic_path) {
                $model->pic = $pic;
            } else {

                $qiniu = new Qiniu();
                $key = 'big_v_'.time();
                $qiniu->uploadFile($pic_path, $key);
                $model->pic = $qiniu->getLink($key);
            }
            // var_dump($model->pic);die;
            $small_pic_path = $_FILES['Vanswer']['tmp_name']['small_pic'];
            if (!$small_pic_path) {
                $model->small_pic = $small_pic;
            } else {
                $qiniu = new Qiniu();
                $key_small = 'big_v_small'.time();
                $qiniu->uploadFile($small_pic_path,$key_small);
                $model->small_pic = $qiniu->getLink($key_small);
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
     * Deletes an existing Vanswer model.
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
     * Finds the Vanswer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vanswer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vanswer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
